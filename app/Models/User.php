<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Nama tabel
     */
    protected $table = 'users';

    /**
     * Primary key custom
     */
    protected $primaryKey = 'id_user';

    /**
     * Disable timestamps jika tidak ada created_at & updated_at
     * Kalau ada kolomnya, hapus baris ini
     */
    // public $timestamps = false;

    /**
     * Mass assignable
     */
    protected $fillable = [
        'nama_lengkap',
        'email',
        'password',
        'no_hp',
        'role',
        'foto_profile',
        'status',
    ];

    /**
     * Hidden attributes
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Attribute casting
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function pelanggan()
    {
        return $this->hasOne(Pelanggan::class, 'id_user', 'id_user');
    }
}
