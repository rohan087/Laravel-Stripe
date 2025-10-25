<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    /**
     * Show the login form or redirect to the dashboard if authenticated.
     */
    public function index()
    {
        if (Auth::check() && Auth::user()->hasRole('admin')) {
            return redirect()->route('admin.dashboard'); // Redirect to dashboard if logged in
        }

        return view('admin.auth.login'); // Show login form if not authenticated
    }

    /**
     * Handle the admin login request.
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('admin')->attempt($request->only('email', 'password'))) {
            return redirect()->route('admin.dashboard')->with('success', 'Logged in successfully.');
        }

        return back()->withErrors(['email' => 'Invalid credentials.']);
    }

    /**
     * Handle the admin logout request.
     */
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login')->with('success', 'Logged out successfully.');
    }
}
