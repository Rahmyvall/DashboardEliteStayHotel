<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use Illuminate\Http\Request;

class ResepsionisKamarController extends Controller
{
    /**
     * =========================
     * LIST KAMAR
     * =========================
     */
    public function index(Request $request)
    {
        $search = $request->search;

        $kamar = Kamar::with('tipeKamar')
            ->when($search, function ($q) use ($search) {
                $q->where('nomor_kamar', 'like', "%{$search}%")
                  ->orWhere('status_kamar', 'like', "%{$search}%")
                  ->orWhere('lantai', 'like', "%{$search}%");
            })
            ->orderBy('lantai')
            ->orderBy('nomor_kamar')
            ->get();

        return view('pages.resepsionis.kamar.index', compact('kamar', 'search'));
    }

    /**
     * =========================
     * CREATE VIEW (KAMAR KOSONG)
     * =========================
     */
    public function create()
{
    $kamarKosong = Kamar::with('tipeKamar')
        ->where('status_kamar', 'tersedia')
        ->get();

    return view('pages.resepsionis.kamar.create', compact('kamarKosong'));
}

public function info($id)
{
    $kamar = Kamar::with('tipeKamar')->findOrFail($id);

    return view('pages.resepsionis.kamar.info', compact('kamar'));
}
public function store(Request $request)
{
    $request->validate([
        'nomor_kamar' => 'required',
        'lantai' => 'required',
        'status_kamar' => 'required',
        'tipe_kamar_id' => 'required',
    ]);

    Kamar::create([
        'nomor_kamar' => $request->nomor_kamar,
        'lantai' => $request->lantai,
        'status_kamar' => $request->status_kamar,
        'tipe_kamar_id' => $request->tipe_kamar_id,
    ]);

    return redirect()->route('resepsionis.kamar.index')
        ->with('success', 'Kamar berhasil ditambahkan');
}

    /**
     * =========================
     * PICK / PILIH KAMAR
     * =========================
     */
   public function pick(Request $request, $id)
{
    if (!$request->isMethod('post')) {
        abort(405);
    }

    $kamar = Kamar::findOrFail($id);

    if ($kamar->status_kamar !== 'tersedia') {
        return back()->with('error', 'Kamar sudah tidak tersedia');
    }

    $kamar->update(['status_kamar' => 'terisi']);

    return redirect()->route('resepsionis.kamar.index')
        ->with('success', 'Kamar berhasil dipilih');
}

    /**
     * =========================
     * DETAIL KAMAR
     * =========================
     */
    public function show($id)
    {
        $kamar = Kamar::with('tipeKamar')->findOrFail($id);

        return view('pages.resepsionis.kamar.show', compact('kamar'));
    }
}
