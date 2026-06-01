<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Models\Kamar;
use App\Models\Reservasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\ReservasiRequest;

class ReservasiController extends Controller
{
    public function index()
    {
        $data = Reservasi::with([
            'pelanggan',
            'kamar',
            'tagihan',
            'pembayaran'
        ])->latest()->paginate(10);

        return response()->json($data);
    }

    public function store(ReservasiRequest $request)
    {
        DB::beginTransaction();

        try {

            $kamar = Kamar::findOrFail($request->id_kamar);

            $checkIn = Carbon::parse($request->check_in);
            $checkOut = Carbon::parse($request->check_out);

            $lamaMenginap = $checkIn->diffInDays($checkOut);

            $subtotal = $lamaMenginap * $kamar->harga_per_malam;

            $reservasi = Reservasi::create([
                'kode_reservasi' => 'RSV-' . now()->format('YmdHis') . strtoupper(Str::random(4)),
                'id_pelanggan' => $request->id_pelanggan,
                'id_kamar' => $request->id_kamar,
                'check_in' => $request->check_in,
                'check_out' => $request->check_out,
                'lama_menginap' => $lamaMenginap,
                'jumlah_dewasa' => $request->jumlah_dewasa,
                'jumlah_anak' => $request->jumlah_anak ?? 0,
                'harga_per_malam' => $kamar->harga_per_malam,
                'subtotal' => $subtotal,
                'status_reservasi' => 'pending',
                'catatan' => $request->catatan,
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Reservasi berhasil dibuat',
                'data' => $reservasi
            ], 201);

        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function show(string $id)
    {
        $reservasi = Reservasi::with([
            'pelanggan',
            'kamar',
            'tagihan',
            'pembayaran'
        ])->findOrFail($id);

        return response()->json($reservasi);
    }

    public function update(ReservasiRequest $request, string $id)
    {
        $reservasi = Reservasi::findOrFail($id);

        $reservasi->update($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Reservasi berhasil diupdate',
            'data' => $reservasi
        ]);
    }

    public function destroy(string $id)
    {
        $reservasi = Reservasi::findOrFail($id);

        $reservasi->delete();

        return response()->json([
            'success' => true,
            'message' => 'Reservasi berhasil dihapus'
        ]);
    }
}
