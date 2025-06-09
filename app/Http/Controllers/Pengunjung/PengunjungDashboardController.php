<?php

namespace App\Http\Controllers\Pengunjung;

use App\Http\Controllers\Controller;
use App\Models\Cottage;
use App\Models\Artikel;
use App\Models\Statistik;
use App\Models\Testimoni;
use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class PengunjungDashboardController extends Controller
{
    public function index()
    {
        $cottages = $this->getCottagesWithViewData()->take(3);
        $artikels = Artikel::with('user')
            ->latest()
            ->take(3)
            ->get()
            ->map(function ($artikel) {
                return (object) [
                    'id' => $artikel->id,
                    'title' => $artikel->judul,
                    'content' => $artikel->isi,
                    'excerpt' => $artikel->excerpt,
                    'image_url' => $artikel->gambar ? asset('storage/artikel/' . $artikel->gambar) : null,
                    'author' => $artikel->user->name ?? 'Admin',
                    'created_at' => $artikel->created_at,
                ];
            });

        // Ambil data galeri terbaru
        $galeris = Galeri::latest()
            ->take(3)
            ->get();

        // Ambil statistik untuk dashboard
        $statistiks = $this->getStatistiksData();

        // Ambil testimoni aktif
        $testimonials = Testimoni::aktif()
            ->with('user')
            ->latest()
            ->take(3)
            ->get();

        return view('pengunjung.landing', compact('cottages', 'artikels', 'statistiks', 'testimonials', 'galeris'));
    }

    private function getCottagesWithViewData()
    {
        return Cottage::active()
            ->get()
            ->map(function ($cottage) {
                return (object) [
                    'id' => $cottage->id,
                    'name' => $cottage->nama ?? "Cottage " . $cottage->nomor,
                    'category' => $cottage->kategori,
                    'capacity' => $cottage->kapasitas,
                    'price' => $cottage->harga_per_malam / 1000,
                    'rating' => $cottage->rating ?? 4.5,
                    'bed_type' => $cottage->tipe_tempat_tidur,
                    'bathroom' => $cottage->tipe_kamar_mandi,
                    'view' => $cottage->pemandangan,
                    'facilities' => $cottage->fasilitas,
                    'status' => $cottage->status,
                ];
            });
    }

    private function getStatistiksData()
    {
        $totalPengunjung = Statistik::totalPengunjung();
        $totalCottages = Cottage::active()->count();
        $totalArtikel = Artikel::count();
        $totalTestimoni = Testimoni::aktif()->count();

        return collect([
            (object) [
                'label' => 'Pengunjung',
                'value' => $totalPengunjung > 0 ? $totalPengunjung : 1,
            ],
            (object) [
                'label' => 'Cottages',
                'value' => $totalCottages > 0 ? $totalCottages : 0,
            ],
            (object) [
                'label' => 'Artikel',
                'value' => $totalArtikel > 0 ? $totalArtikel : 0,
            ],
            (object) [
                'label' => 'Testimoni Pengunjung',
                'value' => $totalTestimoni > 0 ? $totalTestimoni : 0,
            ],
        ]);
    }

    public function profile()
    {
        $user = Auth::user();
        return view('pengunjung.profile.index', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'phone' => ['nullable', 'string', 'max:20'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('pengunjung.profile')->with('success', 'Profil berhasil diperbarui.');
    }
}
