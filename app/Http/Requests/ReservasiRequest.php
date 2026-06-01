<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReservasiRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id_pelanggan' => 'required|exists:pelanggan,id_pelanggan',
            'id_kamar' => 'required|exists:kamar,id_kamar',

            'check_in' => 'required|date',
            'check_out' => 'required|date|after:check_in',

            'jumlah_dewasa' => 'required|integer|min:1',
            'jumlah_anak' => 'nullable|integer|min:0',

            'catatan' => 'nullable|string',
        ];
    }
}
