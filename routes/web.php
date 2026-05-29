<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FasilitasController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\TipeKamarController;
use App\Http\Controllers\KamarController;
use App\Http\Controllers\ResepsionisKamarController;
use App\Http\Controllers\ResepsionisPelangganController;
use App\Http\Controllers\ReservasiController;
use App\Http\Controllers\TipeKamarFasilitasController;

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {

    Route::get('/', [AuthController::class, 'login'])->name('login');

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

    $user = auth()->user();

    if ($user->role == 'admin') {
        return view('pages.dashboard');
    }

    if ($user->role == 'resepsionis') {
        return redirect()->route('resepsionis.dashboard');
    }

    if ($user->role == 'pelanggan') {
        return redirect()->route('pelanggan.dashboard');
    }

    abort(403);

})->middleware('auth')->name('dashboard');

/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/pages/dashboard', [DashboardController::class, 'index'])
        ->name('pages.dashboard');

    Route::resource('/pages/users', UserController::class)
        ->names('users');

    Route::resource('/pages/pelanggan1', PelangganController::class)
        ->names('pelanggan1');

    Route::get('/pages/dashboard/pelanggan-chart', [DashboardController::class, 'pelangganChart'])
        ->name('admin.dashboard.pelanggan.chart');

    Route::resource('/pages/tipe-kamar', TipeKamarController::class)
        ->names('tipe-kamar');

    Route::resource('/pages/kamar', KamarController::class)
        ->names('kamar');

    Route::put('/kamar/{kamar}/konfirmasi', [KamarController::class, 'konfirmasi'])
        ->name('kamar.konfirmasi');

    Route::post('/pages/kamar/generate-floor', [KamarController::class, 'generateFloorRooms'])
        ->name('kamar.generateFloor');

    Route::resource('/pages/fasilitas', FasilitasController::class)
        ->names('fasilitas');

    Route::resource(
        '/pages/tipe-kamar-fasilitas',
        TipeKamarFasilitasController::class
    )->names('tipe-kamar-fasilitas');
    Route::resource('reservasi', ReservasiController::class);
    Route::get('/dashboard/reservasi-line', [DashboardController::class, 'getReservasiLineChart'])
     ->name('dashboard.reservasi-line');
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

        Route::get('/dashboard', function () {
            return redirect()->route('resepsionis.pelanggan.index');
        })->name('dashboard');

        Route::get('/pelanggan', [ResepsionisPelangganController::class, 'index'])
            ->name('pelanggan.index');

        Route::get('/pelanggan/create', [ResepsionisPelangganController::class, 'create'])
            ->name('pelanggan.create');

        Route::post('/pelanggan', [ResepsionisPelangganController::class, 'store'])
            ->name('pelanggan.store');

        Route::delete('/pelanggan/{pelanggan}', [ResepsionisPelangganController::class, 'destroy'])
            ->name('pelanggan.destroy');

        Route::get('/dashboard/pelanggan/chart', [DashboardController::class, 'pelangganChart'])
            ->name('pelanggan.chart');

        Route::get('/kamar', [ResepsionisKamarController::class, 'index'])
            ->name('kamar.index');

        Route::get('/kamar/create', [ResepsionisKamarController::class, 'create'])
            ->name('kamar.create');

        Route::post('/kamar/store', [ResepsionisKamarController::class, 'store'])
            ->name('kamar.store');

        Route::get('/kamar/{id}', [ResepsionisKamarController::class, 'show'])
            ->name('kamar.show');

        Route::get('/kamar/{id}/info', [ResepsionisKamarController::class, 'info'])
            ->name('kamar.info');

        Route::post('/kamar/{id}/pick', [ResepsionisKamarController::class, 'pick'])
            ->name('kamar.pick');
    });

/*
|--------------------------------------------------------------------------
| PELANGGAN
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:pelanggan'])
    ->prefix('pages/pelanggan')
    ->name('pelanggan.')
    ->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'pelanggan'])
            ->name('dashboard');

    });