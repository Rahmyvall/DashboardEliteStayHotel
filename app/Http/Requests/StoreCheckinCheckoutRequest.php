<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCheckinCheckoutRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id_reservasi'          => 'required|exists:reservasi,id_reservasi|unique:checkin_checkout',
            'waktu_checkin'         => 'nullable|date',
            'waktu_checkout'        => 'nullable|date|after_or_equal:waktu_checkin',
            'status'                => 'in:pending,checked_in,checked_out,late_checkout,cancelled',
            'deposit'               => 'numeric|min:0',
            'jumlah_tamu_aktual'    => 'nullable|integer|min:1',
            'kondisi_kamar'         => 'nullable|string|max:50',
            'catatan'               => 'nullable|string',
        ];
    }
}
