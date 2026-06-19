<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CheckinCheckoutRequest;
use App\Http\Resources\CheckinCheckoutResource;
use App\Models\CheckinCheckout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckinCheckoutController extends Controller
{
    public function index(Request $request)
    {
        $query = CheckinCheckout::with(['reservasi', 'checkedInBy', 'checkedOutBy']);

        // Filter
        if ($request->status) {
            $query->where('status', $request->status);
        }
        if ($request->id_reservasi) {
            $query->where('id_reservasi', $request->id_reservasi);
        }
        if ($request->date_from) {
            $query->whereDate('waktu_checkin', '>=', $request->date_from);
        }
        if ($request->date_to) {
            $query->whereDate('waktu_checkin', '<=', $request->date_to);
        }

        $data = $query->latest()->paginate(15);

        return CheckinCheckoutResource::collection($data);
    }

    public function show($id)
    {
        $check = CheckinCheckout::with(['reservasi', 'checkedInBy', 'checkedOutBy'])->findOrFail($id);
        return new CheckinCheckoutResource($check);
    }

    public function store(CheckinCheckoutRequest $request)
    {
        $data = $request->validated();
        $data['created_by'] = Auth::id();

        $checkinCheckout = CheckinCheckout::create($data);

        return response()->json([
            'message' => 'Data checkin berhasil dibuat',
            'data' => new CheckinCheckoutResource($checkinCheckout)
        ], 201);
    }

    // === Custom Action ===
    public function checkIn(Request $request, $id_reservasi)
    {
        $check = CheckinCheckout::where('id_reservasi', $id_reservasi)->firstOrFail();

        $check->update([
            'waktu_checkin_aktual' => now(),
            'status' => 'checked_in',
            'checked_in_by' => Auth::id(),
            'jumlah_tamu_aktual' => $request->jumlah_tamu_aktual,
        ]);

        return response()->json([
            'message' => 'Check-in berhasil dilakukan',
            'data' => new CheckinCheckoutResource($check)
        ]);
    }

    public function checkOut(Request $request, $id_reservasi)
    {
        $check = CheckinCheckout::where('id_reservasi', $id_reservasi)->firstOrFail();

        $denda = $request->denda_late_checkout ?? 0;
        $biayaTambahan = $request->biaya_tambahan ?? 0;

        $check->update([
            'waktu_checkout_aktual' => now(),
            'status' => $denda > 0 ? 'late_checkout' : 'checked_out',
            'checked_out_by' => Auth::id(),
            'kondisi_kamar' => $request->kondisi_kamar,
            'catatan_checkout' => $request->catatan_checkout,
            'denda_late_checkout' => $denda,
            'biaya_tambahan' => $biayaTambahan,
            'total_bayar' => $check->total_tagihan + $biayaTambahan + $denda,
            'is_late_checkout' => $denda > 0,
        ]);

        return response()->json([
            'message' => 'Check-out berhasil dilakukan',
            'data' => new CheckinCheckoutResource($check)
        ]);
    }

    public function update(CheckinCheckoutRequest $request, $id)
    {
        $check = CheckinCheckout::findOrFail($id);
        $check->update($request->validated());

        return response()->json([
            'message' => 'Data berhasil diupdate',
            'data' => new CheckinCheckoutResource($check)
        ]);
    }

    public function destroy($id)
    {
        $check = CheckinCheckout::findOrFail($id);
        $check->delete();

        return response()->json(['message' => 'Data berhasil dihapus']);
    }
}
