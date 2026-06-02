<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class PembayaranController extends Controller
{
    /**
     * Menampilkan seluruh data pembayaran
     */
    public function index()
    {
        $pembayaran = Pembayaran::with('reservasi')
            ->latest()
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'Data pembayaran berhasil diambil',
            'data' => $pembayaran
        ], 200);
    }

    /**
     * Menyimpan data pembayaran baru
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_reservasi' => 'required|exists:reservasi,id_reservasi',
            'tanggal_bayar' => 'nullable|date',
            'metode_pembayaran' => 'required|in:cash,transfer,credit_card,e-wallet',
            'jumlah_bayar' => 'required|numeric|min:0',
            'status_pembayaran' => 'required|in:pending,paid,failed,refund',
            'bukti_pembayaran' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        $data = $validator->validated();

        if ($request->hasFile('bukti_pembayaran')) {
            $data['bukti_pembayaran'] = $request
                ->file('bukti_pembayaran')
                ->store('bukti_pembayaran', 'public');
        }

        $pembayaran = Pembayaran::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Pembayaran berhasil ditambahkan',
            'data' => $pembayaran
        ], 201);
    }

    /**
     * Menampilkan detail pembayaran
     */
    public function show(string $id)
    {
        $pembayaran = Pembayaran::with('reservasi')
            ->find($id);

        if (!$pembayaran) {
            return response()->json([
                'success' => false,
                'message' => 'Pembayaran tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Detail pembayaran',
            'data' => $pembayaran
        ], 200);
    }

    /**
     * Mengupdate data pembayaran
     */
    public function update(Request $request, string $id)
    {
        $pembayaran = Pembayaran::find($id);

        if (!$pembayaran) {
            return response()->json([
                'success' => false,
                'message' => 'Pembayaran tidak ditemukan'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'id_reservasi' => 'sometimes|exists:reservasi,id_reservasi',
            'tanggal_bayar' => 'nullable|date',
            'metode_pembayaran' => 'sometimes|in:cash,transfer,credit_card,e-wallet',
            'jumlah_bayar' => 'sometimes|numeric|min:0',
            'status_pembayaran' => 'sometimes|in:pending,paid,failed,refund',
            'bukti_pembayaran' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        $data = $validator->validated();

        if ($request->hasFile('bukti_pembayaran')) {

            if (
                $pembayaran->bukti_pembayaran &&
                Storage::disk('public')->exists($pembayaran->bukti_pembayaran)
            ) {
                Storage::disk('public')->delete($pembayaran->bukti_pembayaran);
            }

            $data['bukti_pembayaran'] = $request
                ->file('bukti_pembayaran')
                ->store('bukti_pembayaran', 'public');
        }

        $pembayaran->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Pembayaran berhasil diperbarui',
            'data' => $pembayaran
        ], 200);
    }

    /**
     * Menghapus data pembayaran
     */
    public function destroy(string $id)
    {
        $pembayaran = Pembayaran::find($id);

        if (!$pembayaran) {
            return response()->json([
                'success' => false,
                'message' => 'Pembayaran tidak ditemukan'
            ], 404);
        }

        if (
            $pembayaran->bukti_pembayaran &&
            Storage::disk('public')->exists($pembayaran->bukti_pembayaran)
        ) {
            Storage::disk('public')->delete($pembayaran->bukti_pembayaran);
        }

        $pembayaran->delete();

        return response()->json([
            'success' => true,
            'message' => 'Pembayaran berhasil dihapus'
        ], 200);
    }
}
