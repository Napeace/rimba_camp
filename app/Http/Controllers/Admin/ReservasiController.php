<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservasi;
use App\Models\Cottage;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class ReservasiController extends Controller
{
    /**
     * Display a listing of the reservations.
     */
    public function index(Request $request): View
    {
        // PERBAIKAN: Query dengan eager loading yang benar
        $query = Reservasi::with(['user', 'cottage'])
            ->orderBy('created_at', 'desc');

        // Filter berdasarkan status
        if ($request->filled('status')) {
            $query->byStatus($request->status);
        }

        // PERBAIKAN: Filter cottage menggunakan foreign key yang benar
        if ($request->filled('cottage_id')) {
            $query->where('cottage_id', $request->cottage_id);
        }

        // Filter berdasarkan tanggal
        if ($request->filled('start_date')) {
            $query->where('tanggal_checkin', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $query->where('tanggal_checkout', '<=', $request->end_date);
        }

        // Search berdasarkan nama user atau email
        if ($request->filled('search')) {
            $query->search($request->search);
        }

        $reservasis = $query->paginate(10)->appends($request->all());

        // PERBAIKAN: Statistik dengan status yang benar
        $statistics = [
            'total' => Reservasi::count(),
            'menunggu_konfirmasi' => Reservasi::where('status_reservasi', Reservasi::STATUS_MENUNGGU)->count(),
            'disetujui' => Reservasi::where('status_reservasi', Reservasi::STATUS_DISETUJUI)->count(),
            'ditolak' => Reservasi::where('status_reservasi', Reservasi::STATUS_DITOLAK)->count(),
        ];

        // Data untuk filter dropdown
        $cottages = Cottage::where('status', 'aktif')->orderBy('nomor')->get();
        $statusList = Reservasi::getStatusList();

        return view('admin.reservasi.index', compact(
            'reservasis',
            'statistics',
            'cottages',
            'statusList'
        ));
    }

    /**
     * Update status reservasi
     */
    public function updateStatus(Request $request, Reservasi $reservasi): JsonResponse
    {
        // PERBAIKAN: Validasi yang lebih ketat
        try {
            $request->validate([
                'status' => 'required|string|in:' . implode(',', array_keys(Reservasi::getStatusList())),
            ]);

            $oldStatus = $reservasi->status_reservasi;

            // PERBAIKAN: Update dengan method yang lebih aman
            $reservasi->status_reservasi = $request->status;
            $reservasi->save();

            // PERBAIKAN: Refresh model untuk mendapatkan data terbaru
            $reservasi->refresh();

            return response()->json([
                'success' => true,
                'message' => 'Status reservasi berhasil diperbarui dari ' . $oldStatus . ' ke ' . $request->status,
                'data' => [
                    'id' => $reservasi->id,
                    'old_status' => $oldStatus,
                    'new_status' => $reservasi->status_reservasi,
                    'status_label' => $reservasi->status_label,
                    'status_badge_class' => $reservasi->status_badge_class,
                ]
            ], 200);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak valid: ' . implode(', ', $e->validator->errors()->all()),
                'errors' => $e->validator->errors()
            ], 422);

        } catch (\Exception $e) {
            // PERBAIKAN: Log error untuk debugging
            \Log::error('Error updating reservation status: ' . $e->getMessage(), [
                'reservation_id' => $reservasi->id,
                'requested_status' => $request->status,
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui status reservasi. Silakan coba lagi.',
                'error' => config('app.debug') ? $e->getMessage() : 'Internal server error'
            ], 500);
        }
    }

    /**
     * Get reservation details for modal
     */
    public function show(Reservasi $reservasi): JsonResponse
    {
        // PERBAIKAN: Load relasi dengan benar
        $reservasi->load(['user', 'cottage']);

        return response()->json([
            'success' => true,
            'data' => [
                'id' => $reservasi->id,
                'user' => [
                    'name' => $reservasi->user ? $reservasi->user->name : 'User tidak ditemukan',
                    'email' => $reservasi->user ? $reservasi->user->email : 'Email tidak tersedia',
                ],
                'cottage' => $reservasi->cottage ? [
                    'nomor' => $reservasi->cottage->nomor,
                    'kapasitas' => $reservasi->cottage->kapasitas,
                    'fasilitas' => $reservasi->cottage->fasilitas,
                    'harga_per_malam' => $reservasi->cottage->harga_per_malam,
                ] : [
                    'nomor' => 'N/A',
                    'kapasitas' => 0,
                    'fasilitas' => '',
                    'harga_per_malam' => 0,
                ],
                'tanggal_checkin' => $reservasi->tanggal_checkin->format('d/m/Y'),
                'tanggal_checkout' => $reservasi->tanggal_checkout->format('d/m/Y'),
                'durasi_menginap' => $reservasi->durasi_menginap,
                'status_reservasi' => $reservasi->status_reservasi,
                'status_label' => $reservasi->status_label,
                'bukti_pembayaran' => $reservasi->bukti_pembayaran,
                'created_at' => $reservasi->created_at->format('d/m/Y H:i'),
            ]
        ]);
    }
}
