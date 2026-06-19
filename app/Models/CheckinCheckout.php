<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CheckinCheckout extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'checkin_checkout';

    protected $primaryKey = 'id_check';

    protected $fillable = [
        'id_reservasi',
        'waktu_checkin',
        'waktu_checkout',
        'waktu_checkin_aktual',
        'waktu_checkout_aktual',
        'status',
        'deposit',
        'biaya_tambahan',
        'denda_late_checkout',
        'total_bayar',
        'jumlah_tamu_aktual',
        'kondisi_kamar',
        'is_late_checkout',
        'catatan',
        'catatan_checkout',
        'created_by',
        'checked_in_by',
        'checked_out_by',
    ];

    protected $casts = [
        'waktu_checkin' => 'datetime',
        'waktu_checkout' => 'datetime',
        'waktu_checkin_aktual' => 'datetime',
        'waktu_checkout_aktual' => 'datetime',

        'deposit' => 'decimal:2',
        'biaya_tambahan' => 'decimal:2',
        'denda_late_checkout' => 'decimal:2',
        'total_bayar' => 'decimal:2',

        'is_late_checkout' => 'boolean',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELATION
    |--------------------------------------------------------------------------
    */

    public function reservasi(): BelongsTo
    {
        return $this->belongsTo(
            Reservasi::class,
            'id_reservasi',
            'id_reservasi'
        );
    }

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'id_pelanggan');
    }

    public function kamar()
    {
        return $this->belongsTo(Kamar::class, 'id_kamar');
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'created_by',
            'id_user'
        );
    }

    public function checkedInBy(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'checked_in_by',
            'id_user'
        );
    }

    public function checkedOutBy(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'checked_out_by',
            'id_user'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | ACCESSOR
    |--------------------------------------------------------------------------
    */

    public function getTotalBiayaAttribute(): float
    {
        return
            ($this->deposit ?? 0) +
            ($this->biaya_tambahan ?? 0) +
            ($this->denda_late_checkout ?? 0);
    }

    public function getDurasiMenginapAttribute(): ?int
    {
        if (
            !$this->waktu_checkin_aktual ||
            !$this->waktu_checkout_aktual
        ) {
            return null;
        }

        return $this->waktu_checkin_aktual
            ->diffInDays($this->waktu_checkout_aktual);
    }
}