<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Artikel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ArtikelController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $validated['user_id'] = auth()->id();

        // Strip semua HTML tags dari konten
        $validated['isi'] = strip_tags($validated['isi']);

        // Atau jika ingin tetap mempertahankan line breaks
        // $validated['isi'] = $this->stripHtmlButKeepFormatting($validated['isi']);

        // Handle file upload
        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('artikel', 'public');
        }

        Artikel::create($validated);

        return redirect()->route('admin.artikel.index')
            ->with('success', 'Artikel berhasil dibuat!');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Artikel $artikel)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Strip semua HTML tags dari konten
        $validated['isi'] = strip_tags($validated['isi']);

        // Handle image removal
        if ($request->has('remove_image') && $request->remove_image == '1') {
            if ($artikel->gambar) {
                Storage::disk('public')->delete($artikel->gambar);
                $validated['gambar'] = null;
            }
        }

        // Handle new file upload
        if ($request->hasFile('gambar')) {
            if ($artikel->gambar && !($request->has('remove_image') && $request->remove_image == '1')) {
                Storage::disk('public')->delete($artikel->gambar);
            }
            $validated['gambar'] = $request->file('gambar')->store('artikel', 'public');
        }

        $artikel->update($validated);

        return redirect()->route('admin.artikel.index')
            ->with('success', 'Artikel berhasil diperbarui!');
    }

    /**
     * Strip HTML tags but preserve basic formatting
     */
    private function stripHtmlButKeepFormatting($content)
    {
        // Konversi <br> dan <p> menjadi line breaks
        $content = str_replace(['<br>', '<br/>', '<br />', '</p>'], "\n", $content);
        $content = str_replace('<p>', '', $content);

        // Strip semua HTML tags lainnya
        $content = strip_tags($content);

        // Bersihkan multiple line breaks
        $content = preg_replace("/\n+/", "\n", $content);

        // Trim whitespace
        return trim($content);
    }

    // ... method lainnya tetap sama
    public function index(Request $request)
    {
        $query = Artikel::with('user')->latest();

        if ($request->filled('search')) {
            $query->where('judul', 'like', '%' . $request->search . '%');
        }

        $artikel = $query->paginate(10)->withQueryString();

        return view('admin.artikel.index', compact('artikel'));
    }

    public function create()
    {
        return view('admin.artikel.create');
    }

    public function show(Artikel $artikel)
    {
        return view('admin.artikel.show', compact('artikel'));
    }

    public function edit(Artikel $artikel)
    {
        return view('admin.artikel.edit', compact('artikel'));
    }

    public function destroy(Artikel $artikel)
    {
        if ($artikel->gambar) {
            Storage::disk('public')->delete($artikel->gambar);
        }

        $artikel->delete();

        return redirect()->route('admin.artikel.index')
            ->with('success', 'Artikel berhasil dihapus!');
    }
}
