<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SmartphoneController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RekomendasiController;
use App\Http\Controllers\HomeController;

// Debug route
Route::get('/cek-folder-export', function () {
    // Cek apakah folder Export ada
    $folderExists = is_dir(app_path('Export'));
    $fileExists = file_exists(app_path('Export/SmartphonesExport.php'));
    
    return "Folder Export exists: " . ($folderExists ? 'YES' : 'NO') . "<br>" .
           "File SmartphonesExport.php exists: " . ($fileExists ? 'YES' : 'NO') . "<br>" .
           "App path: " . app_path();
});

/*
|--------------------------------------------------------------------------
| PUBLIC (GUEST)
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])
->name('home');
Route::get('/about', function () {
    return view('about');
})->name('about');

/*
|--------------------------------------------------------------------------
| AUTHENTICATED USER (USER & ADMIN)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    // ===== BERANDA =====
    Route::get('/beranda', function () {
        return view('pages.beranda');
    })->name('beranda');

    // ===== DASHBOARD =====
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::get('/dashboard/filter', [DashboardController::class, 'filter'])
        ->name('dashboard.filter');

    // ===== SISTEM REKOMENDASI =====
    Route::get('/rekomendasi', function () {
        return view('rekomendasi.wizard');
    })->name('rekomendasi');

    Route::match(['get', 'post'], '/rekomendasi/hasil', [RekomendasiController::class, 'proses'])
        ->name('rekomendasi.hasil');

    // ===== SMARTPHONE (READ ONLY) =====
    Route::get('/smartphones', [SmartphoneController::class, 'index'])
        ->name('smartphones.index');

    // ===== EXPORT EXCEL =====
    Route::get('/smartphones/export/excel', [SmartphoneController::class, 'exportExcel'])
        ->name('smartphones.export.excel');

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
    // HANYA CRUD SMARTPHONE
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