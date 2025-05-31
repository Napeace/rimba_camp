<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Statistik;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'pengunjung_hari_ini' => Statistik::hariIni()->sum('jumlah_pengunjung') ?? 0,
            'pengunjung_minggu_ini' => Statistik::mingguIni()->sum('jumlah_pengunjung') ?? 0,
            'pengunjung_bulan_ini' => Statistik::bulanIni()->sum('jumlah_pengunjung') ?? 0,
            'total_pengunjung' => Statistik::totalPengunjung() ?? 0,
        ];
        return view('admin.dashboard.index');
    }
}
