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
        $request->validate([
            'nomor' => 'required|string|max:100|unique:cottages,nomor',
            'kapasitas' => 'required|integer|min:1|max:20',
            'fasilitas' => 'required|string',
            'harga_per_malam' => 'required|integer|min:50000|max:2000000',
            'status' => 'required|in:aktif,nonaktif',
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
            'status.required' => 'Status harus dipilih',
            'status.in' => 'Status harus aktif atau nonaktif',
        ]);

        Cottage::create($request->all());

        return redirect()->route('admin.cottages.index')
            ->with('success', 'Cottage berhasil ditambahkan!');
    }

    /**
     * Display the specified cottage.
     */
    public function show(Cottage $cottage)
    {
        $cottage->load(['reservations' => function ($query) {
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
        $request->validate([
            'nomor' => [
                'required',
                'string',
                'max:100',
                Rule::unique('cottages', 'nomor')->ignore($cottage->id, 'id'),
            ],
            'kapasitas' => 'required|integer|min:1|max:20',
            'fasilitas' => 'required|string',
            'harga_per_malam' => 'required|integer|min:50000|max:2000000',
            'status' => 'required|in:aktif,nonaktif',
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
            'status.required' => 'Status harus dipilih',
            'status.in' => 'Status harus aktif atau nonaktif',
        ]);

        $cottage->update($request->all());

        return redirect()->route('admin.cottages.index')
            ->with('success', 'Cottage berhasil diperbarui!');
    }

    /**
     * Toggle cottage status (aktif/nonaktif).
     */
    public function toggleStatus(Cottage $cottage)
    {
        // Check if cottage has active reservations when trying to deactivate
        if ($cottage->status === 'aktif') {
            $activeReservations = $cottage->reservations()
                ->whereIn('status_reservasi', ['confirmed', 'checked_in'])
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
    }

    /**
     * Remove the specified cottage from storage.
     */
    public function destroy(Cottage $cottage)
    {
        // Check if cottage has any reservations
        $hasReservations = $cottage->reservations()->count() > 0;

        if ($hasReservations) {
            return redirect()->route('admin.cottages.index')
                ->with('error', 'Cottage tidak dapat dihapus karena memiliki riwayat reservasi!');
        }

        $cottage->delete();

        return redirect()->route('admin.cottages.index')
            ->with('success', 'Cottage berhasil dihapus!');
    }

    /**
     * Check cottage availability
     */
    public function checkAvailability(Request $request, Cottage $cottage)
    {
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
    }

    /**
     * Get cottage statistics
     */
    public function statistics()
    {
        $stats = [
            'total_cottages' => Cottage::count(),
            'active_cottages' => Cottage::where('status', 'aktif')->count(),
            'inactive_cottages' => Cottage::where('status', 'nonaktif')->count(),
            'avg_capacity' => Cottage::avg('kapasitas'),
            'avg_price' => Cottage::avg('harga_per_malam'),
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
    }
}
