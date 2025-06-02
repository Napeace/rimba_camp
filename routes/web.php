<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\StatistikController;
use App\Http\Controllers\Admin\CottageController; // Tambahkan ini

// Route untuk halaman utama
Route::get('/', function () {
    return view('pengunjung.welcome');
});

// Route untuk admin
Route::prefix('admin')->name('admin.')->group(function () {
    // Route yang tidak memerlukan login
    Route::middleware('guest')->group(function () {
        Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [AuthController::class, 'login'])->name('login.process');
    });

    // Route yang memerlukan login admin
    Route::middleware(['auth', 'admin'])->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

        // Route statistik
        Route::get('/statistik', [StatistikController::class, 'index'])->name('statistik.index');
        Route::get('/statistik/chart', [StatistikController::class, 'getChartData'])->name('statistik.chart');
        Route::post('/statistik', [StatistikController::class, 'store'])->name('statistik.store');
        Route::get('/statistik/detail', [StatistikController::class, 'detail'])->name('statistik.detail');

        // Route Cottages
        Route::resource('cottages', CottageController::class);
        Route::get('/cottages/{cottage}/availability', [CottageController::class, 'checkAvailability'])->name('cottages.availability');
        Route::get('/cottages-statistics', [CottageController::class, 'statistics'])->name('cottages.statistics');
        Route::patch('/cottages/{cottage}/toggle-status', [CottageController::class, 'toggleStatus'])->name('cottages.toggle-status');

        // Testimoni routes
        Route::get('/testimoni', [App\Http\Controllers\Admin\TestimoniController::class, 'index'])->name('testimoni.index');
        Route::get('/testimoni/{testimoni}', [App\Http\Controllers\Admin\TestimoniController::class, 'show'])->name('testimoni.show');
        Route::patch('/testimoni/{testimoni}/status', [App\Http\Controllers\Admin\TestimoniController::class, 'updateStatus'])->name('testimoni.updateStatus');
        Route::get('/api/testimoni/stats', [App\Http\Controllers\Admin\TestimoniController::class, 'getStats'])->name('testimoni.stats');

    });
});
