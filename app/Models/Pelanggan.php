<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Reservasi;

class Pelanggan extends Model
{
    use HasFactory;

    protected $table = 'pelanggan';

    protected $primaryKey = 'id_pelanggan';

    public $incrementing = true;

    protected $keyType = 'int';

    protected $fillable = [
        'id_user',
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

    public function getNamaLengkapAttribute()
{
    return $this->user->nama_lengkap ?? '-';
}
    /**
     * Relasi ke user
     */
   public function user()
{
    return $this->belongsTo(User::class, 'id_user', 'id_user');
}

    /**
     * Relasi ke reservasi (HOTEL SYSTEM)
     */
    public function reservasi()
    {
        return $this->hasMany(Reservasi::class, 'id_pelanggan', 'id_pelanggan');
    }
}
