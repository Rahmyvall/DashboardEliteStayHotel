<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PelangganResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id_pelanggan' => $this->id_pelanggan,
            'nama'         => $this->user->nama_lengkap ?? null,
            'email'        => $this->user->email ?? null,
            'nik'          => $this->nik,
            'jenis_kelamin'=> $this->jenis_kelamin,
            'alamat'       => $this->alamat,
            'kota'         => $this->kota,
            'negara'       => $this->negara,
            'tanggal_lahir'=> $this->tanggal_lahir,
        ];
    }
}