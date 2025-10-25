<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo($request): ?string
    {
        if (!$request->expectsJson()) {
            // Redirect to admin login if the request is for admin routes
            if ($request->is('admin/*')) {
                return route('admin.login');
            }

            // Redirect to user login if the request is for user routes
            if ($request->is('user/*')) {
                return route('user.login');
            }

            // Default redirect for other routes
            return route('home'); // Ensure this route exists
        }
    }
}
