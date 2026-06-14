<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Sesuaikan nilai lama dengan enum baru
        DB::table('reservasi')
            ->whereNotIn('status_pembayaran', [
                'pending',
                'paid',
                'failed',
                'refund'
            ])
            ->update([
                'status_pembayaran' => 'pending'
            ]);

        Schema::table('reservasi', function (Blueprint $table) {
            $table->enum('status_pembayaran', [
                'pending',
                'paid',
                'failed',
                'refund'
            ])->default('pending')->change();
        });
    }

    public function down(): void
    {
        // Ubah nilai failed agar sesuai dengan enum lama
        DB::table('reservasi')
            ->where('status_pembayaran', 'failed')
            ->update([
                'status_pembayaran' => 'pending'
            ]);

        Schema::table('reservasi', function (Blueprint $table) {
            $table->enum('status_pembayaran', [
                'pending',
                'paid',
                'refund'
            ])->default('pending')->change();
        });
    }
};
