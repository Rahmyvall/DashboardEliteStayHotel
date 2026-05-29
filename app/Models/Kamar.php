<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;   ← Dinonaktifkan dulu

class Kamar extends Model
{
    use HasFactory;
    // use SoftDeletes;     // ← Komentari dulu karena tabel belum ada deleted_at

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
        'lantai'          => 'integer',
        'harga_per_malam' => 'decimal:2',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relasi
    |--------------------------------------------------------------------------
    */
    public function tipe_kamar()
    {
        return $this->belongsTo(TipeKamar::class, 'id_tipe', 'id_tipe');
    }

    public function reservasi()
    {
        return $this->hasMany(Reservasi::class, 'id_kamar', 'id_kamar');
    }

    /*
    |--------------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------------
    */
    public function scopeTersedia($query)
    {
        return $query->where('status_kamar', 'tersedia');
    }

    public function scopeAvailable($query)
    {
        return $query->where('status_kamar', 'tersedia');
    }

    /*
    |--------------------------------------------------------------------------
    | Accessor
    |--------------------------------------------------------------------------
    */
    public function getStatusLabelAttribute()
    {
        return match($this->status_kamar) {
            'tersedia'    => 'Tersedia',
            'terisi'      => 'Terisi',
            'maintenance' => 'Maintenance',
            'cleaning'    => 'Dalam Pembersihan',
            default       => ucfirst($this->status_kamar ?? '-'),
        };
    }
}
