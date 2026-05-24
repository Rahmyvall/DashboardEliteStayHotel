<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;

    /**
     * Nama tabel
     */
    protected $table = 'pelanggan';

    /**
     * Primary key
     */
    protected $primaryKey = 'id_pelanggan';

    /**
     * Auto increment
     */
    public $incrementing = true;

    /**
     * Tipe primary key
     */
    protected $keyType = 'int';

    /**
     * Mass assignment
     */
    protected $fillable = [
        'id_user',
        'nik',
        'jenis_kelamin',
        'alamat',
        'kota',
        'negara',
        'tanggal_lahir',
    ];

    /**
     * Casting data
     */
    protected $casts = [
    'tanggal_lahir' => 'date',
];

    /**
     * Relasi ke tabel users
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
}