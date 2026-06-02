<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reservasi extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'reservasi';
    protected $primaryKey = 'id_reservasi';

    public $incrementing = true;
    public $timestamps = true;

    /*
    |----------------------------------------------------------------------
    | Mass Assignment
    |----------------------------------------------------------------------
    */
 protected $fillable = [
    'kode_reservasi',
    'id_pelanggan',
    'id_kamar',
    'tanggal_pesan',
    'check_in',
    'check_out',
    'lama_menginap',
    'harga_per_malam',
    'diskon_persen',
    'diskon_nominal',
    'pajak_persen',
    'pajak_nominal',
    'total_harga',
    'jumlah_dewasa',
    'jumlah_anak',
    'status_reservasi',
    'status_pembayaran',
    'approval_admin',
    'metode_pembayaran',
    'catatan',
];

    /*
    |----------------------------------------------------------------------
    | Casting
    |----------------------------------------------------------------------
    */
    protected $casts = [
        'tanggal_pesan'   => 'datetime',
        'check_in'        => 'date',
        'check_out'       => 'date',

        'harga_per_malam' => 'decimal:2',
        'total_harga'     => 'decimal:2',
        'diskon_persen'   => 'decimal:2',
        'diskon_nominal'  => 'decimal:2',
        'pajak_persen'    => 'decimal:2',

        'lama_menginap'   => 'integer',
        'jumlah_dewasa'   => 'integer',
        'jumlah_anak'     => 'integer',
    ];

    /*
    |----------------------------------------------------------------------
    | Relasi
    |----------------------------------------------------------------------
    */
    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'id_pelanggan', 'id_pelanggan');
    }

    public function kamar()
    {
        return $this->belongsTo(Kamar::class, 'id_kamar', 'id_kamar');
    }

    /*
    |----------------------------------------------------------------------
    | Accessors
    |----------------------------------------------------------------------
    */
    public function getTotalTamuAttribute()
    {
        return $this->jumlah_dewasa + $this->jumlah_anak;
    }

    public function getStatusReservasiLabelAttribute()
    {
        return match ($this->status_reservasi) {
            'pending'   => 'Pending',
            'confirmed' => 'Confirmed',
            'checkin'   => 'Check In',
            'checkout'  => 'Check Out',
            'cancelled' => 'Cancelled',
            'no_show'   => 'No Show',
            default     => ucfirst($this->status_reservasi ?? ''),
        };
    }

    public function getStatusPembayaranLabelAttribute()
    {
        return match ($this->status_pembayaran) {
            'paid'     => 'Lunas',
            'partial'  => 'Dibayar Sebagian',
            'unpaid'   => 'Belum Dibayar',
            'refunded' => 'Refund',
            default    => ucfirst($this->status_pembayaran ?? ''),
        };
    }

    public function getStatusReservasiBadgeAttribute()
    {
        return match ($this->status_reservasi) {
            'pending'   => 'warning',
            'confirmed' => 'success',
            'checkin'   => 'primary',
            'checkout'  => 'secondary',
            'cancelled' => 'danger',
            'no_show'   => 'dark',
            default     => 'secondary',
        };
    }

    /*
    |----------------------------------------------------------------------
    | Scopes
    |----------------------------------------------------------------------
    */
    public function scopeActive($query)
    {
        return $query->whereIn('status_reservasi', [
            'pending',
            'confirmed',
            'checkin'
        ]);
    }

    public function scopePending($query)
    {
        return $query->where('status_reservasi', 'pending');
    }

    public function scopeConfirmed($query)
    {
        return $query->where('status_reservasi', 'confirmed');
    }

    public function scopeByDateRange($query, $start, $end)
    {
        return $query->whereBetween('check_in', [$start, $end]);
    }

     public function pembayaran()
    {
        return $this->hasMany(Pembayaran::class, 'id_reservasi', 'id_reservasi');
    }
}
