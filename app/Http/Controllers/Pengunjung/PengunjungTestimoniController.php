<?php

namespace App\Http\Controllers\Pengunjung;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Testimoni;
use App\Models\Reservasi;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PengunjungTestimoniController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $testimonis = Testimoni::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pengunjung.testimoni.index', compact('testimonis'));
    }

    public function create()
    {
        return view('pengunjung.testimoni.create');
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'isi' => 'required|string|max:1000',
        ]);

        $testimoni = new Testimoni();
        $testimoni->user_id = $user->id;
        $testimoni->isi = $request->isi;
        $testimoni->status = 'aktif';
        $testimoni->save();

        return redirect()->route('pengunjung.testimoni.index')
            ->with('success', 'Testimoni berhasil ditambahkan. Terima kasih atas ulasan Anda!');
    }
}
