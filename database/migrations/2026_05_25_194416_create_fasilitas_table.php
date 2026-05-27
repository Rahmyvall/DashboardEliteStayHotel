<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('fasilitas', function (Blueprint $table) {

            // Primary Key
            $table->id('id_fasilitas');

            // Nama fasilitas
            $table->string('nama_fasilitas');

            // Icon fasilitas (boleh kosong)
            $table->string('icon')->nullable();

            // Deskripsi fasilitas (boleh kosong)
            $table->text('deskripsi')->nullable();

            // created_at & updated_at
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fasilitas');
    }
};
