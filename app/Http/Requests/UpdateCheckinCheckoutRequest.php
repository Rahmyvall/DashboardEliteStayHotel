<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCheckinCheckoutRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'waktu_checkin_aktual'  => 'nullable|date',
            'waktu_checkout_aktual' => 'nullable|date',
            'status'                => 'in:pending,checked_in,checked_out,late_checkout,cancelled',
            'biaya_tambahan'        => 'numeric|min:0',
            'denda_late_checkout'   => 'numeric|min:0',
            'total_bayar'           => 'numeric|min:0',
            'jumlah_tamu_aktual'    => 'nullable|integer|min:1',
            'kondisi_kamar'         => 'nullable|string|max:50',
            'catatan_checkout'      => 'nullable|string',
            'is_late_checkout'      => 'boolean',
        ];
    }
}
