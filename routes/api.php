<?php

use App\Http\Controllers\Api\FasilitasController;
use App\Http\Controllers\Api\PelangganApiController;
use App\Http\Controllers\Api\PembayaranController;
use App\Http\Controllers\Api\ReservasiController;
use App\Http\Controllers\Api\TipeKamarController;
use App\Http\Controllers\Api\TipeKamarFasilitasController;
use App\Http\Controllers\Api\CheckinCheckoutController;
use App\Http\Controllers\Api\UserController;

use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | ADMIN API
    |--------------------------------------------------------------------------
    */
    Route::middleware(['auth:sanctum', 'role:admin'])
        ->prefix('admin')
        ->group(function () {

            Route::apiResource('pelanggan', PelangganApiController::class);
            Route::apiResource('users', UserController::class);
            Route::apiResource('tipe-kamar', TipeKamarController::class);
            Route::apiResource('fasilitas', FasilitasController::class);
            Route::apiResource('tipe-kamar-fasilitas', TipeKamarFasilitasController::class);
            Route::apiResource('reservasi', ReservasiController::class);
            Route::apiResource('pembayaran', PembayaranController::class);
            Route::apiResource('checkin-checkout', CheckinCheckoutController::class);

            // Custom Routes
            Route::post('checkin/{id_reservasi}', [CheckinCheckoutController::class, 'checkIn'])
                ->name('checkin');

            Route::post('checkout/{id_reservasi}', [CheckinCheckoutController::class, 'checkOut'])
                ->name('checkout');
                });

    /*
    |--------------------------------------------------------------------------
    | RESEPSIONIS API
    |--------------------------------------------------------------------------
    */
    Route::middleware(['auth:sanctum', 'role:resepsionis'])
        ->prefix('resepsionis')
        ->group(function () {



        });

    /*
    |--------------------------------------------------------------------------
    | PELANGGAN (CUSTOMER) API
    |--------------------------------------------------------------------------
    */
    Route::middleware(['auth:sanctum', 'role:pelanggan'])
        ->prefix('pelanggan')
        ->group(function () {

            // Tambahkan route pelanggan di sini nanti

        });
});