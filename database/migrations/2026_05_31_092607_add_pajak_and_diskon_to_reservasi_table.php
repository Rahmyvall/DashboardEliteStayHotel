<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('reservasi', function (Blueprint $table) {

            if (!Schema::hasColumn('reservasi', 'diskon_nominal')) {
                $table->decimal('diskon_nominal', 12, 2)->nullable();
            }

            if (!Schema::hasColumn('reservasi', 'pajak_nominal')) {
                $table->decimal('pajak_nominal', 12, 2)->nullable();
            }

            if (!Schema::hasColumn('reservasi', 'total_harga')) {
                $table->decimal('total_harga', 12, 2)->nullable();
            }

        });
    }

    public function down(): void
    {
        Schema::table('reservasi', function (Blueprint $table) {

            $columns = [];

            if (Schema::hasColumn('reservasi', 'diskon_nominal')) {
                $columns[] = 'diskon_nominal';
            }

            if (Schema::hasColumn('reservasi', 'pajak_nominal')) {
                $columns[] = 'pajak_nominal';
            }

            if (Schema::hasColumn('reservasi', 'total_harga')) {
                $columns[] = 'total_harga';
            }

            if (!empty($columns)) {
                $table->dropColumn($columns);
            }

        });
    }
};
