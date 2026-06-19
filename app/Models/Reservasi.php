<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Reservasi extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'reservasi';
    protected $primaryKey = 'id_reservasi';

    /*
    |--------------------------------------------------------------------------
    | STATUS RESERVASI
    |--------------------------------------------------------------------------
    */
    public const STATUS_PENDING   = 'pending';
    public const STATUS_CONFIRMED = 'confirmed';
    public const STATUS_CHECKIN   = 'checkin';
    public const STATUS_CHECKOUT  = 'checkout';
    public const STATUS_CANCELLED = 'cancelled';
    public const STATUS_NOSHOW    = 'no_show';

    /*
    |--------------------------------------------------------------------------
    | STATUS PEMBAYARAN (FIX UTAMA BIAR TIDAK ERROR LAGI)
    |--------------------------------------------------------------------------
    */
    public const PAYMENT_UNPAID   = 'unpaid';
    public const PAYMENT_PARTIAL  = 'partial';
    public const PAYMENT_PAID     = 'paid';
    public const PAYMENT_REFUNDED = 'refunded';

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

    protected $casts = [
        'tanggal_pesan' => 'datetime',
        'check_in'  => 'date',
        'check_out' => 'date',

        'lama_menginap' => 'integer',
        'jumlah_dewasa' => 'integer',
        'jumlah_anak'   => 'integer',

        'harga_per_malam' => 'decimal:2',
        'total_harga'     => 'decimal:2',

        'diskon_persen'  => 'decimal:2',
        'diskon_nominal' => 'decimal:2',

        'pajak_persen'   => 'decimal:2',
        'pajak_nominal'  => 'decimal:2',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELATIONSHIP
    |--------------------------------------------------------------------------
    */
    public function pelanggan(): BelongsTo
    {
        return $this->belongsTo(Pelanggan::class, 'id_pelanggan', 'id_pelanggan');
    }

    public function kamar(): BelongsTo
    {
        return $this->belongsTo(Kamar::class, 'id_kamar', 'id_kamar');
    }

    public function pembayaran(): HasMany
    {
        return $this->hasMany(Pembayaran::class, 'id_reservasi', 'id_reservasi');
    }

    public function checkinCheckout(): HasOne
    {
        return $this->hasOne(CheckinCheckout::class, 'id_reservasi', 'id_reservasi');
    }

    public function review(): HasOne
    {
        return $this->hasOne(Review::class, 'id_reservasi', 'id_reservasi');
    }

    /*
    |--------------------------------------------------------------------------
    | ACCESSOR
    |--------------------------------------------------------------------------
    */
    public function getTotalTamuAttribute(): int
    {
        return (int) $this->jumlah_dewasa + (int) $this->jumlah_anak;
    }

    public function getTotalDibayarAttribute(): float
    {
        return (float) $this->pembayaran()
            ->where('status_pembayaran', self::PAYMENT_PAID)
            ->sum('jumlah_bayar');
    }

    public function getSisaPembayaranAttribute(): float
    {
        return max(0, (float) $this->total_harga - (float) $this->total_dibayar);
    }

    public function getSudahLunasAttribute(): bool
    {
        return $this->sisa_pembayaran <= 0;
    }

    public function getStatusPembayaranLabelAttribute(): string
    {
        return match ($this->status_pembayaran) {
            self::PAYMENT_UNPAID   => 'Belum Dibayar',
            self::PAYMENT_PARTIAL  => 'Dibayar Sebagian',
            self::PAYMENT_PAID     => 'Lunas',
            self::PAYMENT_REFUNDED => 'Refund',
            default => '-',
        };
    }

    public function getStatusReservasiLabelAttribute(): string
    {
        return match ($this->status_reservasi) {
            self::STATUS_PENDING   => 'Pending',
            self::STATUS_CONFIRMED => 'Confirmed',
            self::STATUS_CHECKIN   => 'Check In',
            self::STATUS_CHECKOUT  => 'Check Out',
            self::STATUS_CANCELLED => 'Cancelled',
            self::STATUS_NOSHOW    => 'No Show',
            default => '-',
        };
    }

    public function getStatusReservasiBadgeAttribute(): string
    {
        return match ($this->status_reservasi) {
            self::STATUS_PENDING   => 'warning',
            self::STATUS_CONFIRMED => 'success',
            self::STATUS_CHECKIN   => 'primary',
            self::STATUS_CHECKOUT  => 'secondary',
            self::STATUS_CANCELLED => 'danger',
            self::STATUS_NOSHOW    => 'dark',
            default => 'secondary',
        };
    }

    /*
    |--------------------------------------------------------------------------
    | HELPER
    |--------------------------------------------------------------------------
    */
    public function isPending(): bool
    {
        return $this->status_reservasi === self::STATUS_PENDING;
    }

    public function isConfirmed(): bool
    {
        return $this->status_reservasi === self::STATUS_CONFIRMED;
    }

    public function isCheckin(): bool
    {
        return $this->status_reservasi === self::STATUS_CHECKIN;
    }

    public function isCheckout(): bool
    {
        return $this->status_reservasi === self::STATUS_CHECKOUT;
    }

    public function isCancelled(): bool
    {
        return $this->status_reservasi === self::STATUS_CANCELLED;
    }

    public function sudahCheckin(): bool
    {
        return $this->checkinCheckout()->exists();
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPE
    |--------------------------------------------------------------------------
    */
    public function scopeActive(Builder $query): Builder
    {
        return $query->whereIn('status_reservasi', [
            self::STATUS_PENDING,
            self::STATUS_CONFIRMED,
            self::STATUS_CHECKIN,
        ]);
    }

    public function scopeConfirmed(Builder $query): Builder
    {
        return $query->where('status_reservasi', self::STATUS_CONFIRMED);
    }

    public function scopeCheckin(Builder $query): Builder
    {
        return $query->where('status_reservasi', self::STATUS_CHECKIN);
    }

    public function scopeCheckout(Builder $query): Builder
    {
        return $query->where('status_reservasi', self::STATUS_CHECKOUT);
    }

    public function scopeCancelled(Builder $query): Builder
    {
        return $query->where('status_reservasi', self::STATUS_CANCELLED);
    }

    public function scopeByDateRange(Builder $query, $start, $end): Builder
    {
        return $query->whereBetween('check_in', [$start, $end]);
    }
}
