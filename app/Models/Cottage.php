<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Cottage extends Model
{
    use HasFactory;

    protected $fillable = [
        'nomor',
        'kapasitas',
        'fasilitas',
        'harga_per_malam',
        'status',
    ];

    protected $casts = [
        'kapasitas' => 'integer',
        'harga_per_malam' => 'integer',
    ];

    // Default attributes
    protected $attributes = [
        'status' => 'aktif',
    ];

    public function reservasi()
    {
        return $this->hasMany(Reservasi::class, 'cottage_id', 'id');
    }

    // Accessor untuk format harga
    public function getFormattedPriceAttribute()
    {
        return 'Rp ' . number_format($this->harga_per_malam, 0, ',', '.');
    }

    // Accessor untuk fasilitas array
    public function getFasilitasArrayAttribute()
    {
        return explode(', ', $this->fasilitas);
    }

    // Accessor untuk status badge
    public function getStatusBadgeAttribute()
    {
        return $this->status === 'aktif'
            ? '<span class="inline-block bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full font-medium">Aktif</span>'
            : '<span class="inline-block bg-red-100 text-red-800 text-xs px-2 py-1 rounded-full font-medium">Nonaktif</span>';
    }

    // Scopes
    public function scopeByCapacity($query, $capacity)
    {
        return $query->where('kapasitas', '>=', $capacity);
    }

    public function scopeByPriceRange($query, $min = null, $max = null)
    {
        if ($min !== null) {
            $query->where('harga_per_malam', '>=', $min);
        }
        if ($max !== null) {
            $query->where('harga_per_malam', '<=', $max);
        }
        return $query;
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'aktif');
    }

    public function scopeInactive($query)
    {
        return $query->where('status', 'nonaktif');
    }

    // Method untuk cek ketersediaan cottage dengan detail reservasi yang bentrok
    public function checkAvailabilityWithDetails($checkin, $checkout)
    {
        // Jika cottage tidak aktif
        if ($this->status !== 'aktif') {
            return [
                'available' => false,
                'message' => 'Cottage sedang tidak aktif',
                'conflicting_reservations' => []
            ];
        }

        // Pastikan format tanggal konsisten menggunakan Carbon
        $checkinDate = Carbon::parse($checkin)->format('Y-m-d');
        $checkoutDate = Carbon::parse($checkout)->format('Y-m-d');

        // Status reservasi yang dianggap aktif/bentrok
        // PERBAIKAN: Tambahkan semua kemungkinan status yang ada di database
        $activeStatuses = [
            'pending',
            'confirmed',
            'checked_in',
            'disetujui',     // Tambahan untuk status bahasa Indonesia
            'dikonfirmasi',  // Tambahan untuk status bahasa Indonesia
            'check_in'       // Tambahan untuk variasi nama status
        ];

        \Log::info('Checking availability', [
            'cottage_id' => $this->id,
            'checkin_requested' => $checkinDate,
            'checkout_requested' => $checkoutDate,
            'cottage_status' => $this->status
        ]);

        // PERBAIKAN: Logika pengecekan tanggal yang lebih ketat
        $conflictingReservations = $this->reservasi()
            ->where(function ($query) use ($checkinDate, $checkoutDate) {
                // Reservasi bentrok jika ada overlap dengan periode yang diminta
                // Overlap terjadi jika:
                // 1. Checkin yang diminta < checkout reservasi yang ada DAN
                // 2. Checkout yang diminta > checkin reservasi yang ada
                $query->whereRaw('DATE(tanggal_checkin) < ?', [$checkoutDate])
                      ->whereRaw('DATE(tanggal_checkout) > ?', [$checkinDate]);
            })
            ->whereIn('status_reservasi', $activeStatuses)
            ->with('user')
            ->get();

        // Log detail reservasi yang dicek
        \Log::info('Found reservations', [
            'total_reservations' => $this->reservasi()->count(),
            'active_reservations' => $conflictingReservations->count(),
            'conflicting_reservations' => $conflictingReservations->map(function($r) {
                return [
                    'id' => $r->id,
                    'checkin' => $r->tanggal_checkin,
                    'checkout' => $r->tanggal_checkout,
                    'status' => $r->status_reservasi,
                    'user' => $r->user->name ?? 'Guest'
                ];
            })->toArray()
        ]);

        $isAvailable = $conflictingReservations->isEmpty();

        if ($isAvailable) {
            return [
                'available' => true,
                'message' => 'Cottage tersedia untuk tanggal ' . Carbon::parse($checkinDate)->format('d M Y') . ' - ' . Carbon::parse($checkoutDate)->format('d M Y'),
                'conflicting_reservations' => []
            ];
        } else {
            // Buat pesan detail tentang reservasi yang bentrok
            $conflictDetails = $conflictingReservations->map(function ($reservation) {
                return [
                    'id' => $reservation->id,
                    'checkin' => Carbon::parse($reservation->tanggal_checkin)->format('d M Y'),
                    'checkout' => Carbon::parse($reservation->tanggal_checkout)->format('d M Y'),
                    'guest' => $reservation->user->name ?? 'Guest',
                    'status' => $this->getStatusLabel($reservation->status_reservasi)
                ];
            });

            $message = 'Cottage tidak tersedia karena sudah ada ' . $conflictingReservations->count() . ' reservasi pada periode tersebut';

            return [
                'available' => false,
                'message' => $message,
                'conflicting_reservations' => $conflictDetails->toArray()
            ];
        }
    }

    // Method untuk cek ketersediaan cottage (versi sederhana untuk backward compatibility)
    public function isAvailable($checkin, $checkout)
    {
        $result = $this->checkAvailabilityWithDetails($checkin, $checkout);
        return $result['available'];
    }

    // Helper method untuk mendapatkan label status yang lebih user-friendly
    private function getStatusLabel($status)
    {
        $statusLabels = [
            'pending' => 'Menunggu Konfirmasi',
            'confirmed' => 'Dikonfirmasi',
            'disetujui' => 'Disetujui',
            'dikonfirmasi' => 'Dikonfirmasi',
            'checked_in' => 'Sedang Check-in',
            'check_in' => 'Sedang Check-in',
            'completed' => 'Selesai',
            'cancelled' => 'Dibatalkan'
        ];

        return $statusLabels[strtolower($status)] ?? ucfirst($status);
    }

    public function toggleStatus()
    {
        $this->update([
            'status' => $this->status === 'aktif' ? 'nonaktif' : 'aktif'
        ]);
    }
}
