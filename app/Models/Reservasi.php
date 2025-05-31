<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Reservasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'tanggal_checkin',
        'tanggal_checkout',
        'status_reservasi',
        'bukti_pembayaran',
        'users_email',
        'reservasis_id',
        'cottages_id',
    ];

    protected $casts = [
        'tanggal_checkin' => 'date',
        'tanggal_checkout' => 'date',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class, 'users_email', 'email');
    }

    public function cottage()
    {
        return $this->belongsTo(Cottage::class, 'cottages_id', 'id');
    }

    public function parentReservasi()
    {
        return $this->belongsTo(Reservasi::class, 'reservasis_id', 'id');
    }

    public function childReservasis()
    {
        return $this->hasMany(Reservasi::class, 'reservasis_id', 'id');
    }

    // Accessors
    public function getDurationAttribute()
    {
        return $this->tanggal_checkin->diffInDays($this->tanggal_checkout);
    }

    public function getTotalHargaAttribute()
    {
        if ($this->cottage) {
            return $this->duration * $this->cottage->harga_per_malam;
        }
        return 0;
    }

    public function getFormattedTotalAttribute()
    {
        return 'Rp ' . number_format($this->total_harga, 0, ',', '.');
    }

    // Scopes
    public function scopeByStatus($query, $status)
    {
        return $query->where('status_reservasi', $status);
    }

    public function scopeActive($query)
    {
        return $query->whereIn('status_reservasi', ['confirmed', 'checked_in']);
    }

    public function scopePending($query)
    {
        return $query->where('status_reservasi', 'pending');
    }

    public function scopeCompleted($query)
    {
        return $query->where('status_reservasi', 'completed');
    }

    public function scopeCancelled($query)
    {
        return $query->where('status_reservasi', 'cancelled');
    }

    public function scopeToday($query)
    {
        return $query->whereDate('tanggal_checkin', Carbon::today());
    }

    public function scopeCheckoutToday($query)
    {
        return $query->whereDate('tanggal_checkout', Carbon::today());
    }

    public function scopeByDateRange($query, $start, $end)
    {
        return $query->whereBetween('tanggal_checkin', [$start, $end]);
    }

    // Helper methods
    public function isActive()
    {
        return in_array($this->status_reservasi, ['confirmed', 'checked_in']);
    }

    public function isPending()
    {
        return $this->status_reservasi === 'pending';
    }

    public function isCompleted()
    {
        return $this->status_reservasi === 'completed';
    }

    public function isCancelled()
    {
        return $this->status_reservasi === 'cancelled';
    }

    public function isExpired()
    {
        return $this->tanggal_checkout < Carbon::now() && !$this->isCompleted();
    }

    public function canCancel()
    {
        return in_array($this->status_reservasi, ['pending', 'confirmed']) &&
               $this->tanggal_checkin > Carbon::now();
    }
}
