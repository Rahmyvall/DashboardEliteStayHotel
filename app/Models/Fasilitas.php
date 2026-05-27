<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fasilitas extends Model
{
    use HasFactory;

    /*
    |--------------------------------------------------------------------------
    | Nama Tabel
    |--------------------------------------------------------------------------
    */

    protected $table = 'fasilitas';

    /*
    |--------------------------------------------------------------------------
    | Primary Key
    |--------------------------------------------------------------------------
    */

    protected $primaryKey = 'id_fasilitas';

    /*
    |--------------------------------------------------------------------------
    | Auto Increment
    |--------------------------------------------------------------------------
    */

    public $incrementing = true;

    /*
    |--------------------------------------------------------------------------
    | Tipe Primary Key
    |--------------------------------------------------------------------------
    */

    protected $keyType = 'int';

    /*
    |--------------------------------------------------------------------------
    | Timestamp
    |--------------------------------------------------------------------------
    */

    public $timestamps = true;

    /*
    |--------------------------------------------------------------------------
    | Mass Assignment
    |--------------------------------------------------------------------------
    */

    protected $fillable = [
        'nama_fasilitas',
        'icon',
        'deskripsi',
    ];

    /*
    |--------------------------------------------------------------------------
    | Hidden Field
    |--------------------------------------------------------------------------
    */

    protected $hidden = [
        'deleted_at',
    ];

    /*
    |--------------------------------------------------------------------------
    | Casting Data
    |--------------------------------------------------------------------------
    */

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

     public function tipeKamarFasilitas()
    {
        return $this->hasMany(
            TipeKamarFasilitas::class,
            'id_fasilitas',
            'id_fasilitas'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Accessor Icon URL
    |--------------------------------------------------------------------------
    */

    public function getIconUrlAttribute()
    {
        if ($this->icon) {
            return asset('storage/' . $this->icon);
        }

        return asset('images/default.png');
    }

    /*
    |--------------------------------------------------------------------------
    | Scope Search
    |--------------------------------------------------------------------------
    */

    public function scopeSearch($query, $keyword)
    {
        return $query->where('nama_fasilitas', 'like', '%' . $keyword . '%')
                     ->orWhere('deskripsi', 'like', '%' . $keyword . '%');
    }
}
