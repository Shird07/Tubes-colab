<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SmartphoneController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RekomendasiController;

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
})->name('about');

/*
|--------------------------------------------------------------------------
| AUTHENTICATED USER (USER & ADMIN)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    // ===== DASHBOARD (HANYA 1 KALI) =====
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // 🔥 TAMBAHKAN ROUTE FILTER DI SINI
    Route::get('/dashboard/filter', [DashboardController::class, 'filter'])
        ->name('dashboard.filter');

    // ===== SISTEM REKOMENDASI =====
    Route::get('/rekomendasi', function () {
        return view('rekomendasi.wizard');
    })->name('rekomendasi');

    Route::post('/rekomendasi/hasil', [RekomendasiController::class, 'proses'])
        ->name('rekomendasi.proses');

    // ===== SMARTPHONE (READ ONLY) =====
    Route::get('/smartphones', [SmartphoneController::class, 'index'])
        ->name('smartphones.index');

    // ===== PROFILE =====
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

    // Debug admin
    Route::get('/cek-admin', function () {
        return 'ADMIN OK';
    });
});

/*
|--------------------------------------------------------------------------
| AUTH (BREEZE)
|--------------------------------------------------------------------------
*/
require __DIR__ . '/auth.php';


// baby