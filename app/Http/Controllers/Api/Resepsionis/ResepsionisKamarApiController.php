<?php

namespace App\Http\Controllers\Api\Resepsionis;

use App\Http\Controllers\Controller;
use App\Models\Kamar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ResepsionisKamarApiController extends Controller
{
    /**
     * Display a listing of kamar
     */
    public function index()
    {
        $kamar = Kamar::with('tipeKamar')
            ->latest()
            ->paginate(10);

        return response()->json([
            'success' => true,
            'message' => 'Data kamar berhasil diambil',
            'data' => $kamar
        ]);
    }

    /**
     * Store a newly created kamar
     */
    public function store(Request $request)
    {
        $request->validate([
            'nomor_kamar' => 'required|string|max:10|unique:kamar,nomor_kamar',
            'id_tipe'     => 'required|exists:tipe_kamar,id_tipe',
            'lantai'      => 'required|integer|min:1',
            'status_kamar'=> 'required|in:tersedia,dipesan,terisi,maintenance',
        ]);

        DB::beginTransaction();

        try {

            $kamar = Kamar::create([
                'nomor_kamar' => $request->nomor_kamar,
                'id_tipe'     => $request->id_tipe,
                'lantai'      => $request->lantai,
                'status_kamar'=> $request->status_kamar,
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Kamar berhasil ditambahkan',
                'data' => $kamar
            ], 201);

        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Gagal menambahkan kamar',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display specified kamar
     */
    public function show($id)
    {
        $kamar = Kamar::with('tipeKamar')
            ->find($id);

        if (!$kamar) {

            return response()->json([
                'success' => false,
                'message' => 'Kamar tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $kamar
        ]);
    }

    /**
     * Update kamar
     */
    public function update(Request $request, $id)
    {
        $kamar = Kamar::find($id);

        if (!$kamar) {

            return response()->json([
                'success' => false,
                'message' => 'Kamar tidak ditemukan'
            ], 404);
        }

        $request->validate([
            'nomor_kamar' => 'required|string|max:10|unique:kamar,nomor_kamar,' . $kamar->id_kamar . ',id_kamar',
            'id_tipe'     => 'required|exists:tipe_kamar,id_tipe',
            'lantai'      => 'required|integer|min:1',
            'status_kamar'=> 'required|in:tersedia,dipesan,terisi,maintenance',
        ]);

        DB::beginTransaction();

        try {

            $kamar->update([
                'nomor_kamar' => $request->nomor_kamar,
                'id_tipe'     => $request->id_tipe,
                'lantai'      => $request->lantai,
                'status_kamar'=> $request->status_kamar,
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Kamar berhasil diupdate',
                'data' => $kamar->load('tipeKamar')
            ]);

        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Gagal update kamar',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove kamar
     */
    public function destroy($id)
    {
        $kamar = Kamar::find($id);

        if (!$kamar) {

            return response()->json([
                'success' => false,
                'message' => 'Kamar tidak ditemukan'
            ], 404);
        }

        $kamar->delete();

        return response()->json([
            'success' => true,
            'message' => 'Kamar berhasil dihapus'
        ]);
    }
}
