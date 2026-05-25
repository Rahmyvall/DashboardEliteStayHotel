<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipeKamar extends Model
{
    use HasFactory;

    // Nama tabel (karena bukan plural default Laravel)
    protected $table = 'tipe_kamar';

    // Primary key custom
    protected $primaryKey = 'id_tipe';

    // Jika primary key bukan auto-increment integer standar (optional, tapi aman)
    public $incrementing = true;
    protected $keyType = 'int';

    // Field yang boleh diisi (mass assignment)
    protected $fillable = [
        'nama_tipe',
        'deskripsi',
        'harga_per_malam',
        'kapasitas',
        'ukuran_kamar',
    ];

    // Casting tipe data agar lebih rapi saat dipakai
    protected $casts = [
        'harga_per_malam' => 'decimal:2',
        'kapasitas' => 'integer',
    ];
    public function kamar()
    {
        return $this->hasMany(Kamar::class, 'id_tipe', 'id_tipe');
    }
}