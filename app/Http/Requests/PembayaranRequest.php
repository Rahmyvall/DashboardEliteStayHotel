<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PembayaranRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
  public function rules(): array
{
    return [
        'id_reservasi' => 'required|exists:reservasi,id_reservasi',
        'metode_pembayaran' => 'required',
        'jumlah_bayar' => 'required|numeric|min:0',
        'status_pembayaran' => 'required',
    ];
}
}
