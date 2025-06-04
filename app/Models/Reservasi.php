<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Reservasi extends Model
{
    use HasFactory;

    // PERBAIKAN: Status constants sesuai dengan migration
    const STATUS_MENUNGGU = 'menunggu_konfirmasi';
    const STATUS_DISETUJUI = 'disetujui';
    const STATUS_DITOLAK = 'ditolak';

    protected $fillable = [
        'tanggal_checkin',
        'tanggal_checkout',
        'status_reservasi',
        'bukti_pembayaran',
        'user_id',        // PERBAIKAN: Sesuai migration
        'cottage_id',     // PERBAIKAN: Sesuai migration
    ];

    protected $casts = [
        'tanggal_checkin' => 'date',
        'tanggal_checkout' => 'date',
    ];

    // PERBAIKAN: Relationships - Konsisten dengan migration
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function cottage()
    {
        return $this->belongsTo(Cottage::class, 'cottage_id', 'id');
    }

    // Accessors
    public function getDurasiMenginapAttribute()
    {
        return $this->tanggal_checkin->diffInDays($this->tanggal_checkout);
    }

    public function getTotalHargaAttribute()
    {
        if ($this->cottage) {
            return $this->durasi_menginap * $this->cottage->harga_per_malam;
        }
        return 0;
    }

    public function getFormattedTotalAttribute()
    {
        return 'Rp ' . number_format($this->total_harga, 0, ',', '.');
    }

    public function getStatusLabelAttribute()
    {
        $labels = self::getStatusList();
        return $labels[$this->status_reservasi] ?? 'Unknown';
    }

    public function getStatusBadgeClassAttribute()
    {
        $classes = [
            self::STATUS_MENUNGGU => 'bg-yellow-100 text-yellow-800',
            self::STATUS_DISETUJUI => 'bg-green-100 text-green-800',
            self::STATUS_DITOLAK => 'bg-red-100 text-red-800',
        ];

        return $classes[$this->status_reservasi] ?? 'bg-gray-100 text-gray-800';
    }

    // PERBAIKAN: Static methods - Status sesuai migration
    public static function getStatusList()
    {
        return [
            self::STATUS_MENUNGGU => 'Menunggu Konfirmasi',
            self::STATUS_DISETUJUI => 'Disetujui',
            self::STATUS_DITOLAK => 'Ditolak',
        ];
    }

    // Scopes
    public function scopeByStatus($query, $status)
    {
        return $query->where('status_reservasi', $status);
    }

    public function scopeSearch($query, $search)
    {
        return $query->whereHas('user', function ($q) use ($search) {
            $q->where('name', 'LIKE', '%' . $search . '%')
              ->orWhere('email', 'LIKE', '%' . $search . '%');
        });
    }

    public function scopeActive($query)
    {
        return $query->where('status_reservasi', self::STATUS_DISETUJUI);
    }

    public function scopePending($query)
    {
        return $query->where('status_reservasi', self::STATUS_MENUNGGU);
    }

    public function scopeCancelled($query)
    {
        return $query->where('status_reservasi', self::STATUS_DITOLAK);
    }

    // Helper methods
    public function isActive()
    {
        return $this->status_reservasi === self::STATUS_DISETUJUI;
    }

    public function isPending()
    {
        return $this->status_reservasi === self::STATUS_MENUNGGU;
    }

    public function isCancelled()
    {
        return $this->status_reservasi === self::STATUS_DITOLAK;
    }
}
