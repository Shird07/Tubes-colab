<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SmartphoneController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| PUBLIC (GUEST)
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/about', function () {
    return view('about');
});

/*
|--------------------------------------------------------------------------
| AUTH REQUIRED (USER & ADMIN)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    // Sistem rekomendasi
    Route::get('/rekomendasi', function () {
        return view('rekomendasi');
    })->name('rekomendasi');

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // 🔥 ROUTE FILTER DASHBOARD (WAJIB UNTUK VISUALISASI)
    Route::get('/dashboard/filter', [DashboardController::class, 'filter'])
        ->name('dashboard.filter');

    // Smartphone (READ)
    Route::get('/smartphones', [SmartphoneController::class, 'index'])
        ->name('smartphones.index');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| ADMIN ONLY
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])->group(function () {

    Route::get('/smartphones/create', [SmartphoneController::class, 'create'])
        ->name('smartphones.create');

    Route::post('/smartphones', [SmartphoneController::class, 'store'])
        ->name('smartphones.store');

    Route::get('/smartphones/{smartphone}/edit', [SmartphoneController::class, 'edit'])
        ->name('smartphones.edit');

    Route::put('/smartphones/{smartphone}', [SmartphoneController::class, 'update'])
        ->name('smartphones.update');

    Route::delete('/smartphones/{smartphone}', [SmartphoneController::class, 'destroy'])
        ->name('smartphones.destroy');

    Route::get('/cek-admin', function () {
        return 'ADMIN OK';
    });
});

require __DIR__.'/auth.php';
