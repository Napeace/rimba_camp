<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class GaleriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $galeris = Galeri::with('user')
            ->latest()
            ->paginate(12);

        return view('admin.galeri.index', compact('galeris'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.galeri.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'deskripsi' => 'required|string|max:1000',
        ]);

        try {
            $file = $request->file('image');
            $fileName = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();

            // Simpan file ke storage/app/public/galeri
            $file->storeAs('public/galeri', $fileName);

            Galeri::create([
                'nama_file' => $fileName,
                'deskripsi' => $request->deskripsi,
                'user_id' => Auth::id(),
            ]);

            return redirect()->route('admin.galeri.index')
                ->with('success', 'Galeri berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat menambahkan galeri.')
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Galeri $galeri)
    {
        return view('admin.galeri.show', compact('galeri'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Galeri $galeri)
    {
        return view('admin.galeri.edit', compact('galeri'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Galeri $galeri)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'deskripsi' => 'required|string|max:1000',
        ]);

        try {
            $data = [
                'deskripsi' => $request->deskripsi,
            ];

            // Jika ada file gambar baru
            if ($request->hasFile('image')) {
                // Hapus file lama
                if (Storage::exists('public/galeri/' . $galeri->nama_file)) {
                    Storage::delete('public/galeri/' . $galeri->nama_file);
                }

                // Upload file baru
                $file = $request->file('image');
                $fileName = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
                $file->storeAs('public/galeri', $fileName);

                $data['nama_file'] = $fileName;
            }

            $galeri->update($data);

            return redirect()->route('admin.galeri.index')
                ->with('success', 'Galeri berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat memperbarui galeri.')
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Galeri $galeri)
    {
        try {
            // Hapus file dari storage
            if (Storage::exists('public/galeri/' . $galeri->nama_file)) {
                Storage::delete('public/galeri/' . $galeri->nama_file);
            }

            $galeri->delete();

            return redirect()->route('admin.galeri.index')
                ->with('success', 'Galeri berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat menghapus galeri.');
        }
    }
}
