<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\TipeKamar;
use App\Models\Reservasi;

class Kamar extends Model
{
    use HasFactory;

    protected $table = 'kamar';
    protected $primaryKey = 'id_kamar';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'nomor_kamar',
        'id_tipe',
        'lantai',
        'status_kamar',
        'harga_per_malam',
        'deskripsi',
        'foto_kamar',
    ];

    protected $casts = [
        'lantai' => 'integer',
        'harga_per_malam' => 'decimal:2',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELASI YANG BENAR (WAJIB KONSISTEN)
    |--------------------------------------------------------------------------
    */

    // FIX UTAMA: ini yang dipakai di seluruh project
    public function tipeKamar()
    {
        return $this->belongsTo(
            TipeKamar::class,
            'id_tipe',
            'id_tipe'
        );
    }

    // ALIAS (BIAR TIDAK ERROR KALAU MASIH ADA CODE LAMA)
    public function tipe_kamar()
    {
        return $this->tipeKamar();
    }

    /*
    |--------------------------------------------------------------------------
    | RELASI RESERVASI
    |--------------------------------------------------------------------------
    */
    public function reservasi()
    {
        return $this->hasMany(
            Reservasi::class,
            'id_kamar',
            'id_kamar'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPE
    |--------------------------------------------------------------------------
    */
    public function scopeTersedia($query)
    {
        return $query->where('status_kamar', 'tersedia');
    }

    /*
    |--------------------------------------------------------------------------
    | ACCESSOR
    |--------------------------------------------------------------------------
    */
    public function getStatusLabelAttribute()
    {
        return match ($this->status_kamar) {
            'tersedia' => 'Tersedia',
            'terisi' => 'Terisi',
            'maintenance' => 'Maintenance',
            'cleaning' => 'Dalam Pembersihan',
            default => '-',
        };
    }
}
