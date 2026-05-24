<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\ResepsionisPelangganController;   

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

    /*
    |--------------------------------------------------------------------------
    | USER MANAGEMENT
    |--------------------------------------------------------------------------
    */

    Route::resource('/pages/users', UserController::class)
        ->names('users');

    /*
    |--------------------------------------------------------------------------
    | PELANGGAN MANAGEMENT
    |--------------------------------------------------------------------------
    */

    Route::resource('/pages/pelanggan1', PelangganController::class)
        ->names('pelanggan1');

    Route::get('/pages/dashboard/pelanggan-chart', [DashboardController::class, 'pelangganChart'])
        ->name('admin.dashboard.pelanggan.chart');
});


/*
|--------------------------------------------------------------------------
| RESEPSIONIS
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:resepsionis'])
    ->prefix('pages/resepsionis')
    ->name('resepsionis.')
    ->group(function () {

        Route::get('/pelanggan', [ResepsionisPelangganController::class, 'index'])
            ->name('pelanggan.index');

        Route::get('/pelanggan/create', [ResepsionisPelangganController::class, 'create'])
            ->name('pelanggan.create');

        Route::post('/pelanggan', [ResepsionisPelangganController::class, 'store'])
            ->name('pelanggan.store');

        Route::delete('/pelanggan/{pelanggan}', [ResepsionisPelangganController::class, 'destroy'])
            ->name('pelanggan.destroy');
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