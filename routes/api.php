<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;   // ← Ini yang diperbaiki

// API Routes untuk User
Route::prefix('users')->name('users.')->group(function () {

    Route::get('/', [UserController::class, 'index'])->name('index');
    Route::post('/', [UserController::class, 'store'])->name('store');
    Route::get('{id}', [UserController::class, 'show'])->name('show');
    Route::put('{id}', [UserController::class, 'update'])->name('update');     // PUT lebih tepat
    Route::patch('{id}', [UserController::class, 'update'])->name('update');   // PATCH juga boleh
    Route::delete('{id}', [UserController::class, 'destroy'])->name('destroy');

});
