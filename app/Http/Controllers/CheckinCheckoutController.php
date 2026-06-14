<?php

namespace App\Http\Controllers;

use App\Models\CheckinCheckout;
use App\Models\Reservasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckinCheckoutController extends Controller
{
   public function index(Request $request)
{
    $checkins = CheckinCheckout::with([
        'reservasi.pelanggan',
        'reservasi.kamar.tipeKamar',
        'createdBy',
        'checkedInBy',
        'checkedOutBy'
    ]);

    // Search
    if ($request->filled('search')) {
        $search = $request->search;

        $checkins->where(function ($query) use ($search) {

            $query->where('id_check', 'like', "%{$search}%")

                ->orWhereHas('reservasi', function ($q) use ($search) {
                    $q->where('kode_reservasi', 'like', "%{$search}%");
                })

                ->orWhereHas('reservasi.pelanggan', function ($q) use ($search) {
                    $q->where('nama_lengkap', 'like', "%{$search}%");
                })

                ->orWhereHas('reservasi.kamar', function ($q) use ($search) {
                    $q->where('nomor_kamar', 'like', "%{$search}%");
                });
        });
    }

    // Filter Status
    if ($request->filled('status')) {

        if ($request->status === 'checkin') {

            $checkins->whereNull('waktu_checkout_aktual')
                     ->whereIn('status', [
                         'checked_in',
                         'late_checkout'
                     ]);
        }

        if ($request->status === 'checkout') {

            $checkins->whereNotNull('waktu_checkout_aktual');
        }
    }

    $checkins = $checkins
        ->latest('id_check')
        ->paginate(15)
        ->withQueryString();

    $todayCheckin = CheckinCheckout::whereDate(
        'waktu_checkin_aktual',
        today()
    )->count();

    $todayCheckout = CheckinCheckout::whereDate(
        'waktu_checkout_aktual',
        today()
    )->count();

    $staying = CheckinCheckout::whereNotNull('waktu_checkin_aktual')
        ->whereNull('waktu_checkout_aktual')
        ->count();

    return view(
        'pages.checkin_checkout.index',
        compact(
            'checkins',
            'todayCheckin',
            'todayCheckout',
            'staying'
        )
    );
}

    public function create()
{
    $reservasi = Reservasi::with([
            'pelanggan',
            'kamar'
        ])
        ->where('approval_admin', 'approved')
        ->where('status_reservasi', 'confirmed')
        ->whereDoesntHave('checkinCheckout')
        ->latest('id_reservasi')
        ->get();

    return view('pages.checkin_checkout.create', [
        'reservasi' => $reservasi
    ]);
}

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_reservasi'       => 'required|exists:reservasi,id_reservasi',
            'deposit'            => 'nullable|numeric|min:0',
            'jumlah_tamu_aktual' => 'nullable|integer|min:1',
            'catatan'            => 'nullable|string|max:500',
        ]);

        try {
            DB::transaction(function () use ($validated) {

                $reservasi = Reservasi::with('kamar')
                    ->where('id_reservasi', $validated['id_reservasi'])
                    ->firstOrFail();

                if ($reservasi->checkinCheckout()->exists()) {
                    throw new \Exception('Tamu sudah pernah check-in sebelumnya.');
                }

                $checkin = CheckinCheckout::create([
                    'id_reservasi'         => $reservasi->id_reservasi,
                    'waktu_checkin'        => now(),
                    'waktu_checkin_aktual' => now(),
                    'status'               => 'checked_in',
                    'deposit'              => $validated['deposit'] ?? 0,
                    'jumlah_tamu_aktual'   => $validated['jumlah_tamu_aktual'] ?? $reservasi->jumlah_tamu ?? 1,
                    'catatan'              => $validated['catatan'],
                    'checked_in_by'        => auth()->id(),
                ]);

                // Update Reservasi & Kamar
                $reservasi->update(['status_reservasi' => 'checkin']);

                if ($reservasi->kamar) {
                    $reservasi->kamar->update(['status_kamar' => 'terisi']);
                }
            });

            return redirect()
                ->route('checkin-checkout.index')
                ->with('success', 'Check-In berhasil dilakukan.');

        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }
   public function show($id)
{
    $checkin = CheckinCheckout::with([
        'reservasi.pelanggan',
        'reservasi.kamar.tipeKamar',
        'createdBy',
        'checkedInBy',
        'checkedOutBy'
    ])->findOrFail($id);

    return view('pages.checkin_checkout.show', compact('checkin'));
}


public function edit($id)
{
    $checkin = CheckinCheckout::with([
        'reservasi.pelanggan',
        'reservasi.kamar.tipe_kamar'
    ])->findOrFail($id);

    return view('pages.checkin_checkout.edit', compact('checkin'));
}
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'catatan_checkout'   => 'nullable|string|max:500',
            'biaya_tambahan'     => 'nullable|numeric|min:0',
            'kondisi_kamar'      => 'nullable|string|max:50',
            'is_late_checkout'   => 'nullable|boolean',
            'denda_late_checkout'=> 'nullable|numeric|min:0',
        ]);

        try {
            DB::transaction(function () use ($id, $validated) {

                $checkin = CheckinCheckout::with('reservasi.kamar')
                    ->findOrFail($id);

                if ($checkin->waktu_checkout_aktual) {
                    throw new \Exception('Tamu sudah check-out sebelumnya.');
                }

                $isLate = $validated['is_late_checkout'] ?? false;
                $denda  = $validated['denda_late_checkout'] ?? 0;

                $checkin->update([
                    'waktu_checkout'        => now(),
                    'waktu_checkout_aktual' => now(),
                    'status'                => $isLate ? 'late_checkout' : 'checked_out',
                    'is_late_checkout'      => $isLate,
                    'denda_late_checkout'   => $denda,
                    'biaya_tambahan'        => $validated['biaya_tambahan'] ?? 0,
                    'kondisi_kamar'         => $validated['kondisi_kamar'],
                    'catatan_checkout'      => $validated['catatan_checkout'],
                    'checked_out_by'        => auth()->id(),
                    'total_bayar'           => $checkin->deposit + ($validated['biaya_tambahan'] ?? 0) + $denda,
                ]);

                // Update Reservasi & Kamar
                if ($checkin->reservasi) {
                    $checkin->reservasi->update(['status_reservasi' => 'checkout']);

                    if ($checkin->reservasi->kamar) {
                        $checkin->reservasi->kamar->update(['status_kamar' => 'tersedia']);
                    }
                }
            });

            return redirect()
                ->route('checkin-checkout.index')
                ->with('success', 'Check-Out berhasil dilakukan.');

        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            DB::transaction(function () use ($id) {

                $checkin = CheckinCheckout::with('reservasi.kamar')->findOrFail($id);

                if ($checkin->reservasi) {
                    $checkin->reservasi->update(['status_reservasi' => 'confirmed']);

                    if ($checkin->reservasi->kamar) {
                        $checkin->reservasi->kamar->update(['status_kamar' => 'tersedia']);
                    }
                }

                $checkin->delete(); // Soft delete
            });

            return back()->with('success', 'Data Check-In berhasil dihapus.');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}