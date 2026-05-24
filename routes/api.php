<?php

use Illuminate\Support\Facades\Route;

// Controllers
use App\Http\Controllers\Api\UserController;

// Admin
use App\Http\Controllers\Api\Admin\PelangganApiController as PelangganApiController;

// Resepsionis
use App\Http\Controllers\Api\Resepsionis\PelangganApiController as ResepsionisPelangganApiController;

// Pelanggan
use App\Http\Controllers\Api\Pelanggan\PelangganApiController;

Route::prefix('v1')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | ADMIN API
    |--------------------------------------------------------------------------
    */
    Route::middleware(['auth:sanctum', 'role:admin'])
        ->prefix('admin')
        ->group(function () {

            Route::apiResource(
                'pelanggan',
                PelangganApiController::class
            );
            Route::apiResource('users', UserController::class);

        });

    /*
    |--------------------------------------------------------------------------
    | RESEPSIONIS API
    |--------------------------------------------------------------------------
    */
    Route::middleware(['auth:sanctum', 'role:resepsionis'])
        ->prefix('resepsionis')
        ->group(function () {

            Route::apiResource(
                'pelanggan',
                ResepsionisPelangganApiController::class
            );

        });

    /*
    |--------------------------------------------------------------------------
    | PELANGGAN API
    |--------------------------------------------------------------------------
    */
    Route::middleware(['auth:sanctum', 'role:pelanggan'])
        ->prefix('pelanggan')
        ->group(function () {

        });

});