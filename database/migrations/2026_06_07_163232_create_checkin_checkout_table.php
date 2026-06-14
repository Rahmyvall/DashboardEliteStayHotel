<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('checkin_checkout', function (Blueprint $table) {
            $table->id('id_check');

            $table->unsignedBigInteger('id_reservasi')->unique();

            // Waktu
            $table->dateTime('waktu_checkin')->nullable();
            $table->dateTime('waktu_checkout')->nullable();
            $table->dateTime('waktu_checkin_aktual')->nullable();
            $table->dateTime('waktu_checkout_aktual')->nullable();

            // Status
            $table->enum('status', [
                'pending',
                'checked_in',
                'checked_out',
                'late_checkout',
                'cancelled'
            ])->default('pending');

            // Keuangan
            $table->decimal('deposit', 12, 2)->default(0.00);
            $table->decimal('biaya_tambahan', 12, 2)->default(0.00);
            $table->decimal('denda_late_checkout', 12, 2)->default(0.00);
            $table->decimal('total_bayar', 12, 2)->default(0.00);

            // Informasi Operasional
            $table->integer('jumlah_tamu_aktual')->nullable();
            $table->string('kondisi_kamar', 50)->nullable();
            $table->boolean('is_late_checkout')->default(false);

            // Catatan
            $table->text('catatan')->nullable();
            $table->text('catatan_checkout')->nullable();

            // Audit Trail
            $table->foreignId('created_by')->nullable()->constrained('users');
            $table->foreignId('checked_in_by')->nullable()->constrained('users');
            $table->foreignId('checked_out_by')->nullable()->constrained('users');

            $table->timestamps();
            $table->softDeletes();

            // Foreign Key
            $table->foreign('id_reservasi')
                ->references('id_reservasi')
                ->on('reservasi')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            // Index
            $table->index(['status', 'waktu_checkin']);
            $table->index('waktu_checkout');
            $table->index('waktu_checkin_aktual');
            $table->index(['waktu_checkin', 'waktu_checkout']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('checkin_checkout');
    }
};
