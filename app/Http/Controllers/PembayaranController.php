<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Reservasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class PembayaranController extends Controller
{
    /**
     * Daftar pembayaran
     */
    public function index()
{
    $pembayaran = Pembayaran::with('reservasi')->paginate(10);

    $totalPembayaran = Pembayaran::count();

    $paid = Pembayaran::where('status_pembayaran', 'paid')->count();
    $pending = Pembayaran::where('status_pembayaran', 'pending')->count();
    $failed = Pembayaran::where('status_pembayaran', 'failed')->count();

    $totalPendapatan = Pembayaran::where('status_pembayaran', 'paid')
        ->sum('jumlah_bayar');

    // 📊 DATA GRAFIK BULANAN
    $monthlyData = Pembayaran::selectRaw('
            MONTH(tanggal_bayar) as bulan,
            SUM(jumlah_bayar) as total
        ')
        ->where('status_pembayaran', 'paid')
        ->whereNotNull('tanggal_bayar')
        ->groupByRaw('MONTH(tanggal_bayar)')
        ->orderByRaw('MONTH(tanggal_bayar)')
        ->get();

    $bulanNama = [
        1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr',
        5 => 'Mei', 6 => 'Jun', 7 => 'Jul', 8 => 'Agu',
        9 => 'Sep', 10 => 'Okt', 11 => 'Nov', 12 => 'Des'
    ];

    $monthlyLabels = [];
    $monthlyRevenue = [];

    foreach ($monthlyData as $data) {
        $monthlyLabels[] = $bulanNama[$data->bulan];
        $monthlyRevenue[] = (int) $data->total;
    }

    return view('pages.pembayaran.index', compact(
        'pembayaran',
        'totalPembayaran',
        'paid',
        'pending',
        'failed',
        'totalPendapatan',
        'monthlyLabels',
        'monthlyRevenue'
    ));
}

    /**
     * Form tambah pembayaran
     */
   public function create()
{
    $reservasi = Reservasi::with(['pelanggan', 'kamar'])
        ->whereDoesntHave('pembayaran', function ($q) {
            $q->where('status_pembayaran', Pembayaran::STATUS_PAID);
        })
        ->latest()
        ->get();

    return view('pages.pembayaran.create', compact('reservasi'));
}

    /**
     * Simpan pembayaran
     */
    public function store(Request $request)
{
    $validated = $request->validate([
        'id_reservasi' => 'required|exists:reservasi,id_reservasi',
        'tanggal_bayar' => 'nullable|date',
        'metode_pembayaran' => 'required|in:cash,transfer,credit_card,e-wallet',
        'jumlah_bayar' => 'required|numeric|min:0',
        'status_pembayaran' => 'required|in:pending,paid,refund', // ❗ FIX: HAPUS failed
        'bukti_pembayaran' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    DB::transaction(function () use ($request, $validated) {

        // auto tanggal bayar
        if (
            $validated['status_pembayaran'] === Pembayaran::STATUS_PAID &&
            empty($validated['tanggal_bayar'])
        ) {
            $validated['tanggal_bayar'] = now();
        }

        // upload file
        if ($request->hasFile('bukti_pembayaran')) {
            $validated['bukti_pembayaran'] = $request
                ->file('bukti_pembayaran')
                ->store('bukti_pembayaran', 'public');
        }

        // create pembayaran
        $pembayaran = Pembayaran::create($validated);

        // sync reservasi (AMAN)
        $reservasi = Reservasi::findOrFail($validated['id_reservasi']);

        $reservasi->update([
            'status_pembayaran' => $validated['status_pembayaran'],
        ]);

        if ($validated['status_pembayaran'] === Pembayaran::STATUS_PAID) {
            $reservasi->update([
                'status_reservasi' => 'confirmed',
            ]);
        }
    });

    return redirect()
        ->route('pembayaran.index')
        ->with('success', 'Data pembayaran berhasil ditambahkan.');
}

    /**
     * Detail pembayaran
     */
    public function show($id)
    {
        $pembayaran = Pembayaran::with([
                'reservasi',
                'reservasi.pelanggan',
                'reservasi.kamar'
            ])
            ->findOrFail($id);

        return view(
            'pages.pembayaran.show',
            compact('pembayaran')
        );
    }

    /**
     * Form edit pembayaran
     */
    public function edit($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);

        $reservasi = Reservasi::with('pelanggan')
            ->get();

        return view(
            'pages.pembayaran.edit',
            compact(
                'pembayaran',
                'reservasi'
            )
        );
    }

    /**
     * Update pembayaran
     */
   public function update(Request $request, $id)
{
    $pembayaran = Pembayaran::findOrFail($id);

    $validated = $request->validate([
        'id_reservasi'        => 'required|exists:reservasi,id_reservasi',
        'tanggal_bayar'       => 'nullable|date',
        'metode_pembayaran'   => 'required|in:cash,transfer,credit_card,e-wallet',
        'jumlah_bayar'        => 'required|numeric|min:0',
        'status_pembayaran'   => 'required|in:pending,paid,refund',
        'bukti_pembayaran'    => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    DB::transaction(function () use (
        $request,
        $validated,
        $pembayaran
    ) {

        $oldReservasiId = $pembayaran->id_reservasi;

        // otomatis isi tanggal bayar saat PAID
        if (
            $validated['status_pembayaran'] === Pembayaran::STATUS_PAID &&
            empty($validated['tanggal_bayar'])
        ) {
            $validated['tanggal_bayar'] = now();
        }

        // upload bukti baru
        if ($request->hasFile('bukti_pembayaran')) {

            if (
                $pembayaran->bukti_pembayaran &&
                Storage::disk('public')->exists($pembayaran->bukti_pembayaran)
            ) {
                Storage::disk('public')->delete(
                    $pembayaran->bukti_pembayaran
                );
            }

            $validated['bukti_pembayaran'] = $request
                ->file('bukti_pembayaran')
                ->store('bukti_pembayaran', 'public');
        }

        $pembayaran->update($validated);

        // reset reservasi lama jika pindah reservasi
        if ($oldReservasiId != $validated['id_reservasi']) {

            Reservasi::where(
                'id_reservasi',
                $oldReservasiId
            )->update([
                'status_pembayaran' => 'pending'
            ]);
        }

        $reservasi = Reservasi::findOrFail(
            $validated['id_reservasi']
        );

        $reservasi->update([
            'status_pembayaran' => $validated['status_pembayaran']
        ]);

        // sinkron status reservasi
        if ($validated['status_pembayaran'] === Pembayaran::STATUS_PAID) {

            $reservasi->update([
                'status_reservasi' => 'confirmed'
            ]);

        } elseif (
            in_array(
                $validated['status_pembayaran'],
                [
                    Pembayaran::STATUS_PENDING,
                    Pembayaran::STATUS_REFUND
                ]
            )
        ) {

            if ($reservasi->status_reservasi === 'confirmed') {

                $reservasi->update([
                    'status_reservasi' => 'pending'
                ]);
            }
        }
    });

    return redirect()
        ->route('pembayaran.index')
        ->with(
            'success',
            'Data pembayaran berhasil diperbarui.'
        );
}
    /**
     * Hapus pembayaran
     */
   public function destroy($id)
{
    $pembayaran = Pembayaran::findOrFail($id);

    DB::transaction(function () use ($pembayaran) {

        Reservasi::where(
            'id_reservasi',
            $pembayaran->id_reservasi
        )->update([
            'status_pembayaran' => 'pending'
        ]);

        if (
            $pembayaran->bukti_pembayaran &&
            Storage::disk('public')->exists(
                $pembayaran->bukti_pembayaran
            )
        ) {
            Storage::disk('public')->delete(
                $pembayaran->bukti_pembayaran
            );
        }

        $pembayaran->delete();
    });

    return redirect()
        ->route('pembayaran.index')
        ->with(
            'success',
            'Data pembayaran berhasil dihapus.'
        );

}

}
