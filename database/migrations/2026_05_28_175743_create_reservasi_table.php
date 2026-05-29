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
        Schema::create('reservasi', function (Blueprint $table) {

    // Primary Key
    $table->bigIncrements('id_reservasi');

    // Kode Booking (unik dan searchable)
    $table->string('kode_reservasi', 30)->unique();

    // Foreign Key Pelanggan
    $table->foreignId('id_pelanggan')
        ->constrained('pelanggan', 'id_pelanggan')
        ->cascadeOnDelete();

    // Foreign Key Kamar (PENTING DITAMBAHKAN)
    $table->foreignId('id_kamar')
        ->constrained('kamar', 'id_kamar')
        ->cascadeOnUpdate()
        ->restrictOnDelete(); // tidak boleh hapus kamar jika ada reservasi aktif

    // Tanggal Pemesanan
    $table->timestamp('tanggal_pesan')->useCurrent();

    // Jadwal Menginap
    $table->date('check_in');
    $table->date('check_out');

    // Lama Menginap (di-hitung otomatis via trigger/observer)
    $table->unsignedTinyInteger('lama_menginap'); // max 255 hari cukup

    // Harga
    $table->decimal('harga_per_malam', 12, 2)->default(0);
    $table->decimal('total_harga', 12, 2)->default(0);

    // Diskon & Pajak
    $table->decimal('diskon_persen', 5, 2)->default(0);
    $table->decimal('diskon_nominal', 12, 2)->default(0);
    $table->decimal('pajak_persen', 5, 2)->default(0); // misal PPN

    // Jumlah Tamu
    $table->unsignedTinyInteger('jumlah_dewasa')->default(1);
    $table->unsignedTinyInteger('jumlah_anak')->default(0);

    // Status
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

    // Pembayaran
    $table->string('metode_pembayaran')->nullable(); // cash, transfer, credit_card, dll
    $table->string('bukti_pembayaran')->nullable();

    // Catatan
    $table->text('catatan')->nullable();
    $table->text('alasan_cancel')->nullable();

    // Soft Deletes & Timestamps
    $table->softDeletes();
    $table->timestamps();

    /*
    |--------------------------------------------------------------------------
    | Indexes
    |--------------------------------------------------------------------------
    */
    $table->index('kode_reservasi');
    $table->index('status_reservasi');
    $table->index('status_pembayaran');
    $table->index('check_in');
    $table->index('check_out');
    $table->index(['check_in', 'check_out']);           // penting untuk cek ketersediaan kamar
    $table->index('id_kamar');
    $table->index('id_pelanggan');
    $table->index('tanggal_pesan');
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservasi');
    }
};
