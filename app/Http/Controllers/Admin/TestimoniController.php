<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimoni;
use Illuminate\Http\Request;

class TestimoniController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Testimoni::with('user')->latest();

        // Filter berdasarkan status jika ada
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        // Search berdasarkan nama user atau isi testimoni
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('isi', 'like', '%' . $search . '%')
                  ->orWhereHas('user', function($userQuery) use ($search) {
                      $userQuery->where('name', 'like', '%' . $search . '%');
                  });
            });
        }

        $testimonis = $query->paginate(10);

        // Ambil statistik keseluruhan (tidak terpengaruh filter)
        $totalTestimonis = Testimoni::count();
        $activeTestimonis = Testimoni::where('status', 'aktif')->count();
        $inactiveTestimonis = Testimoni::where('status', 'nonaktif')->count();

        return view('admin.testimoni.index', compact(
            'testimonis',
            'totalTestimonis',
            'activeTestimonis',
            'inactiveTestimonis'
        ));
    }

    /**
     * Display the specified resource.
     */
    public function show(Testimoni $testimoni)
    {
        $testimoni->load('user');
        return view('admin.testimoni.show', compact('testimoni'));
    }

    /**
     * Update the specified resource status.
     */
    public function updateStatus(Request $request, Testimoni $testimoni)
    {
        $request->validate([
            'status' => 'required|in:aktif,nonaktif'
        ]);

        $testimoni->update([
            'status' => $request->status
        ]);

        $statusText = $request->status == 'aktif' ? 'diaktifkan' : 'dinonaktifkan';

        return redirect()->route('admin.testimoni.index')
            ->with('success', "Testimoni berhasil {$statusText}.");
    }

    /**
     * Get testimoni statistics
     */
    public function getStats()
    {
        $stats = [
            'total' => Testimoni::count(),
            'aktif' => Testimoni::aktif()->count(),
            'nonaktif' => Testimoni::nonaktif()->count(),
            'recent' => Testimoni::where('created_at', '>=', now()->subDays(7))->count()
        ];

        return response()->json($stats);
    }
}
