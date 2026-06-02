<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('reservasi', function (Blueprint $table) {
            $table->enum('status_pembayaran', [
                'pending',
                'paid',
                'failed',
                'refund'
            ])->change();
        });
    }

    public function down(): void
    {
        Schema::table('reservasi', function (Blueprint $table) {
            $table->enum('status_pembayaran', [
                'pending',
                'paid',
                'refund'
            ])->change();
        });
    }
};
