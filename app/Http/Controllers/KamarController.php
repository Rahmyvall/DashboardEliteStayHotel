<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use App\Models\TipeKamar;
use Illuminate\Http\Request;

class KamarController extends Controller
{
    /**
     * AUTO GENERATE NOMOR KAMAR (contoh: 101, 102, 201, dst)
     */
    private function generateNomorKamar($lantai)
    {
        $existing = Kamar::where('lantai', $lantai)
            ->pluck('nomor_kamar')
            ->map(fn($item) => (int) substr($item, -2))
            ->toArray();

        for ($i = 1; $i <= 99; $i++) {
            if (!in_array($i, $existing)) {
                return $lantai . str_pad($i, 2, '0', STR_PAD_LEFT);
            }
        }

        return null; // Lantai sudah penuh
    }

    /**
     * INDEX - Daftar Kamar
     */
    public function index(Request $request)
{
    $query = Kamar::with('tipeKamar');

    // Filter Search
    if ($request->filled('search')) {
        $search = $request->search;
        $query->where(function($q) use ($search) {
            $q->where('nomor_kamar', 'like', "%{$search}%")
              ->orWhere('lantai', 'like', "%{$search}%")
              ->orWhereHas('tipeKamar', function($qt) use ($search) {
                  $qt->where('nama_tipe', 'like', "%{$search}%");
              });
        });
    }

    // Filter Status
    if ($request->filled('status')) {
        $query->where('status_kamar', $request->status);
    }

    $kamar = $query->paginate(15)->appends($request->query());

    // Hitung Statistik (Global)
    $stats = [
        'total'     => Kamar::count(),
        'tersedia'  => Kamar::where('status_kamar', 'tersedia')->count(),
        'terisi'    => Kamar::where('status_kamar', 'terisi')->count(),
        'dipesan'   => Kamar::where('status_kamar', 'dipesan')->count(),
    ];

    return view('pages.kamar.index', compact('kamar', 'stats'));
}

    /**
     * CREATE
     */
    public function create()
    {
        return view('pages.kamar.create', [
            'tipeKamar' => TipeKamar::orderBy('nama_tipe')->get()
        ]);
    }

    /**
     * STORE - Simpan Kamar Baru dengan Auto Nomor
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_tipe'       => 'required|exists:tipe_kamar,id_tipe',
            'lantai'        => 'required|integer|min:1|max:45',
            'status_kamar'  => 'required|in:tersedia,dipesan,terisi,maintenance',
        ]);

        $nomor = $this->generateNomorKamar($request->lantai);

        if (!$nomor) {
            return back()
                ->with('error', 'Lantai ini sudah penuh. Tidak dapat menambahkan kamar baru.');
        }

        Kamar::create([
            'nomor_kamar'   => $nomor,
            'id_tipe'       => $request->id_tipe,
            'lantai'        => $request->lantai,
            'status_kamar'  => $request->status_kamar,
        ]);

        return redirect()
            ->route('kamar.index')
            ->with('success', "Kamar $nomor berhasil ditambahkan.");
    }

    /**
     * KONFIRMASI CHECK-IN (dari status Dipesan → Terisi)
     */
    public function konfirmasi(Kamar $kamar)
    {
        $kamar->update([
            'status_kamar' => 'terisi'
        ]);

        return redirect()
            ->route('kamar.index')
            ->with('success', 'Check-in berhasil. Status kamar diubah menjadi Terisi.');
    }

    /**
     * SHOW - Detail Kamar
     */
    public function show($id)
    {
        $kamar = Kamar::with('tipeKamar')->findOrFail($id);

        return view('pages.kamar.show', compact('kamar'));
    }

    /**
     * EDIT
     */
    public function edit($id)
    {
        $kamar = Kamar::with('tipeKamar')->findOrFail($id);

        return view('pages.kamar.edit', [
            'kamar'     => $kamar,
            'tipeKamar' => TipeKamar::orderBy('nama_tipe')->get()
        ]);
    }

    /**
     * UPDATE
     */
    public function update(Request $request, $id)
    {
        $kamar = Kamar::findOrFail($id);

        $request->validate([
            'id_tipe'       => 'required|exists:tipe_kamar,id_tipe',
            'lantai'        => 'required|integer|min:1|max:45',
            'status_kamar'  => 'required|in:tersedia,dipesan,terisi,maintenance',
        ]);

        $kamar->update([
            'id_tipe'       => $request->id_tipe,
            'lantai'        => $request->lantai,
            'status_kamar'  => $request->status_kamar,
        ]);

        return redirect()
            ->route('kamar.index')
            ->with('success', 'Data kamar berhasil diperbarui.');
    }

    /**
     * DELETE
     */
    public function destroy($id)
    {
        $kamar = Kamar::findOrFail($id);
        $nomor = $kamar->nomor_kamar;

        $kamar->delete();

        return redirect()
            ->route('kamar.index')
            ->with('success', "Kamar $nomor berhasil dihapus.");
    }
}
