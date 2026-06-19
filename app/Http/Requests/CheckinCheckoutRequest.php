<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckinCheckoutRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'id_reservasi' => 'required|exists:reservasi,id_reservasi|unique:checkin_checkout,id_reservasi',
            'waktu_checkin' => 'nullable|date',
            'waktu_checkout' => 'nullable|date|after:waktu_checkin',
            'deposit' => 'nullable|numeric|min:0',
            'total_tagihan' => 'nullable|numeric|min:0',
            'jumlah_tamu_aktual' => 'nullable|integer|min:1',
            'kondisi_kamar' => 'nullable|string|max:100',
            'catatan' => 'nullable|string',
        ];
    }
}
