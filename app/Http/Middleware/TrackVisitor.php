<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Statistik;
use Symfony\Component\HttpFoundation\Response;

class TrackVisitor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Hanya track untuk route publik (bukan admin)
        if (!$request->is('admin/*') && !$request->is('api/*')) {
            // Check apakah sudah pernah visit hari ini menggunakan session
            $visitedToday = session('visited_today', false);

            if (!$visitedToday) {
                // Tambah statistik pengunjung
                Statistik::tambahPengunjung();

                // Set session agar tidak double count
                session(['visited_today' => true]);

                // Set session expired at end of day
                $midnight = now()->endOfDay();
                session(['visited_today_expires' => $midnight]);
            }
        }

        return $next($request);
    }
}
