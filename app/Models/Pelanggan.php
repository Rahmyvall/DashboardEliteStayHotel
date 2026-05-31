<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;

    protected $table = 'pelanggan';

    protected $primaryKey = 'id_pelanggan';

    public $incrementing = true;

    protected $keyType = 'int';

    protected $fillable = [
        'id_user',           // sesuai dengan kolom di tabel
        'nik',
        'jenis_kelamin',
        'alamat',
        'kota',
        'negara',
        'tanggal_lahir',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
    ];

    /**
     * Relasi ke User
     * Diperbaiki: foreign key 'id_user' sesuai fillable
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    /**
     * Relasi ke Reservasi
     */
    public function reservasi()
    {
        return $this->hasMany(Reservasi::class, 'id_pelanggan', 'id_pelanggan');
    }

    /**
     * Accessor untuk Nama Lengkap
     * Mengambil dari relasi user
     */
    public function getNamaLengkapAttribute()
    {
        return $this->user?->nama_lengkap ?? '-';
    }

    /**
     * Optional: Scope untuk memudahkan query
     */
    public function scopeWithUser($query)
    {
        return $query->with('user');
    }
}
