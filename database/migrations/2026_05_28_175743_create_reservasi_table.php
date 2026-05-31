<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reservasi', function (Blueprint $table) {

            // =========================
            // PRIMARY KEY
            // =========================
            $table->bigIncrements('id_reservasi');

            // =========================
            // IDENTITAS
            // =========================
            $table->string('kode_reservasi', 30)->unique();

            $table->foreignId('id_pelanggan')
                ->constrained('pelanggan', 'id_pelanggan')
                ->cascadeOnDelete();

            $table->foreignId('id_kamar')
                ->constrained('kamar', 'id_kamar')
                ->restrictOnDelete();

            // =========================
            // WAKTU
            // =========================
            $table->timestamp('tanggal_pesan')->useCurrent();
            $table->date('check_in');
            $table->date('check_out');
            $table->unsignedSmallInteger('lama_menginap');

            // =========================
            // HARGA
            // =========================
            $table->decimal('harga_per_malam', 12, 2)->default(0);
            $table->decimal('total_harga', 12, 2)->default(0);

            // =========================
            // DISKON & PAJAK
            // =========================
            $table->decimal('diskon_persen', 5, 2)->default(0);
            $table->decimal('pajak_persen', 5, 2)->default(0);

            // ❗ FIX PENTING:
            // kita SIMPAN nominalnya juga supaya tidak error
            $table->decimal('diskon_nominal', 12, 2)->default(0);
            $table->decimal('pajak_nominal', 12, 2)->default(0);

            // =========================
            // TAMU
            // =========================
            $table->unsignedTinyInteger('jumlah_dewasa')->default(1);
            $table->unsignedTinyInteger('jumlah_anak')->default(0);

            // =========================
            // STATUS
            // =========================
            $table->enum('status_reservasi', [
                'pending',
                'confirmed',
                'checkin',
                'checkout',
                'cancelled',
                'no_show'
            ])->default('pending');

            $table->enum('status_pembayaran', [
                'unpaid',
                'partial',
                'paid',
                'refunded'
            ])->default('unpaid');

            // =========================
            // PEMBAYARAN
            // =========================
            $table->string('metode_pembayaran')->nullable();
            $table->string('bukti_pembayaran')->nullable();

            // =========================
            // CATATAN
            // =========================
            $table->text('catatan')->nullable();
            $table->text('alasan_cancel')->nullable();

            // =========================
            // SOFT DELETE
            // =========================
            $table->softDeletes();
            $table->timestamps();

            // =========================
            // INDEX
            // =========================
            $table->index('kode_reservasi');
            $table->index('status_reservasi');
            $table->index('status_pembayaran');
            $table->index('check_in');
            $table->index('check_out');
            $table->index(['check_in', 'check_out']);
            $table->index('id_kamar');
            $table->index('id_pelanggan');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reservasi');
    }
};
