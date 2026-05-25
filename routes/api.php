<?php

use App\Http\Controllers\Api\PelangganApiController;
use App\Http\Controllers\Api\Resepsionis\ResepsionisKamarApiController;
use App\Http\Controllers\Api\Resepsionis\ResepsionisPelangganApiController;
use App\Http\Controllers\Api\TipeKamarController;
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

        });

    /*
    |--------------------------------------------------------------------------
    | RESEPSIONIS API
    |--------------------------------------------------------------------------
    */
    Route::middleware(['auth:sanctum', 'role:resepsionis'])
        ->prefix('resepsionis')
        ->group(function () {

            Route::apiResource('pelanggan', ResepsionisPelangganApiController::class);

            // Kamar
            Route::apiResource('kamar', ResepsionisKamarApiController::class);

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
