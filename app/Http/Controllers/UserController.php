<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

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
            'password' => 'required|min:8'
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
