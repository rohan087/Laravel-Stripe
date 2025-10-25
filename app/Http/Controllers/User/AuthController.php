<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('user.auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('web')->attempt($request->only('email', 'password'))) {
            return redirect()->route('user.index')->with('success', 'Logged in successfully.');
        }

        return back()->withErrors(['email' => 'Invalid credentials.']);
    }

    public function logout()
    {
        Auth::guard('web')->logout();
        return redirect('/user/login')->with('success', 'Logged out successfully.');
    }
}
