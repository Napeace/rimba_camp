<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Statistik extends Model
{
    use HasFactory;

    protected $fillable = [
        'tanggal',
        'jumlah_pengunjung'
    ];

    protected $casts = [
        'tanggal' => 'date',
        'jumlah_pengunjung' => 'integer'
    ];

    // Scope untuk mendapatkan statistik hari ini
    public function scopeHariIni($query)
    {
        return $query->whereDate('tanggal', Carbon::today());
    }

    // Scope untuk mendapatkan statistik minggu ini
    public function scopeMingguIni($query)
    {
        return $query->whereBetween('tanggal', [
            Carbon::now()->startOfWeek(),
            Carbon::now()->endOfWeek()
        ]);
    }

    // Scope untuk mendapatkan statistik bulan ini
    public function scopeBulanIni($query)
    {
        return $query->whereMonth('tanggal', Carbon::now()->month)
                    ->whereYear('tanggal', Carbon::now()->year);
    }

    // Method untuk menambah atau update pengunjung hari ini
    public static function tambahPengunjung()
    {
        $today = Carbon::today();

        $statistik = self::firstOrCreate(
            ['tanggal' => $today],
            ['jumlah_pengunjung' => 0]
        );

        $statistik->increment('jumlah_pengunjung');

        return $statistik;
    }

    // Method untuk mendapatkan total pengunjung
    public static function totalPengunjung()
    {
        return self::sum('jumlah_pengunjung');
    }

    // Method untuk mendapatkan rata-rata pengunjung per hari
    public static function rataRataPengunjung()
    {
        return self::avg('jumlah_pengunjung');
    }
}
