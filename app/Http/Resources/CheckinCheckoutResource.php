<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CheckinCheckoutResource extends JsonResource
{
    public function toArray(Request $request)
    {
        return [
            'id_check' => $this->id_check,
            'id_reservasi' => $this->id_reservasi,
            'reservasi' => $this->whenLoaded('reservasi'),

            'waktu_checkin' => $this->waktu_checkin?->format('Y-m-d H:i:s'),
            'waktu_checkout' => $this->waktu_checkout?->format('Y-m-d H:i:s'),
            'waktu_checkin_aktual' => $this->waktu_checkin_aktual?->format('Y-m-d H:i:s'),
            'waktu_checkout_aktual' => $this->waktu_checkout_aktual?->format('Y-m-d H:i:s'),

            'status' => $this->status,
            'is_late_checkout' => $this->is_late_checkout,

            'deposit' => $this->deposit,
            'biaya_tambahan' => $this->biaya_tambahan,
            'denda_late_checkout' => $this->denda_late_checkout,
            'total_tagihan' => $this->total_tagihan,
            'total_bayar' => $this->total_bayar,

            'jumlah_tamu_aktual' => $this->jumlah_tamu_aktual,
            'kondisi_kamar' => $this->kondisi_kamar,
            'catatan' => $this->catatan,
            'catatan_checkout' => $this->catatan_checkout,

            'created_by' => $this->createdBy?->name,
            'checked_in_by' => $this->checkedInBy?->name,
            'checked_out_by' => $this->checkedOutBy?->name,

            'created_at' => $this->created_at?->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at?->format('Y-m-d H:i:s'),
        ];
    }
}
