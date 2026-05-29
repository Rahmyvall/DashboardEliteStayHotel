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
    // =========================
    // INDEX
    // =========================
    public function index()
    {
        $reservasi = Reservasi::with(['pelanggan', 'kamar.tipe_kamar'])
            ->orderByDesc('id_reservasi')
            ->paginate(10);

        return view('pages.reservasi.index', compact('reservasi'));
    }

    // =========================
    // CREATE
    // =========================
    public function create()
    {
        $pelanggan = Pelanggan::orderBy('id_pelanggan')->get();

        $kamar = Kamar::with('tipe_kamar')
            ->orderBy('nomor_kamar')
            ->get();

        return view('pages.reservasi.create', compact('pelanggan', 'kamar'));
    }

    public function edit($id)
{
    $reservasi = Reservasi::with(['pelanggan', 'kamar.tipe_kamar'])
        ->findOrFail($id);

    $pelanggan = Pelanggan::orderBy('id_pelanggan')->get();

    $kamar = Kamar::with('tipe_kamar')
        ->orderBy('nomor_kamar')
        ->get();

    return view('pages.reservasi.edit', compact(
        'reservasi',
        'pelanggan',
        'kamar'
    ));
}
    // =========================
    // STORE
    // =========================
    public function store(Request $request)
    {
        $data = $request->validate([
            'id_pelanggan'      => 'required|exists:pelanggan,id_pelanggan',
            'id_kamar'          => 'required|exists:kamar,id_kamar',
            'check_in'          => 'required|date',
            'lama_menginap'     => 'required|integer|min:1',

            'status_reservasi'  => 'required|string',
            'status_pembayaran' => 'required|string',
            'metode_pembayaran' => 'nullable|string|max:50',

            'diskon_persen'     => 'nullable|numeric|min:0|max:100',
            'pajak_persen'      => 'nullable|numeric|min:0|max:100',
        ]);

        DB::beginTransaction();

        try {

            // =========================
            // SAFE INTEGER
            // =========================
            $lama = (int) $data['lama_menginap'];

            // =========================
            // CHECK IN / OUT SAFE
            // =========================
            $checkIn = Carbon::parse($data['check_in']);
            $checkOut = (clone $checkIn)->addDays($lama);

            $data['check_out'] = $checkOut->toDateString();

            // =========================
            // AMBIL KAMAR
            // =========================
            $kamar = Kamar::with('tipe_kamar')->findOrFail($data['id_kamar']);

            $harga = (float) ($kamar->tipe_kamar->harga_per_malam ?? 0);

            // =========================
            // HITUNG
            // =========================
            $subtotal = $harga * $lama;

            $diskonPersen = (float) ($data['diskon_persen'] ?? 0);
            $pajakPersen  = (float) ($data['pajak_persen'] ?? 0);

            $diskonNominal = $subtotal * $diskonPersen / 100;
            $afterDiskon   = $subtotal - $diskonNominal;

            $pajakNominal  = $afterDiskon * $pajakPersen / 100;

            $total = $afterDiskon + $pajakNominal;

            // =========================
            // AUTO KODE (SAFE UNIQUE)
            // =========================
            $last = Reservasi::latest('id_reservasi')->first();

            if ($last && $last->kode_reservasi) {
                preg_match('/(\d+)$/', $last->kode_reservasi, $m);
                $number = isset($m[1]) ? ((int)$m[1] + 1) : 1;
            } else {
                $number = 1;
            }

            $data['kode_reservasi'] = 'RSV' . str_pad($number, 4, '0', STR_PAD_LEFT);

            // =========================
            // SAVE DATA
            // =========================
            $data['harga_per_malam'] = $harga;
            $data['diskon_nominal']  = $diskonNominal;
            $data['total_harga']     = $total;
            $data['tanggal_pesan']   = now();

            Reservasi::create($data);

            DB::commit();

            return redirect()->route('reservasi.index')
                ->with('success', 'Reservasi berhasil dibuat');

        } catch (\Exception $e) {
            DB::rollBack();

            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    // =========================
    // UPDATE
    // =========================
   public function update(Request $request, $id)
{
    $reservasi = Reservasi::findOrFail($id);

    $data = $request->validate([
        'id_pelanggan'      => 'required|exists:pelanggan,id_pelanggan',
        'id_kamar'          => 'required|exists:kamar,id_kamar',
        'check_in'          => 'required|date',
        'lama_menginap'     => 'required|integer|min:1',

        'status_reservasi'  => 'required|string',
        'status_pembayaran' => 'required|string',
        'metode_pembayaran' => 'nullable|string|max:50',

        'diskon_persen'     => 'nullable|numeric|min:0|max:100',
        'pajak_persen'      => 'nullable|numeric|min:0|max:100',
    ]);

    DB::beginTransaction();

    try {

        // =========================
        // HITUNG ULANG CHECKOUT
        // =========================
        $lama = (int) $data['lama_menginap'];

        $checkIn = Carbon::parse($data['check_in']);
        $checkOut = (clone $checkIn)->addDays($lama);

        $data['check_out'] = $checkOut->toDateString();

        // =========================
        // AMBIL KAMAR
        // =========================
        $kamar = Kamar::with('tipe_kamar')
            ->findOrFail($data['id_kamar']);

        $harga = (float) ($kamar->tipe_kamar->harga_per_malam ?? 0);

        // =========================
        // HITUNG ULANG TOTAL
        // =========================
        $subtotal = $harga * $lama;

        $diskonPersen = (float) ($data['diskon_persen'] ?? 0);
        $pajakPersen  = (float) ($data['pajak_persen'] ?? 0);

        $diskonNominal = $subtotal * $diskonPersen / 100;
        $afterDiskon   = $subtotal - $diskonNominal;

        $pajakNominal  = $afterDiskon * $pajakPersen / 100;

        $total = $afterDiskon + $pajakNominal;

        // =========================
        // UPDATE DATA RESERVASI
        // =========================
        $data['harga_per_malam'] = $harga;
        $data['diskon_nominal']  = $diskonNominal;
        $data['total_harga']     = $total;

        $reservasi->update($data);

        DB::commit();

        return redirect()->route('reservasi.index')
            ->with('success', 'Reservasi berhasil diupdate');

    } catch (\Exception $e) {
        DB::rollBack();

        return back()->withErrors(['error' => $e->getMessage()]);
    }
}

    // =========================
    // SHOW
    // =========================
    public function show($id)
    {
        $reservasi = Reservasi::with(['pelanggan', 'kamar.tipe_kamar'])
            ->findOrFail($id);

        return view('pages.reservasi.show', compact('reservasi'));
    }

    // =========================
    // DELETE
    // =========================
    public function destroy($id)
    {
        Reservasi::findOrFail($id)->delete();

        return redirect()->route('reservasi.index')
            ->with('success', 'Data berhasil dihapus');
    }
}