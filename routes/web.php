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
use App\Http\Controllers\Pengunjung\PengunjungTestimoniController;

// =====================================================
// ROUTE UNTUK PENGUNJUNG
// =====================================================

// ---------- Public Pages ----------
Route::get('/', [PengunjungDashboardController::class, 'index'])->name('pengunjung.landing');

Route::get('/artikel', [PengunjungArtikelController::class, 'index'])->name('artikel.index');
Route::get('/artikel/{id}', [PengunjungArtikelController::class, 'show'])->name('detail.artikel');

Route::get('/galeri', [PengunjungGaleriController::class, 'index'])->name('galeri.index');
Route::get('/galeri/{id}', [PengunjungGaleriController::class, 'show'])->name('galeri.show');

Route::get('/cottage', [PengunjungCottageController::class, 'index'])->name('cottage.index');
Route::get('/cottage/{id}', [PengunjungCottageController::class, 'show'])->name('cottage.show');

// ---------- Auth Pengunjung ----------
Route::get('/login', [PengunjungAuthController::class, 'showLoginForm'])->name('pengunjung.login');
Route::post('/login', [PengunjungAuthController::class, 'login']);
Route::post('/logout', [PengunjungAuthController::class, 'logout'])->name('pengunjung.logout');

Route::get('/register', [PengunjungAuthController::class, 'showRegisterForm'])->name('pengunjung.register');
Route::post('/register', [PengunjungAuthController::class, 'register']);

// ---------- Middleware Pengunjung Login ----------
Route::middleware('auth:web')->group(function () {

    // Dashboard & Profile
    Route::get('/dashboard', [PengunjungDashboardController::class, 'index'])->name('pengunjung.dashboard');
    Route::get('/profile', [PengunjungDashboardController::class, 'profile'])->name('pengunjung.profile');
    Route::post('/profile', [PengunjungDashboardController::class, 'updateProfile'])->name('pengunjung.profile.update');

    // Cottage Reservation
    Route::get('/cottage/{id}/reserve', [PengunjungCottageController::class, 'reserve'])->name('cottage.reserve');
    Route::post('/cottage/reserve', [PengunjungCottageController::class, 'storeReservation'])->name('cottage.storeReservation');
    Route::get('/cottage/reservasi/riwayat', [PengunjungCottageController::class, 'riwayatReservasi'])->name('cottage.reservasi.riwayat');
    Route::get('/cottage/reservasi/{id}', [PengunjungCottageController::class, 'showReservasi'])->name('cottage.reservasi.show');

    // Testimoni
    Route::get('/testimoni', [PengunjungTestimoniController::class, 'index'])->name('pengunjung.testimoni.index');
    Route::get('/testimoni/create', [PengunjungTestimoniController::class, 'create'])->name('pengunjung.testimoni.create');
    Route::post('/testimoni', [PengunjungTestimoniController::class, 'store'])->name('pengunjung.testimoni.store');
});

// ---------- Redirect Dashboard (Guard Auto Redirect) ----------
Route::get('/dashboard-redirect', function () {
    if (auth()->guard('admin')->check()) {
        return redirect()->route('admin.dashboard');
    } elseif (auth()->guard('web')->check()) {
        return redirect()->route('pengunjung.dashboard');
    }
    return redirect()->route('pengunjung.login');
})->name('dashboard.redirect');


// =====================================================
// ROUTE UNTUK ADMIN
// =====================================================
Route::prefix('admin')->name('admin.')->group(function () {

    // ---------- Admin Auth (Guest Only) ----------
    Route::middleware('guest:admin')->group(function () {
        Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [AuthController::class, 'login'])->name('login.process');
    });

    // ---------- Admin Area (Auth Admin) ----------
    Route::middleware(['auth:admin', 'admin'])->group(function () {

        // Dashboard & Logout
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

        // Statistik
        Route::get('/statistik', [StatistikController::class, 'index'])->name('statistik.index');
        Route::get('/statistik/chart', [StatistikController::class, 'getChartData'])->name('statistik.chart');
        Route::post('/statistik', [StatistikController::class, 'store'])->name('statistik.store');
        Route::get('/statistik/detail', [StatistikController::class, 'detail'])->name('statistik.detail');

        // Cottage Management
        Route::resource('cottages', CottageController::class);
        Route::get('/cottages/{cottage}/availability', [CottageController::class, 'checkAvailability'])->name('cottages.availability');
        Route::get('/cottages-statistics', [CottageController::class, 'statistics'])->name('cottages.statistics');
        Route::patch('/cottages/{cottage}/toggle-status', [CottageController::class, 'toggleStatus'])->name('cottages.toggle-status');

        // Testimoni Management
        Route::get('/testimoni', [TestimoniController::class, 'index'])->name('testimoni.index');
        Route::get('/testimoni/{testimoni}', [TestimoniController::class, 'show'])->name('testimoni.show');
        Route::patch('/testimoni/{testimoni}/status', [TestimoniController::class, 'updateStatus'])->name('testimoni.updateStatus');

        // Reservasi Management
        Route::get('/reservasi', [ReservasiController::class, 'index'])->name('reservasi.index');
        Route::get('/reservasi/{reservasi}', [ReservasiController::class, 'show'])->name('reservasi.show');
        Route::patch('/reservasi/{reservasi}/status', [ReservasiController::class, 'updateStatus'])->name('reservasi.updateStatus');

        // Artikel & Galeri
        Route::resource('artikel', ArtikelController::class);
        Route::resource('galeri', GaleriController::class);
    });
});
