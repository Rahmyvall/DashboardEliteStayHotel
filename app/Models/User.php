<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'users';

    protected $primaryKey = 'id_user';

    public $incrementing = true;

    protected $keyType = 'int';

    protected $fillable = [
        'nama_lengkap',
        'email',
        'password',
        'no_hp',
        'role',
        'foto_profile',
        'status',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /*
    |--------------------------------------------------------------------------
    | CASTS (FIX IMPORTANT)
    |--------------------------------------------------------------------------
    |
    | ❗ HAPUS 'password' => 'hashed'
    | karena bisa bentrok dengan data lama (MD5 / plaintext)
    |
    */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELATIONSHIP
    |--------------------------------------------------------------------------
    */

    public function pelanggan(): HasOne
    {
        return $this->hasOne(
            Pelanggan::class,
            'id_user',
            'id_user'
        );
    }

    public function createdCheckins(): HasMany
    {
        return $this->hasMany(
            CheckinCheckout::class,
            'created_by',
            'id_user'
        );
    }

    public function checkedInCheckins(): HasMany
    {
        return $this->hasMany(
            CheckinCheckout::class,
            'checked_in_by',
            'id_user'
        );
    }

    public function checkedOutCheckins(): HasMany
    {
        return $this->hasMany(
            CheckinCheckout::class,
            'checked_out_by',
            'id_user'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | ACCESSOR
    |--------------------------------------------------------------------------
    */

    public function getNamaRoleAttribute(): string
    {
        return match ($this->role) {
            'admin' => 'Administrator',
            'resepsionis' => 'Resepsionis',
            'manager' => 'Manager',
            default => ucfirst($this->role ?? ''),
        };
    }

    public function getStatusLabelAttribute(): string
    {
        return $this->status
            ? 'Aktif'
            : 'Non Aktif';
    }
}
