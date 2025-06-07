<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        if (!$request->expectsJson()) {
            // Check if the request is for pengunjung routes
            if ($request->is('pengunjung/*') || $request->is('cottage/*')) {
                return route('pengunjung.login'); // Assuming this is the pengunjung login route name
            }
            return route('admin.login');
        }
        return null;
    }
}
