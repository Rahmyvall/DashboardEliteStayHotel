<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $table = 'pembayaran';
    protected $primaryKey = 'id_pembayaran';

    protected $fillable = [
        'id_reservasi',
        'tanggal_bayar',
        'metode_pembayaran',
        'jumlah_bayar',
        'status_pembayaran',
        'bukti_pembayaran',
    ];

    protected $casts = [
        'tanggal_bayar' => 'datetime',
        'jumlah_bayar'  => 'decimal:2',
    ];

    /* =========================
        RELASI
    ========================= */
    public function reservasi()
    {
        return $this->belongsTo(Reservasi::class, 'id_reservasi', 'id_reservasi');
    }

    /* =========================
        STATUS CONSTANT (FIX ERROR UTAMA)
    ========================= */
    public const STATUS_PENDING = 'pending';
    public const STATUS_PAID    = 'paid';
    public const STATUS_FAILED  = 'failed';
    public const STATUS_REFUND  = 'refund';

    public static function getStatusList(): array
    {
        return [
            self::STATUS_PENDING,
            self::STATUS_PAID,
            self::STATUS_FAILED,
            self::STATUS_REFUND,
        ];
    }

    /* =========================
        METODE PEMBAYARAN
    ========================= */
    public const METHOD_CASH     = 'cash';
    public const METHOD_TRANSFER = 'transfer';
    public const METHOD_CC       = 'credit_card';
    public const METHOD_EWALLET  = 'e-wallet';

    public static function getMethodList(): array
    {
        return [
            self::METHOD_CASH,
            self::METHOD_TRANSFER,
            self::METHOD_CC,
            self::METHOD_EWALLET,
        ];
    }

    /* =========================
        SAFETY GUARD (ANTI ERROR DB)
    ========================= */
    public static function sanitizeStatus($status)
    {
        if (!in_array($status, self::getStatusList())) {
            return self::STATUS_PENDING;
        }

        return $status;
    }
}
