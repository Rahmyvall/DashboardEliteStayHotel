<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TipeKamar;
use Illuminate\Http\Request;

class TipeKamarController extends Controller
{
    /**
     * GET ALL
     */
    public function index()
    {
        $data = TipeKamar::latest()->get();

        return response()->json([
            'success' => true,
            'message' => 'List data tipe kamar',
            'data' => $data
        ], 200);
    }

    /**
     * STORE
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_tipe' => 'required|string|max:100',
            'deskripsi' => 'nullable|string',
            'harga_per_malam' => 'required|numeric',
            'kapasitas' => 'required|integer',
            'ukuran_kamar' => 'nullable|string'
        ]);

        $data = TipeKamar::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil ditambahkan',
            'data' => $data
        ], 201);
    }

    /**
     * SHOW
     */
    public function show($id)
    {
        $data = TipeKamar::find($id);

        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Detail data tipe kamar',
            'data' => $data
        ], 200);
    }

    /**
     * UPDATE
     */
    public function update(Request $request, $id)
    {
        $data = TipeKamar::find($id);

        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        $request->validate([
            'nama_tipe' => 'required|string|max:100',
            'deskripsi' => 'nullable|string',
            'harga_per_malam' => 'required|numeric',
            'kapasitas' => 'required|integer',
            'ukuran_kamar' => 'nullable|string'
        ]);

        $data->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil diupdate',
            'data' => $data
        ], 200);
    }

    /**
     * DELETE
     */
    public function destroy($id)
    {
        $data = TipeKamar::find($id);

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