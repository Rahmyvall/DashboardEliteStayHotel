<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kamar', function (Blueprint $table) {
            $table->id('id_kamar');

            $table->string('nomor_kamar')->unique();

            $table->unsignedBigInteger('id_tipe');

            $table->integer('lantai');

           $table->enum('status_kamar', ['available', 'occupied', 'maintenance'])->change();

            $table->timestamps();

            $table->foreign('id_tipe')
                ->references('id_tipe')
                ->on('tipe_kamar')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kamar');
    }
};
