<?php

namespace App\Http\Controllers;

use App\Models\Reservasi;
use App\Models\Pelanggan;
use App\Models\Kamar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReservasiController extends Controller
{
    public function index()
    {
        $reservasi = Reservasi::with(['pelanggan.user', 'kamar.tipe_kamar'])
            ->latest('id_reservasi')
            ->paginate(10);

        return view('pages.reservasi.index', compact('reservasi'));
    }

    public function create()
    {
        $pelanggan = Pelanggan::with('user')->get();

        $kamar = Kamar::with('tipe_kamar')
            ->where('status_kamar', 'tersedia')
            ->orderBy('nomor_kamar')
            ->get();

        return view('pages.reservasi.create', compact('pelanggan', 'kamar'));
    }

    public function store(Request $request)
    {
        $data = $this->validateData($request);

        return DB::transaction(function () use ($data) {

            $data = $this->calculateReservation($data, false);

            // 🔥 DOUBLE BOOKING CHECK (lebih aman)
            $isBooked = Reservasi::where('id_kamar', $data['id_kamar'])
                ->whereIn('status_reservasi', ['pending', 'confirmed', 'checkin'])
                ->where(function ($q) use ($data) {
                    $q->whereBetween('check_in', [$data['check_in'], $data['check_out']])
                      ->orWhereBetween('check_out', [$data['check_in'], $data['check_out']]);
                })
                ->exists();

            if ($isBooked) {
                throw new \Exception('Kamar sudah dibooking pada tanggal tersebut');
            }

            $reservasi = Reservasi::create($data);

            // ✅ FIX: pakai ENUM yang benar
            Kamar::where('id_kamar', $data['id_kamar'])
                ->update(['status_kamar' => 'terisi']);

            return redirect()
                ->route('reservasi.index')
                ->with('success', 'Reservasi berhasil dibuat');
        });
    }

    public function update(Request $request, $id)
    {
        $reservasi = Reservasi::findOrFail($id);

        $data = $this->validateData($request);

        return DB::transaction(function () use ($reservasi, $data) {

            $data = $this->calculateReservation($data, true);

            $reservasi->update($data);

            return redirect()
                ->route('reservasi.index')
                ->with('success', 'Reservasi berhasil diperbarui');
        });
    }

    public function show($id)
{
    $reservasi = Reservasi::with(['pelanggan.user', 'kamar.tipe_kamar'])
        ->findOrFail($id);

    return view('pages.reservasi.show', compact('reservasi'));
}

    public function approve($id)
    {
        Reservasi::findOrFail($id)->update([
            'approval_admin' => 'approved',
            'status_reservasi' => 'confirmed'
        ]);

        return back()->with('success', 'Reservasi disetujui');
    }

    public function reject($id)
    {
        Reservasi::findOrFail($id)->update([
            'approval_admin' => 'rejected',
            'status_reservasi' => 'cancelled'
        ]);

        return back()->with('success', 'Reservasi ditolak');
    }

    public function destroy($id)
    {
        $reservasi = Reservasi::findOrFail($id);

        // 🔥 release kamar saat delete
        Kamar::where('id_kamar', $reservasi->id_kamar)
            ->update(['status_kamar' => 'tersedia']);

        $reservasi->delete();

        return back()->with('success', 'Data berhasil dihapus');
    }

    private function validateData(Request $request)
    {
        return $request->validate([
            'id_pelanggan' => 'required|exists:pelanggan,id_pelanggan',
            'id_kamar' => 'required|exists:kamar,id_kamar',

            'check_in' => 'required|date',
            'check_out' => 'required|date|after_or_equal:check_in',

            'jumlah_dewasa' => 'nullable|integer|min:1',
            'jumlah_anak' => 'nullable|integer|min:0',

            'diskon_persen' => 'nullable|numeric|min:0|max:100',
            'pajak_persen' => 'nullable|numeric|min:0|max:100',

            'status_pembayaran' => 'required|in:unpaid,partial,paid,refunded',
            'metode_pembayaran' => 'nullable|string|max:50',
            'catatan' => 'nullable|string|max:500',
        ]);
    }

    private function calculateReservation(array $data, $isUpdate = false)
    {
        $checkIn = Carbon::parse($data['check_in']);
        $checkOut = Carbon::parse($data['check_out']);

        $lama = max(1, $checkIn->diffInDays($checkOut));

        $kamar = Kamar::with('tipe_kamar')
            ->findOrFail($data['id_kamar']);

        $harga = $kamar->harga_per_malam
            ?? $kamar->tipe_kamar?->harga_per_malam
            ?? 250000;

        $diskon = $data['diskon_persen'] ?? 0;
        $pajak = $data['pajak_persen'] ?? 0;

        $subtotal = $harga * $lama;
        $diskonNominal = $subtotal * ($diskon / 100);
        $afterDiskon = $subtotal - $diskonNominal;
        $pajakNominal = $afterDiskon * ($pajak / 100);

        $data['lama_menginap'] = $lama;
        $data['harga_per_malam'] = $harga;
        $data['diskon_nominal'] = $diskonNominal;
        $data['pajak_nominal'] = $pajakNominal;
        $data['total_harga'] = $afterDiskon + $pajakNominal;

        $data['jumlah_dewasa'] = $data['jumlah_dewasa'] ?? 1;
        $data['jumlah_anak'] = $data['jumlah_anak'] ?? 0;

        if (!$isUpdate) {
            $data['kode_reservasi'] = 'RSV-' . now()->format('YmdHis') . rand(100, 999);
            $data['status_reservasi'] = 'pending';
            $data['approval_admin'] = 'pending';
            $data['tanggal_pesan'] = now();
        }

        return $data;
    }
}