<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    private function sendOtpEmail($user)
    {
        Http::withHeaders([
            'accept' => 'application/json',
            'api-key' => env('BREVO_API_KEY'),
            'content-type' => 'application/json',
        ])->post('https://api.brevo.com/v3/smtp/email', [
            'sender' => ['name' => 'RuralCare+', 'email' => env('SENDER_EMAIL')],
            'to' => [['name' => $user->name, 'email' => $user->email]],
            'subject' => 'Your OTP Code',
            'htmlContent' => "
                <h1>Your new OTP Code is: <strong>{$user->otp_code}</strong></h1>
                <p>This code is valid for 5 minutes.</p>
            ",
        ]);
    }

    public function resendOtp(Request $request)
    {
        $email = session('otp_email');

        if (!$email) {
            return redirect()->route('login')->with('error', 'Session expired. Please try again.');
        }

        $user = User::where('email', $email)->first();

        if (!$user) {
            return redirect()->route('login')->with('error', 'User not found.');
        }

        $lastResend = session('last_otp_resend_time');
        if ($lastResend) {
            $elapsed = now()->diffInSeconds(Carbon::parse($lastResend));
            if ($elapsed < 120) {
                $remaining = 120 - $elapsed;
                return back()->with('error', "Please wait {$remaining} seconds before resending OTP.");
            }
        }

        $otp = rand(100000, 999999);
        $user->update([
            'otp_code' => $otp,
            'otp_expires_at' => now()->addMinutes(5)
        ]);

        $this->sendOtpEmail($user);

        session(['last_otp_resend_time' => now()]);

        return back()->with('success', 'A new OTP has been sent to your email.');
    }



    public function newPassword(Request $request)
    {
        $email = session('otp_email');

        if (!$email) {
            return redirect()->route('login');
        }

        $user = User::where('email', $email)->first();

        if (!$user) {
            return redirect()->route('login');
        }

        $validator = Validator::make($request->all(), [
            'password' => 'required|string|min:8|confirmed',
        ], [
            'password.required' => 'Password is required.',
            'password.min' => 'Password must be at least 8 characters long.',
            'password.confirmed' => 'Password confirmation does not match.',
        ]);

        if ($validator->fails()) {
            return back()->with('error', $validator->errors()->first('password'));
        }

        // Update password
        $user->update([
            'password' => bcrypt($request->password),
        ]);

        // Clear session
        $request->session()->forget('otp_email');

        return redirect()->route('login')->with('success', 'Password successfully updated. You can now login.');
    }

    public function verifyEmail(Request $request)
    {
        $request->validate([
            'otp' => 'required|min:6'
        ]);

        // Get the email stored in session
        $email = session('otp_email');

        if (!$email) {
            return redirect()->route('login');
        }

        $user = User::where('email', $email)->first();

        if (!$user) {
            return redirect()->route('login');
        }

        // Check if OTP is correct
        if ($request->otp !== $user->otp_code) {
            return back()->with(['error' => 'Incorrect OTP. Please try again.']);
        }

        // Check OTP expiry
        if (Carbon::now()->isAfter($user->otp_expires_at)) {
            return back()->withErrors(['error' => 'OTP has expired. Please request a new one.']);
        }

        // Clear OTP after successful verification
        $user->update([
            'email_verified_at' => Carbon::now(),
            'otp_code' => null,
            'otp_expires_at' => null
        ]);

        return redirect()->route('show-new-password');
    }

    public function forgotPassword(Request $request)
    {
        $incomingFields = $request->validate([
            'email' => ['required', 'email']
        ]);

        $user = User::where('email', $incomingFields['email'])->first();

        // Throw error if user not found
        if (!$user) {
            return back()->with([
                'error' => 'No account exists for this email. Please try again.'
            ])->withInput();
        }

        $user->otp_code = rand(100000, 999999);
        $user->otp_expires_at = Carbon::now()->addMinutes(5);
        $user->save();

        $this->sendOtpEmail($user);

        session(['otp_email' => $user->email]);

        return redirect()->route('show-verify-email')->with('success', '');
    }

    public function showNewPassword()
    {
        return view('new-password');
    }

    public function showVerifyEmail()
    {
        return view('verify-email');
    }

    public function showForgotPassword()
    {
        return view('forgot-password');
    }

    public function updateProfile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|string|max:255',
            'profile_photo' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:6144',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()->all(),
            ]);
        }

        $user = Auth::user();


        if ($request->has('name')) {
            $user->name = $request->name;
        }


        if ($request->hasFile('profile_photo')) {
            $file = $request->file('profile_photo');
            $user->profile_photo_base64 = base64_encode(file_get_contents($file->getRealPath()));
        }

        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Profile updated successfully!'
        ]);
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required'],
            'new_password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = Auth::user();


        if (!Hash::check($request->current_password, $user->password)) {
            return back()->with('error', 'Current password is incorrect');
        }


        $user->password = Hash::make($request->new_password);
        $user->save();

        return back()->with('success', 'Password updated successfully!');
    }

    public function signIn(Request $request)
    {
        $incomingFields = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required'
        ], [
            'email.required' => 'The email field is required.',
            'email.email' => 'Enter a valid email address.',
        ]);

        if (auth()->attempt([
            'email' => $incomingFields['email'],
            'password' => $incomingFields['password']
        ])) {
            $request->session()->regenerate();
            return redirect('/dashboard');
        }

        return back()->with('error', 'Incorrect email or password.');
    }

    public function logout()
    {
        auth()->logout();
        return redirect('/');
    }
}
