<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SmartphoneController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| DASHBOARD
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

/*
|--------------------------------------------------------------------------
| SMARTPHONE
|--------------------------------------------------------------------------
*/

// USER & ADMIN (HANYA LIHAT)
Route::middleware('auth')->group(function () {
    Route::get('/smartphones', [SmartphoneController::class, 'index'])
        ->name('smartphones.index');
});

// ADMIN ONLY (CRUD)
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
});

/*
|--------------------------------------------------------------------------
| PROFILE
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| CEK ADMIN
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])->get('/cek-admin', function () {
    return 'ADMIN OK';
});

require __DIR__.'/auth.php';
