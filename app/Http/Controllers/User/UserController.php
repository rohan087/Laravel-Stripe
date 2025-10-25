<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Show the user dashboard.
     */
    public function dashboard()
    {
        return view('user.dashboard'); // Ensure this view exists
    }
}
