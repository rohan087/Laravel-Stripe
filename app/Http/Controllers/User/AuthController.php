<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    /**
     * Show the login form.
     */
    public function showLoginForm()
    {
        return view('user.auth.login'); // Ensure this view exists
    }

    /**
     * Show the login form or redirect to the dashboard if authenticated.
     */
    public function index()
    {
        if (Auth::guard('web')->check()) {
            return redirect()->route('user.index');
        }

        return view('user.auth.login');
    }

    /**
     * Handle the user login request.
     */
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

    /**
     * Handle the user logout request.
     */
    public function logout()
    {
        Auth::guard('web')->logout();
        return redirect()->route('user.login')->with('success', 'Logged out successfully.');
    }
}
