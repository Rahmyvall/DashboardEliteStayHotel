<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tipe_kamar_fasilitas', function (Blueprint $table) {

            $table->id();

            $table->unsignedBigInteger('id_tipe');
            $table->unsignedBigInteger('id_fasilitas');

            $table->timestamps();

            // Foreign Key
            $table->foreign('id_tipe')
                ->references('id_tipe')
                ->on('tipe_kamar')
                ->onDelete('cascade');

            $table->foreign('id_fasilitas')
                ->references('id_fasilitas')
                ->on('fasilitas')
                ->onDelete('cascade');

            // Optional: mencegah data duplikat
            $table->unique(['id_tipe', 'id_fasilitas']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tipe_kamar_fasilitas');
    }
};
