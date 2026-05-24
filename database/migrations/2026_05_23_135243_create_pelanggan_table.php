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
        Schema::create('pelanggan', function (Blueprint $table) {
            // Primary Key
            $table->id('id_pelanggan');

            // Foreign Key ke tabel users
            $table->unsignedBigInteger('id_user');

            // Data pelanggan
            $table->string('nik')->nullable();
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->text('alamat')->nullable();
            $table->string('kota')->nullable();
            $table->string('negara')->nullable();
            $table->date('tanggal_lahir')->nullable();

            // Timestamp
            $table->timestamps();

            // Relasi foreign key
            $table->foreign('id_user')
                ->references('id_user')
                ->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelanggan');
    }
};