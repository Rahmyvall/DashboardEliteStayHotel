<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganApiController extends Controller
{
    /**
     * GET ALL DATA
     */
    public function index()
    {
        $pelanggan = Pelanggan::with('user')->latest()->get();

        return response()->json([
            'success' => true,
            'message' => 'Data pelanggan berhasil diambil',
            'data'    => $pelanggan
        ], 200);
    }

    /**
     * STORE DATA
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_user'        => 'required',
            'nik'            => 'required',
            'jenis_kelamin'  => 'required',
            'alamat'         => 'required',
            'kota'           => 'required',
            'negara'         => 'required',
            'tanggal_lahir'  => 'required|date',
        ]);

        $pelanggan = Pelanggan::create([
            'id_user'        => $request->id_user,
            'nik'            => $request->nik,
            'jenis_kelamin'  => $request->jenis_kelamin,
            'alamat'         => $request->alamat,
            'kota'           => $request->kota,
            'negara'         => $request->negara,
            'tanggal_lahir'  => $request->tanggal_lahir,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data pelanggan berhasil ditambahkan',
            'data'    => $pelanggan
        ], 201);
    }

    /**
     * SHOW DETAIL
     */
    public function show($id)
    {
        $pelanggan = Pelanggan::with('user')
            ->find($id);

        if (!$pelanggan) {
            return response()->json([
                'success' => false,
                'message' => 'Data pelanggan tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data'    => $pelanggan
        ], 200);
    }

    /**
     * UPDATE DATA
     */
    public function update(Request $request, $id)
    {
        $pelanggan = Pelanggan::find($id);

        if (!$pelanggan) {
            return response()->json([
                'success' => false,
                'message' => 'Data pelanggan tidak ditemukan'
            ], 404);
        }

        $request->validate([
            'nik'            => 'required',
            'jenis_kelamin'  => 'required',
            'alamat'         => 'required',
            'kota'           => 'required',
            'negara'         => 'required',
            'tanggal_lahir'  => 'required|date',
        ]);

        $pelanggan->update([
            'nik'            => $request->nik,
            'jenis_kelamin'  => $request->jenis_kelamin,
            'alamat'         => $request->alamat,
            'kota'           => $request->kota,
            'negara'         => $request->negara,
            'tanggal_lahir'  => $request->tanggal_lahir,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data pelanggan berhasil diupdate',
            'data'    => $pelanggan
        ], 200);
    }

    /**
     * DELETE DATA
     */
    public function destroy($id)
    {
        $pelanggan = Pelanggan::find($id);

        if (!$pelanggan) {
            return response()->json([
                'success' => false,
                'message' => 'Data pelanggan tidak ditemukan'
            ], 404);
        }

        $pelanggan->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data pelanggan berhasil dihapus'
        ], 200);
    }
}