<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Statistik;
use Illuminate\Http\Request;
use Carbon\Carbon;

class StatistikController extends Controller
{
    public function index()
    {
        // Data untuk dashboard admin
        $pengunjungHariIni = Statistik::hariIni()->sum('jumlah_pengunjung');
        $pengunjungMingguIni = Statistik::mingguIni()->sum('jumlah_pengunjung');
        $pengunjungBulanIni = Statistik::bulanIni()->sum('jumlah_pengunjung');
        $totalPengunjung = Statistik::totalPengunjung();

        return response()->json([
            'pengunjung_hari_ini' => $pengunjungHariIni,
            'pengunjung_minggu_ini' => $pengunjungMingguIni,
            'pengunjung_bulan_ini' => $pengunjungBulanIni,
            'total_pengunjung' => $totalPengunjung,
        ]);
    }

    public function getChartData(Request $request)
    {
        $days = $request->get('days', 7); // Default 7 hari

        if ($days == 30) {
            return $this->getMonthlyChartData();
        } else {
            return $this->getWeeklyChartData();
        }
    }

    private function getWeeklyChartData()
    {
        // Pastikan hari ini selalu termasuk dengan menggunakan today() sebagai end date
        $today = Carbon::today();
        $sevenDaysAgo = $today->copy()->subDays(6); // 6 hari yang lalu + hari ini = 7 hari total

        $data = [];
        $labels = [];

        // Loop dari 6 hari yang lalu sampai hari ini (inclusive)
        for ($date = $sevenDaysAgo->copy(); $date->lte($today); $date->addDay()) {
            $statistik = Statistik::whereDate('tanggal', $date->format('Y-m-d'))->first();

            // Format label untuk 7 hari
            if ($date->isToday()) {
                $labels[] = 'Hari Ini';
            } elseif ($date->isYesterday()) {
                $labels[] = 'Kemarin';
            } else {
                $labels[] = $date->format('d M');
            }

            $data[] = $statistik ? $statistik->jumlah_pengunjung : 0;
        }

        return response()->json([
            'labels' => $labels,
            'data' => $data
        ]);
    }

    private function getMonthlyChartData()
    {
        // Pastikan hari ini selalu termasuk
        $today = Carbon::today();
        $thirtyDaysAgo = $today->copy()->subDays(29); // 29 hari yang lalu + hari ini = 30 hari total

        $data = [];
        $labels = [];

        // Loop dari 29 hari yang lalu sampai hari ini (inclusive)
        for ($date = $thirtyDaysAgo->copy(); $date->lte($today); $date->addDay()) {
            $statistik = Statistik::whereDate('tanggal', $date->format('Y-m-d'))->first();

            // Format label untuk 30 hari - tampilkan semua tanggal
            if ($date->isToday()) {
                $labels[] = 'Hari Ini';
            } elseif ($date->isYesterday()) {
                $labels[] = 'Kemarin';
            } else {
                // Tampilkan tanggal dengan format yang ringkas
                $labels[] = $date->format('d M');
            }

            $data[] = $statistik ? $statistik->jumlah_pengunjung : 0;
        }

        return response()->json([
            'labels' => $labels,
            'data' => $data
        ]);
    }

    public function store(Request $request)
    {
        $statistik = Statistik::tambahPengunjung();

        return response()->json([
            'message' => 'Statistik berhasil ditambahkan',
            'data' => $statistik
        ]);
    }

    public function detail()
    {
        // Untuk halaman detail statistik
        $statistikHarian = Statistik::orderBy('tanggal', 'desc')
                                  ->take(30)
                                  ->get();

        $totalPengunjung = Statistik::totalPengunjung();
        $rataRata = round(Statistik::rataRataPengunjung(), 2);

        return view('admin.statistik.detail', compact(
            'statistikHarian',
            'totalPengunjung',
            'rataRata'
        ));
    }
}
