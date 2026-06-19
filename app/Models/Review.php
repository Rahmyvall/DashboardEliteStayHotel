<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $table = 'review';

    protected $primaryKey = 'id_review';

    protected $fillable = [
        'id_reservasi',
        'rating',
        'komentar',
    ];

    protected $casts = [
        'rating' => 'integer',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELATIONSHIP
    |--------------------------------------------------------------------------
    */

    /**
     * Review milik satu reservasi
     */
    public function reservasi()
    {
        return $this->belongsTo(
            Reservasi::class,
            'id_reservasi',
            'id_reservasi'
        );
    }

    /**
     * Shortcut ke pelanggan melalui reservasi
     */
    public function getPelangganAttribute()
    {
        return $this->reservasi?->pelanggan;
    }

    /**
     * Shortcut ke kamar melalui reservasi
     */
    public function getKamarAttribute()
    {
        return $this->reservasi?->kamar;
    }

    /**
     * Shortcut ke user melalui pelanggan
     */
    public function getUserAttribute()
    {
        return $this->reservasi?->pelanggan?->user;
    }
}
