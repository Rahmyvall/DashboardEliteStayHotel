<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TipeKamarFasilitas;
use Illuminate\Http\Request;

class TipeKamarFasilitasController extends Controller
{
    /**
     * GET ALL DATA
     */
    public function index()
    {
        $data = TipeKamarFasilitas::with([
            'tipeKamar',
            'fasilitas'
        ])->latest()->get();

        return response()->json([
            'success' => true,
            'message' => 'List data tipe kamar fasilitas',
            'total'   => $data->count(),
            'data'    => $data
        ], 200);
    }

    /**
     * STORE DATA
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_tipe'       => 'required|exists:tipe_kamar,id_tipe',
            'id_fasilitas'  => 'required|exists:fasilitas,id_fasilitas',
        ]);

        /*
        |--------------------------------------------------------------------------
        | CEK DUPLIKAT
        |--------------------------------------------------------------------------
        */
        $cek = TipeKamarFasilitas::where('id_tipe', $request->id_tipe)
                    ->where('id_fasilitas', $request->id_fasilitas)
                    ->first();

        if ($cek) {
            return response()->json([
                'success' => false,
                'message' => 'Relasi tipe kamar fasilitas sudah tersedia'
            ], 409);
        }

        $data = TipeKamarFasilitas::create([
            'id_tipe'      => $request->id_tipe,
            'id_fasilitas' => $request->id_fasilitas,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil ditambahkan',
            'data'    => $data->load([
                'tipeKamar',
                'fasilitas'
            ])
        ], 201);
    }

    /**
     * SHOW DETAIL
     */
    public function show($id)
    {
        $data = TipeKamarFasilitas::with([
            'tipeKamar',
            'fasilitas'
        ])->find($id);

        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Detail tipe kamar fasilitas',
            'data'    => $data
        ], 200);
    }

    /**
     * UPDATE DATA
     */
    public function update(Request $request, $id)
    {
        $data = TipeKamarFasilitas::find($id);

        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        $request->validate([
            'id_tipe'       => 'required|exists:tipe_kamar,id_tipe',
            'id_fasilitas'  => 'required|exists:fasilitas,id_fasilitas',
        ]);

        /*
        |--------------------------------------------------------------------------
        | CEK DUPLIKAT KECUALI DATA SENDIRI
        |--------------------------------------------------------------------------
        */
        $cek = TipeKamarFasilitas::where('id_tipe', $request->id_tipe)
                    ->where('id_fasilitas', $request->id_fasilitas)
                    ->where('id', '!=', $id)
                    ->first();

        if ($cek) {
            return response()->json([
                'success' => false,
                'message' => 'Relasi tipe kamar fasilitas sudah tersedia'
            ], 409);
        }

        $data->update([
            'id_tipe'      => $request->id_tipe,
            'id_fasilitas' => $request->id_fasilitas,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil diupdate',
            'data'    => $data->load([
                'tipeKamar',
                'fasilitas'
            ])
        ], 200);
    }

    /**
     * DELETE DATA
     */
    public function destroy($id)
    {
        $data = TipeKamarFasilitas::find($id);

        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        $data->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil dihapus'
        ], 200);
    }
}
