<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->id('id_pembayaran');

            $table->unsignedBigInteger('id_reservasi');

            $table->dateTime('tanggal_bayar')->nullable();

            $table->enum('metode_pembayaran', [
                'cash',
                'transfer',
                'credit_card',
                'e-wallet'
            ]);

            $table->decimal('jumlah_bayar', 12, 2);

            $table->enum('status_pembayaran', [
                'pending',
                'paid',
                'failed',
                'refund'
            ])->default('pending');

            $table->string('bukti_pembayaran')->nullable();

            $table->timestamps();

            $table->foreign('id_reservasi')
                ->references('id_reservasi')
                ->on('reservasi')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayaran');
    }
};
