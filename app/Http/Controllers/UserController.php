<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
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
