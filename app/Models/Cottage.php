<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    // Relationship dengan reservasi - menggunakan nama model yang benar
    public function reservations()
    {
        return $this->hasMany(Reservasi::class, 'cottages_id', 'id');
    }

    // Alternatif: bisa juga menggunakan nama yang lebih konsisten
    public function reservasi()
    {
        return $this->hasMany(Reservasi::class, 'cottages_id', 'id');
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

    // Scope untuk filter berdasarkan kapasitas
    public function scopeByCapacity($query, $capacity)
    {
        return $query->where('kapasitas', '>=', $capacity);
    }

    // Scope untuk filter berdasarkan harga
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

    // Scope untuk filter berdasarkan status
    public function scopeActive($query)
    {
        return $query->where('status', 'aktif');
    }

    public function scopeInactive($query)
    {
        return $query->where('status', 'nonaktif');
    }

    // Method untuk cek ketersediaan cottage
    public function isAvailable($checkin, $checkout)
    {
        // Cottage harus aktif dan tidak ada reservasi yang bertabrakan
        if ($this->status !== 'aktif') {
            return false;
        }

        return !$this->reservations()
            ->where(function ($query) use ($checkin, $checkout) {
                $query->where(function ($q) use ($checkin, $checkout) {
                    $q->where('tanggal_checkin', '<=', $checkin)
                      ->where('tanggal_checkout', '>', $checkin);
                })->orWhere(function ($q) use ($checkin, $checkout) {
                    $q->where('tanggal_checkin', '<', $checkout)
                      ->where('tanggal_checkout', '>=', $checkout);
                })->orWhere(function ($q) use ($checkin, $checkout) {
                    $q->where('tanggal_checkin', '>=', $checkin)
                      ->where('tanggal_checkout', '<=', $checkout);
                });
            })
            ->whereIn('status_reservasi', ['confirmed', 'checked_in'])
            ->exists();
    }

    // Method untuk toggle status
    public function toggleStatus()
    {
        $this->update([
            'status' => $this->status === 'aktif' ? 'nonaktif' : 'aktif'
        ]);
    }
}
