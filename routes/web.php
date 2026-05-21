<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/

// halaman login
Route::get('/', [AuthController::class, 'login'])
    ->middleware('guest')
    ->name('login');

// proses login
Route::post('/login', [AuthController::class, 'authenticate'])
    ->middleware('guest')
    ->name('login.process');

// logout
Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');


/*
|--------------------------------------------------------------------------
| Dashboard Routes (ROLE BASED)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    // admin only
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])
        ->middleware('role:admin')
        ->name('admin.dashboard');

    // resepsionis only
    Route::get('/resepsionis/dashboard', [DashboardController::class, 'resepsionis'])
        ->middleware('role:resepsionis')
        ->name('resepsionis.dashboard');

    // pelanggan only
    Route::get('/pelanggan/dashboard', [DashboardController::class, 'pelanggan'])
        ->middleware('role:pelanggan')
        ->name('pelanggan.dashboard');
});
