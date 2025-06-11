<?php

namespace App\Http\Controllers\Pengunjung;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Galeri;

class PengunjungGaleriController extends Controller
{
    /**
     * Display a listing of gallery items.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Ambil data galeri dengan pagination
        $galeri = Galeri::latest()->paginate(12);

        // Debugging: cek data yang diambil
        // dd($galeri->first()); // uncomment untuk debug

        return view('pengunjung.galeri.index', compact('galeri'));
    }

    /**
     * Display the specified gallery item.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $item = Galeri::findOrFail($id);
        return view('pengunjung.galeri.show', compact('item'));
    }

    /**
     * AJAX endpoint untuk like gambar
     */
    public function like($id)
    {
        try {
            $galeri = Galeri::findOrFail($id);

            // Increment likes (atau implementasi logic yang lebih kompleks)
            $currentLikes = $galeri->likes ?? 0;
            $galeri->update(['likes' => $currentLikes + 1]);

            return response()->json([
                'success' => true,
                'likes' => $galeri->likes
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memberikan like'
            ], 500);
        }
    }
}
