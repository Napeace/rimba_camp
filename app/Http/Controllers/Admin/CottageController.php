<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cottage;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CottageController extends Controller
{
    /**
     * Display a listing of the cottages.
     */
    public function index(Request $request)
    {
        $query = Cottage::query();

        // Search functionality
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nomor', 'like', "%{$search}%")
                  ->orWhere('fasilitas', 'like', "%{$search}%");
            });
        }

        // Filter by capacity
        if ($request->has('capacity') && !empty($request->capacity)) {
            $query->where('kapasitas', '>=', $request->capacity);
        }

        // Filter by price range
        if ($request->has('min_price') && !empty($request->min_price)) {
            $query->where('harga_per_malam', '>=', $request->min_price);
        }
        if ($request->has('max_price') && !empty($request->max_price)) {
            $query->where('harga_per_malam', '<=', $request->max_price);
        }

        // Filter by status
        if ($request->has('status') && !empty($request->status)) {
            $query->where('status', $request->status);
        }

        // Sort
        $sortBy = $request->get('sort_by', 'nomor');
        $sortOrder = $request->get('sort_order', 'asc');
        $query->orderBy($sortBy, $sortOrder);

        $cottages = $query->paginate(10)->withQueryString();

        return view('admin.cottages.index', compact('cottages'));
    }

    /**
     * Show the form for creating a new cottage.
     */
    public function create()
    {
        return view('admin.cottages.create');
    }

    /**
     * Store a newly created cottage in storage.
     */
    public function store(Request $request)
    {
        // Debug: Log request data
        \Log::info('Cottage Store Request:', $request->all());

        try {
            $validatedData = $request->validate([
                'nomor' => 'required|string|max:100|unique:cottages,nomor',
                'kapasitas' => 'required|integer|min:1|max:20',
                'fasilitas' => 'required|string',
                'harga_per_malam' => 'required|integer|min:50000|max:2000000',
            ], [
                'nomor.required' => 'Nomor cottage harus diisi',
                'nomor.unique' => 'Nomor cottage sudah digunakan',
                'kapasitas.required' => 'Kapasitas harus diisi',
                'kapasitas.min' => 'Kapasitas minimal 1 orang',
                'kapasitas.max' => 'Kapasitas maksimal 20 orang',
                'fasilitas.required' => 'Fasilitas harus diisi',
                'harga_per_malam.required' => 'Harga per malam harus diisi',
                'harga_per_malam.min' => 'Harga minimal Rp 50.000',
                'harga_per_malam.max' => 'Harga maksimal Rp 2.000.000',
            ]);

            // Set default status as 'aktif'
            $validatedData['status'] = 'aktif';

            $cottage = Cottage::create($validatedData);

            \Log::info('Cottage created successfully:', $cottage->toArray());

            return redirect()->route('admin.cottages.index')
                ->with('success', 'Cottage berhasil ditambahkan!');

        } catch (\Illuminate\Validation\ValidationException $e) {
            \Log::error('Validation Error:', $e->errors());
            return redirect()->back()
                ->withErrors($e->errors())
                ->withInput();
        } catch (\Exception $e) {
            \Log::error('Error creating cottage:', ['error' => $e->getMessage()]);
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat menyimpan cottage: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified cottage.
     */
    public function show(Cottage $cottage)
    {
        // PERBAIKAN: Gunakan method relasi 'reservasi' sesuai dengan model
        $cottage->load(['reservasi' => function ($query) {
            $query->with('user')->latest()->take(10);
        }]);

        return view('admin.cottages.show', compact('cottage'));
    }

    /**
     * Show the form for editing the specified cottage.
     */
    public function edit(Cottage $cottage)
    {
        return view('admin.cottages.edit', compact('cottage'));
    }

    /**
     * Update the specified cottage in storage.
     */
    public function update(Request $request, Cottage $cottage)
    {
        // Debug: Log request data
        \Log::info('Cottage Update Request:', $request->all());
        \Log::info('Current Cottage Data:', $cottage->toArray());

        try {
            $validatedData = $request->validate([
                'nomor' => [
                    'required',
                    'string',
                    'max:100',
                    Rule::unique('cottages', 'nomor')->ignore($cottage->id),
                ],
                'kapasitas' => 'required|integer|min:1|max:20',
                'fasilitas' => 'required|string',
                'harga_per_malam' => 'required|integer|min:50000|max:2000000',
                'status' => 'nullable|in:aktif,nonaktif',
            ], [
                'nomor.required' => 'Nomor cottage harus diisi',
                'nomor.unique' => 'Nomor cottage sudah digunakan',
                'kapasitas.required' => 'Kapasitas harus diisi',
                'kapasitas.min' => 'Kapasitas minimal 1 orang',
                'kapasitas.max' => 'Kapasitas maksimal 20 orang',
                'fasilitas.required' => 'Fasilitas harus diisi',
                'harga_per_malam.required' => 'Harga per malam harus diisi',
                'harga_per_malam.min' => 'Harga minimal Rp 50.000',
                'harga_per_malam.max' => 'Harga maksimal Rp 2.000.000',
                'status.in' => 'Status harus aktif atau nonaktif',
            ]);

            // Jika status tidak ada di form, gunakan status yang sudah ada
            if (!isset($validatedData['status'])) {
                $validatedData['status'] = $cottage->status;
            }

            // Update cottage dengan data yang sudah divalidasi
            $cottage->update($validatedData);

            \Log::info('Cottage updated successfully:', $cottage->fresh()->toArray());

            return redirect()->route('admin.cottages.index')
                ->with('success', 'Cottage berhasil diperbarui!');

        } catch (\Illuminate\Validation\ValidationException $e) {
            \Log::error('Validation Error:', $e->errors());
            return redirect()->back()
                ->withErrors($e->errors())
                ->withInput();
        } catch (\Exception $e) {
            \Log::error('Error updating cottage:', [
                'error' => $e->getMessage(),
                'cottage_id' => $cottage->id,
                'request_data' => $request->all()
            ]);
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat memperbarui cottage: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Toggle cottage status (aktif/nonaktif).
     */
    public function toggleStatus(Cottage $cottage)
    {
        try {
            // Check if cottage has active reservations when trying to deactivate
            if ($cottage->status === 'aktif') {
                // PERBAIKAN: Gunakan method relasi 'reservasi' sesuai dengan model
                $activeReservations = $cottage->reservasi()
                    ->whereIn('status_reservasi', ['disetujui', 'checked_in'])
                    ->count();

                if ($activeReservations > 0) {
                    return redirect()->route('admin.cottages.index')
                        ->with('error', 'Cottage tidak dapat dinonaktifkan karena masih memiliki reservasi aktif!');
                }
            }

            $cottage->toggleStatus();

            $status = $cottage->fresh()->status;
            $statusText = $status === 'aktif' ? 'diaktifkan' : 'dinonaktifkan';

            return redirect()->route('admin.cottages.index')
                ->with('success', "Cottage berhasil {$statusText}!");

        } catch (\Exception $e) {
            \Log::error('Error toggling cottage status:', [
                'error' => $e->getMessage(),
                'cottage_id' => $cottage->id
            ]);
            return redirect()->route('admin.cottages.index')
                ->with('error', 'Terjadi kesalahan saat mengubah status cottage!');
        }
    }

    /**
     * Remove the specified cottage from storage.
     */
    public function destroy(Cottage $cottage)
    {
        try {
            // PERBAIKAN: Gunakan method relasi 'reservasi' sesuai dengan model
            $hasReservations = $cottage->reservasi()->count() > 0;

            if ($hasReservations) {
                return redirect()->route('admin.cottages.index')
                    ->with('error', 'Cottage tidak dapat dihapus karena memiliki riwayat reservasi!');
            }

            $cottage->delete();

            return redirect()->route('admin.cottages.index')
                ->with('success', 'Cottage berhasil dihapus!');

        } catch (\Exception $e) {
            \Log::error('Error deleting cottage:', [
                'error' => $e->getMessage(),
                'cottage_id' => $cottage->id
            ]);
            return redirect()->route('admin.cottages.index')
                ->with('error', 'Terjadi kesalahan saat menghapus cottage!');
        }
    }

    /**
     * Check cottage availability
     */
    public function checkAvailability(Request $request, Cottage $cottage)
    {
        try {
            $request->validate([
                'checkin' => 'required|date|after_or_equal:today',
                'checkout' => 'required|date|after:checkin',
            ]);

            $isAvailable = $cottage->isAvailable($request->checkin, $request->checkout);

            return response()->json([
                'available' => $isAvailable,
                'message' => $isAvailable
                    ? 'Cottage tersedia untuk tanggal tersebut'
                    : 'Cottage tidak tersedia untuk tanggal tersebut'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'available' => false,
                'message' => 'Terjadi kesalahan saat mengecek ketersediaan'
            ], 500);
        }
    }

    /**
     * Get cottage statistics
     */
    public function statistics()
    {
        try {
            $stats = [
                'total_cottages' => Cottage::count(),
                'active_cottages' => Cottage::where('status', 'aktif')->count(),
                'inactive_cottages' => Cottage::where('status', 'nonaktif')->count(),
                'avg_capacity' => round(Cottage::avg('kapasitas'), 1),
                'avg_price' => round(Cottage::avg('harga_per_malam')),
                'min_price' => Cottage::min('harga_per_malam'),
                'max_price' => Cottage::max('harga_per_malam'),
                'capacity_distribution' => Cottage::selectRaw('kapasitas, COUNT(*) as count')
                    ->groupBy('kapasitas')
                    ->orderBy('kapasitas')
                    ->get(),
                'status_distribution' => Cottage::selectRaw('status, COUNT(*) as count')
                    ->groupBy('status')
                    ->get(),
            ];

            return response()->json($stats);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Gagal mengambil statistik cottage'], 500);
        }
    }
}
