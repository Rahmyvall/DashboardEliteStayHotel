<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipeKamar extends Model
{
    use HasFactory;

    protected $table = 'tipe_kamar';

    protected $primaryKey = 'id_tipe';

    public $incrementing = true;

    protected $keyType = 'int';

    protected $fillable = [
        'nama_tipe',
        'deskripsi',
        'harga_per_malam',
        'kapasitas',
        'ukuran_kamar',
    ];

    protected $casts = [
        'harga_per_malam' => 'decimal:2',
        'kapasitas'       => 'integer',
    ];

    /**
     * Satu tipe kamar memiliki banyak kamar
     */
    public function kamar()
    {
        return $this->hasMany(
            Kamar::class,
            'id_tipe',
            'id_tipe'
        );
    }

    /**
     * Satu tipe kamar memiliki banyak fasilitas
     */
    public function tipeKamarFasilitas()
    {
        return $this->hasMany(
            TipeKamarFasilitas::class,
            'id_tipe',
            'id_tipe'
        );
    }
}
