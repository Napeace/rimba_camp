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
        $galeri = Galeri::latest()->paginate(12);
        return view('pengunjung.galeri.index', compact('galeri'));
    }

    /**
     * Display the specified gallery item.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
}
