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
        $sevenDaysAgo = Carbon::now()->subDays(6);
        $today = Carbon::today();

        $data = [];
        $labels = [];

        for ($date = $sevenDaysAgo->copy(); $date->lte($today); $date->addDay()) {
            $statistik = Statistik::whereDate('tanggal', $date)->first();

            $labels[] = $date->format('d M');
            $data[] = $statistik ? $statistik->jumlah_pengunjung : 0;
        }

        return response()->json([
            'labels' => $labels,
            'data' => $data
        ]);
    }

    private function getMonthlyChartData()
    {
        $thirtyDaysAgo = Carbon::now()->subDays(29);
        $today = Carbon::today();

        $data = [];
        $labels = [];

        for ($date = $thirtyDaysAgo->copy(); $date->lte($today); $date->addDay()) {
            $statistik = Statistik::whereDate('tanggal', $date)->first();

            // Format label berbeda untuk 30 hari (tampilkan tanggal setiap 5 hari)
            if ($date->day % 5 == 0 || $date->eq($today) || $date->eq($thirtyDaysAgo)) {
                $labels[] = $date->format('d M');
            } else {
                $labels[] = '';
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
