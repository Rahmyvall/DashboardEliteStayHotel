<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AuthController,
    DashboardController,
    CheckinCheckoutController,
    FasilitasController,
    UserController,
    PelangganController,
    TipeKamarController,
    KamarController,
    PembayaranController,
    ResepsionisKamarController,
    ResepsionisPelangganController,
    ReservasiController,
    ReviewController,
    TipeKamarFasilitasController
};

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
| DASHBOARD REDIRECT (SEMUA ROLE)
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function () {
    $user = auth()->user();

    return match ($user->role) {
        'pelanggan' => redirect()->route('pelanggan.dashboard'),
        default => redirect()->route('pages.dashboard'),
    };
})->middleware('auth')->name('dashboard');

/*
|--------------------------------------------------------------------------
| DASHBOARD UTAMA + CHART (ADMIN + RESEPSIONIS + PELANGGAN)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin,resepsionis,pelayanan,pelanggan'])->group(function () {

    Route::get('/pages/dashboard', [DashboardController::class, 'index'])
        ->name('pages.dashboard');

    // CHART GLOBAL (SUPAYA BISA DIPAKAI SEMUA ROLE TERMASUK PELANGGAN)
    Route::get('/dashboard/reservasi-line', [DashboardController::class, 'getReservasiLineChart'])
        ->name('dashboard.reservasi-line');

    Route::get('/dashboard/pendapatan-chart', [DashboardController::class, 'pendapatanChart'])
        ->name('dashboard.pendapatan.chart');

    Route::get('/dashboard/pelanggan-chart', [DashboardController::class, 'pelangganChart'])
        ->name('dashboard.pelanggan.chart');
});

/*
|--------------------------------------------------------------------------
| ADMIN ONLY
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::resource('/pages/users', UserController::class);
    Route::resource('/pages/pelanggan1', PelangganController::class);

    Route::resource('/pages/tipe-kamar', TipeKamarController::class);
    Route::resource('/pages/tipe-kamar-fasilitas', TipeKamarFasilitasController::class);

    Route::resource('/pages/kamar', KamarController::class);

    Route::put('/kamar/{kamar}/konfirmasi', [KamarController::class, 'konfirmasi'])
        ->name('kamar.konfirmasi');

    Route::post('/pages/kamar/generate-floor', [KamarController::class, 'generateFloorRooms'])
        ->name('kamar.generateFloor');

    Route::resource('/pages/fasilitas', FasilitasController::class);

    Route::resource('reservasi', ReservasiController::class);
    Route::resource('pembayaran', PembayaranController::class);
    Route::resource('checkin-checkout', CheckinCheckoutController::class);

    Route::resource('review', ReviewController::class);
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

        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');

        Route::get('/pelanggan', [ResepsionisPelangganController::class, 'index'])
            ->name('pelanggan.index');

        Route::get('/pelanggan/create', [ResepsionisPelangganController::class, 'create'])
            ->name('pelanggan.create');

        Route::post('/pelanggan', [ResepsionisPelangganController::class, 'store'])
            ->name('pelanggan.store');

        Route::delete('/pelanggan/{pelanggan}', [ResepsionisPelangganController::class, 'destroy'])
            ->name('pelanggan.destroy');

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