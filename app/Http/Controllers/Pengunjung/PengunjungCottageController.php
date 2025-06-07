<?php

namespace App\Http\Controllers\Pengunjung;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cottage;
use App\Models\Reservasi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PengunjungCottageController extends Controller
{
    /**
     * Display a listing of cottages
     */
    public function index(Request $request)
    {
        $query = Cottage::where('status', 'aktif');

        // Filter berdasarkan tanggal check-in dan check-out
        $check_in = $request->input('check_in');
        $check_out = $request->input('check_out');

        if ($check_in && $check_out) {
            // Validasi tanggal
            $checkinDate = \Carbon\Carbon::parse($check_in);
            $checkoutDate = \Carbon\Carbon::parse($check_out);

            if ($checkinDate >= $checkoutDate) {
                return back()->withErrors(['date' => 'Tanggal check-out harus setelah tanggal check-in']);
            }

            // Ambil ID cottage yang memiliki reservasi bentrok
            $reservedCottageIds = Reservasi::whereIn('status_reservasi', [
                \App\Models\Reservasi::STATUS_DISETUJUI,
                \App\Models\Reservasi::STATUS_MENUNGGU
            ])
                ->where(function ($query) use ($checkinDate, $checkoutDate) {
                    // Reservasi yang bentrok adalah yang:
                    // 1. Check-in pada periode yang dipilih
                    // 2. Check-out pada periode yang dipilih  
                    // 3. Melingkupi periode yang dipilih
                    $query->where(function ($dateQuery) use ($checkinDate, $checkoutDate) {
                        $dateQuery->whereBetween('tanggal_checkin', [$checkinDate->toDateString(), $checkoutDate->toDateString()])
                            ->orWhereBetween('tanggal_checkout', [$checkinDate->toDateString(), $checkoutDate->toDateString()])
                            ->orWhere(function ($overlapQuery) use ($checkinDate, $checkoutDate) {
                                $overlapQuery->where('tanggal_checkin', '<=', $checkinDate->toDateString())
                                    ->where('tanggal_checkout', '>=', $checkoutDate->toDateString());
                            });
                    });
                })
                ->pluck('cottage_id')
                ->toArray();

            // Exclude cottage yang sudah dibooking
            $query->whereNotIn('id', $reservedCottageIds);
        }

        // Filter berdasarkan kapasitas
        $kapasitas = $request->input('kapasitas');
        if ($kapasitas) {
            $query->where('kapasitas', '>=', $kapasitas);
        }

        // Filter berdasarkan harga minimal
        $harga_min = $request->input('harga_min');
        if ($harga_min) {
            $query->where('harga_per_malam', '>=', $harga_min);
        }

        // Filter berdasarkan harga maksimal
        $harga_max = $request->input('harga_max');
        if ($harga_max) {
            $query->where('harga_per_malam', '<=', $harga_max);
        }

        // Filter berdasarkan fasilitas
        $fasilitas = $request->input('fasilitas');
        if ($fasilitas) {
            $query->where('fasilitas', 'LIKE', '%' . $fasilitas . '%');
        }

        // Ambil data cottage dan urutkan berdasarkan nomor
        $cottages = $query->orderBy('nomor', 'asc')->get();

        return view('pengunjung.cottage.index', compact('cottages'));
    }

    /**
     * Display the specified cottage
     */
    public function show($id)
    {
        $cottage = Cottage::where('id', $id)->where('status', 'aktif')->firstOrFail();
        return view('pengunjung.cottage.show', compact('cottage'));
    }

    /**
     * Show the form for creating a new reservation
     */
    public function reserve($id, Request $request)
    {
        $cottage = Cottage::where('id', $id)->where('status', 'aktif')->firstOrFail();

        // Ambil tanggal dari parameter jika ada
        $check_in = $request->input('check_in');
        $check_out = $request->input('check_out');

        return view('pengunjung.cottage.reserve', compact('cottage', 'check_in', 'check_out'));
    }

    /**
     * Store a newly created reservation
     */
    public function storeReservation(Request $request)
    {
        $request->validate([
            'cottage_id' => 'required|exists:cottages,id',
            'tanggal_checkin' => 'required|date|after_or_equal:today',
            'tanggal_checkout' => 'required|date|after:tanggal_checkin',
            'jumlah_tamu' => 'required|integer|min:1',
            'bukti_pembayaran' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'catatan' => 'nullable|string|max:500'
        ]);

        // Check cottage capacity
        $cottage = Cottage::findOrFail($request->cottage_id);
        if ($request->jumlah_tamu > $cottage->kapasitas) {
            return back()->withErrors(['jumlah_tamu' => 'Jumlah tamu melebihi kapasitas cottage']);
        }

        // Check availability untuk tanggal yang dipilih
        $checkinDate = \Carbon\Carbon::parse($request->tanggal_checkin);
        $checkoutDate = \Carbon\Carbon::parse($request->tanggal_checkout);

        $hasConflict = Reservasi::where('cottage_id', $request->cottage_id)
            ->whereIn('status_reservasi', [
                \App\Models\Reservasi::STATUS_DISETUJUI,
                \App\Models\Reservasi::STATUS_MENUNGGU
            ])
            ->where(function ($query) use ($request) {
                $query->where(function ($dateQuery) use ($request) {
                    $dateQuery->whereBetween('tanggal_checkin', [$request->tanggal_checkin, $request->tanggal_checkout])
                        ->orWhereBetween('tanggal_checkout', [$request->tanggal_checkin, $request->tanggal_checkout])
                        ->orWhere(function ($overlapQuery) use ($request) {
                            $overlapQuery->where('tanggal_checkin', '<=', $request->tanggal_checkin)
                                ->where('tanggal_checkout', '>=', $request->tanggal_checkout);
                        });
                });
            })
            ->exists();

        if ($hasConflict) {
            return back()->withErrors(['tanggal' => 'Cottage tidak tersedia untuk tanggal yang dipilih. Silakan pilih tanggal lain.']);
        }

        // Calculate total days and price
        $total_hari = $checkinDate->diffInDays($checkoutDate);
        $total_harga = $total_hari * $cottage->harga_per_malam;

        // Upload bukti pembayaran
        $buktiPath = $request->file('bukti_pembayaran')->store('bukti_pembayaran', 'public');

        // Create reservation
        $reservasi = Reservasi::create([
            'user_id' => Auth::id(),
            'cottage_id' => $request->cottage_id,
            'tanggal_checkin' => $request->tanggal_checkin,
            'tanggal_checkout' => $request->tanggal_checkout,
            'status_reservasi' => \App\Models\Reservasi::STATUS_MENUNGGU,
            'bukti_pembayaran' => $buktiPath,
        ]);

        return redirect()->route('cottage.reservasi.show', $reservasi->id)
            ->with('success', 'Reservasi berhasil dibuat! Menunggu konfirmasi admin.');
    }

    /**
     * Display reservation history
     */
    public function riwayatReservasi()
    {
        $reservasi = Reservasi::with('cottage')
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('pengunjung.cottage.riwayat', compact('reservasi'));
    }

    /**
     * Display specific reservation
     */
    public function showReservasi($id)
    {
        $reservasi = Reservasi::with('cottage')
            ->where('user_id', Auth::id())
            ->where('id', $id)
            ->firstOrFail();

        return view('pengunjung.cottage.detail-reservasi', compact('reservasi'));
    }

    /**
     * Check cottage availability via AJAX
     */
    public function checkAvailability(Request $request)
    {
        $request->validate([
            'cottage_id' => 'required|exists:cottages,id',
            'check_in' => 'required|date|after_or_equal:today',
            'check_out' => 'required|date|after:check_in',
        ]);

        $cottage = Cottage::find($request->cottage_id);
        $checkIn = $request->check_in;
        $checkOut = $request->check_out;

        // Cek apakah ada reservasi yang bentrok
        $hasConflict = Reservasi::where('cottage_id', $request->cottage_id)
            ->whereIn('status_reservasi', [
                \App\Models\Reservasi::STATUS_DISETUJUI,
                \App\Models\Reservasi::STATUS_MENUNGGU
            ])
            ->where(function ($query) use ($checkIn, $checkOut) {
                $query->where(function ($dateQuery) use ($checkIn, $checkOut) {
                    $dateQuery->whereBetween('tanggal_checkin', [$checkIn, $checkOut])
                        ->orWhereBetween('tanggal_checkout', [$checkIn, $checkOut])
                        ->orWhere(function ($overlapQuery) use ($checkIn, $checkOut) {
                            $overlapQuery->where('tanggal_checkin', '<=', $checkIn)
                                ->where('tanggal_checkout', '>=', $checkOut);
                        });
                });
            })
            ->exists();

        return response()->json([
            'available' => !$hasConflict,
            'message' => $hasConflict ?
                'Cottage tidak tersedia untuk tanggal tersebut' :
                'Cottage tersedia untuk tanggal tersebut',
            'cottage_name' => $cottage->nomor,
            'price_per_night' => $cottage->harga_per_malam
        ]);
    }
}
