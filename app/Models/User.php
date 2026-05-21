<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
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
     * Cast attributes
     */
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }
}
