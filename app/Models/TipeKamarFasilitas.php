<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipeKamarFasilitas extends Model
{
    use HasFactory;

    /**
     * NAMA TABEL
     */
    protected $table = 'tipe_kamar_fasilitas';

    /**
     * PRIMARY KEY
     */
    protected $primaryKey = 'id';

    /**
     * MASS ASSIGNMENT
     */
    protected $fillable = [
        'id_tipe',
        'id_fasilitas',
    ];

    /**
     * TIMESTAMP
     */
    public $timestamps = true;

    /**
     * RELASI KE TIPE KAMAR
     */
    public function tipeKamar()
    {
        return $this->belongsTo(
            TipeKamar::class,
            'id_tipe',
            'id_tipe'
        );
    }

    /**
     * RELASI KE FASILITAS
     */
    public function fasilitas()
    {
        return $this->belongsTo(
            Fasilitas::class,
            'id_fasilitas',
            'id_fasilitas'
        );
    }
}
