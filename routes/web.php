<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {

    Route::get('/', [AuthController::class, 'login'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'authenticate'])
        ->name('login.process');
});


/*
|--------------------------------------------------------------------------
| LOGOUT
|--------------------------------------------------------------------------
*/

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');


/*
|--------------------------------------------------------------------------
| DASHBOARD REDIRECT
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {

    if (auth()->user()->role == 'admin') {
        return redirect()->route('admin.dashboard');
    }

    if (auth()->user()->role == 'resepsionis') {
        return redirect()->route('resepsionis.dashboard');
    }

    if (auth()->user()->role == 'pelanggan') {
        return redirect()->route('pelanggan.dashboard');
    }

})->middleware('auth')->name('dashboard');


/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/pages/dashboard', [DashboardController::class, 'index'])
        ->name('admin.dashboard');

    // USER MANAGEMENT
    Route::resource('/pages/users', UserController::class)
        ->names('users');
});


/*
|--------------------------------------------------------------------------
| RESEPSIONIS
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:resepsionis'])->group(function () {

    Route::get('/resepsionis/dashboard', [DashboardController::class, 'resepsionis'])
        ->name('resepsionis.dashboard');
});


/*
|--------------------------------------------------------------------------
| PELANGGAN
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:pelanggan'])->group(function () {

    Route::get('/pelanggan/dashboard', [DashboardController::class, 'pelanggan'])
        ->name('pelanggan.dashboard');
});
