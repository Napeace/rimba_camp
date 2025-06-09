<?php

namespace App\Http\Controllers\Pengunjung;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Artikel;

class PengunjungArtikelController extends Controller
{
    /**
     * Display a listing of articles.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $artikel = Artikel::latest()->paginate(9);
        return view('pengunjung.artikel.index', compact('artikel'));
    }

    /**
     * Display the specified article.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $artikel = Artikel::findOrFail($id);

        // Get related articles (same category or latest)
        $relatedArticles = Artikel::where('id', '!=', $id)
            ->latest()
            ->take(3)
            ->get();

        return view('pengunjung.artikel.detail', compact('artikel', 'relatedArticles'));
    }
}
