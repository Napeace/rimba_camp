<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::guard('admin')->check()) {
            return redirect()->route('admin.login')
                ->withErrors(['access' => 'Silakan login terlebih dahulu']);
        }

        if (!Auth::guard('admin')->user()->isAdmin()) {
            Auth::guard('admin')->logout();
            return redirect()->route('admin.login')
                ->withErrors(['access' => 'Anda tidak memiliki akses admin']);
        }

        return $next($request);
    }
}
