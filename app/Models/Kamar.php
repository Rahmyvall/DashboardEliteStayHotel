<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
    ];

    /**
     * Cast otomatis biar lebih aman
     */
    protected $casts = [
        'lantai' => 'integer',
    ];

    /**
     * Relasi ke TipeKamar (many to one)
     */
    public function tipeKamar()
    {
        return $this->belongsTo(TipeKamar::class, 'id_tipe', 'id_tipe');
    }

    /**
     * Scope: kamar tersedia
     */
    public function scopeTersedia($query)
    {
        return $query->where('status_kamar', 'tersedia');
    }

    /**
     * Scope: kamar terisi
     */
    public function scopeTerisi($query)
    {
        return $query->where('status_kamar', 'terisi');
    }

    /**
     * Scope: maintenance
     */
    public function scopeMaintenance($query)
    {
        return $query->where('status_kamar', 'maintenance');
    }
}