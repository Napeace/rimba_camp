<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\StatistikController;
use App\Http\Controllers\Admin\CottageController;
use App\Http\Controllers\Admin\ReservasiController;
use App\Http\Controllers\Admin\TestimoniController;
use App\Http\Controllers\Admin\ArtikelController;
use App\Http\Controllers\Admin\GaleriController;
use App\Http\Controllers\Pengunjung\PengunjungAuthController;
use App\Http\Controllers\Pengunjung\PengunjungDashboardController;
use App\Http\Controllers\Pengunjung\PengunjungArtikelController;
use App\Http\Controllers\Pengunjung\PengunjungGaleriController;
use App\Http\Controllers\Pengunjung\PengunjungCottageController;


// ----------------------------
// ROUTE PENGUNJUNG
// ----------------------------

// Landing page utama
Route::get('/', [PengunjungDashboardController::class, 'index'])->name('pengunjung.landing');

// AUTH - Pengunjung
Route::get('/login', [PengunjungAuthController::class, 'showLoginForm'])->name('pengunjung.login');
Route::post('/login', [PengunjungAuthController::class, 'login']);
Route::post('/logout', [PengunjungAuthController::class, 'logout'])->name('pengunjung.logout');

// REGISTER - Pengunjung (tambahkan jika belum ada)
Route::get('/register', [PengunjungAuthController::class, 'showRegisterForm'])->name('pengunjung.register');
Route::post('/register', [PengunjungAuthController::class, 'register']);

// DASHBOARD - Pengunjung (hanya jika sudah login)
Route::get('/dashboard', [PengunjungDashboardController::class, 'index'])->middleware('auth')->name('pengunjung.dashboard');

// ARTIKEL - Public routes
Route::get('/artikel', [PengunjungArtikelController::class, 'index'])->name('artikel.index');
Route::get('/artikel/{id}', [PengunjungArtikelController::class, 'show'])->name('detail.artikel');

// GALERI - Public routes
Route::get('/galeri', [PengunjungGaleriController::class, 'index'])->name('galeri.index');
Route::get('/galeri/{id}', [PengunjungGaleriController::class, 'show'])->name('galeri.show');

// COTTAGE - Pengunjung routes
Route::get('/cottage', [PengunjungCottageController::class, 'index'])->name('cottage.index');
Route::get('/cottage/{id}', [PengunjungCottageController::class, 'show'])->name('cottage.show');
Route::get('/cottage/{id}/reserve', [PengunjungCottageController::class, 'reserve'])->name('cottage.reserve')->middleware('auth');
Route::post('/cottage/reserve', [PengunjungCottageController::class, 'storeReservation'])->name('cottage.storeReservation')->middleware('auth');
Route::get('/cottage/reservasi/riwayat', [PengunjungCottageController::class, 'riwayatReservasi'])->name('cottage.reservasi.riwayat')->middleware('auth');
Route::get('/cottage/reservasi/{id}', [PengunjungCottageController::class, 'showReservasi'])->name('cottage.reservasi.show')->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [PengunjungDashboardController::class, 'profile'])->name('pengunjung.profile');
    Route::post('/profile', [PengunjungDashboardController::class, 'updateProfile'])->name('pengunjung.profile.update');
});

// -------------------------
// ROUTE ADMIN (DASHBOARD)
// -------------------------
Route::prefix('admin')->name('admin.')->group(function () {

    // Route login admin
    Route::middleware('guest')->group(function () {
        Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [AuthController::class, 'login'])->name('login.process');
    });

    // Route setelah admin login
    Route::middleware(['auth', 'admin'])->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

        // Statistik
        Route::get('/statistik', [StatistikController::class, 'index'])->name('statistik.index');
        Route::get('/statistik/chart', [StatistikController::class, 'getChartData'])->name('statistik.chart');
        Route::post('/statistik', [StatistikController::class, 'store'])->name('statistik.store');
        Route::get('/statistik/detail', [StatistikController::class, 'detail'])->name('statistik.detail');

        // Cottage
        Route::resource('cottages', CottageController::class);
        Route::get('/cottages/{cottage}/availability', [CottageController::class, 'checkAvailability'])->name('cottages.availability');
        Route::get('/cottages-statistics', [CottageController::class, 'statistics'])->name('cottages.statistics');
        Route::patch('/cottages/{cottage}/toggle-status', [CottageController::class, 'toggleStatus'])->name('cottages.toggle-status');

        // Testimoni
        Route::get('/testimoni', [TestimoniController::class, 'index'])->name('testimoni.index');
        Route::get('/testimoni/{testimoni}', [TestimoniController::class, 'show'])->name('testimoni.show');
        Route::patch('/testimoni/{testimoni}/status', [TestimoniController::class, 'updateStatus'])->name('testimoni.updateStatus');
        Route::get('/api/testimoni/stats', [TestimoniController::class, 'getStats'])->name('testimoni.stats');

        // Reservasi
        Route::get('/reservasi', [ReservasiController::class, 'index'])->name('reservasi.index');
        Route::get('/reservasi/{reservasi}', [ReservasiController::class, 'show'])->name('reservasi.show');
        Route::patch('/reservasi/{reservasi}/status', [ReservasiController::class, 'updateStatus'])->name('reservasi.updateStatus');

        // Artikel
        Route::resource('artikel', ArtikelController::class);

        // Galeri
        Route::resource('galeri', GaleriController::class);
    });
});
