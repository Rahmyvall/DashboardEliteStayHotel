<?php

namespace App\Http\Controllers;

use App\Models\TipeKamar;
use Illuminate\Http\Request;

class TipeKamarController extends Controller
{
    /**
     * LIST TIPE KAMAR
     */
    public function index(Request $request)
    {
        $search = $request->search;

        $tipeKamar = TipeKamar::query()
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('nama_tipe', 'LIKE', "%{$search}%")
                        ->orWhere('deskripsi', 'LIKE', "%{$search}%")
                        ->orWhere('harga_per_malam', 'LIKE', "%{$search}%")
                        ->orWhere('kapasitas', 'LIKE', "%{$search}%")
                        ->orWhere('ukuran_kamar', 'LIKE', "%{$search}%");
                });
            })
            ->latest('id_tipe')
            ->paginate(10)
            ->withQueryString();

        return view('pages.tipe_kamar.index', compact('tipeKamar', 'search'));
    }

    /**
     * FORM CREATE
     */
    public function create()
    {
        return view('pages.tipe_kamar.create');
    }

    /**
     * STORE TIPE KAMAR
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_tipe'       => 'required|string|max:100',
            'deskripsi'       => 'nullable|string',
            'harga_per_malam' => 'required|numeric|min:0',
            'kapasitas'       => 'required|integer|min:1',
            'ukuran_kamar'    => 'nullable|string|max:50',
        ]);

        TipeKamar::create([
            'nama_tipe'       => $request->nama_tipe,
            'deskripsi'       => $request->deskripsi,
            'harga_per_malam' => $request->harga_per_malam,
            'kapasitas'       => $request->kapasitas,
            'ukuran_kamar'    => $request->ukuran_kamar,
        ]);

        return redirect()
            ->route('pages.tipe-kamar.index')
            ->with('success', 'Tipe kamar berhasil ditambahkan');
    }

    /**
     * SHOW DETAIL
     */
    public function show($id)
    {
        $tipeKamar = TipeKamar::findOrFail($id);

        return view('pages.tipe_kamar.show', compact('tipeKamar'));
    }

    /**
     * FORM EDIT
     */
    public function edit($id)
    {
        $tipeKamar = TipeKamar::findOrFail($id);

        return view('pages.tipe_kamar.edit', compact('tipeKamar'));
    }

    /**
     * UPDATE TIPE KAMAR
     */
    public function update(Request $request, $id)
    {
        $tipeKamar = TipeKamar::findOrFail($id);

        $request->validate([
            'nama_tipe'       => 'required|string|max:100',
            'deskripsi'       => 'nullable|string',
            'harga_per_malam' => 'required|numeric|min:0',
            'kapasitas'       => 'required|integer|min:1',
            'ukuran_kamar'    => 'nullable|string|max:50',
        ]);

        $tipeKamar->update([
            'nama_tipe'       => $request->nama_tipe,
            'deskripsi'       => $request->deskripsi,
            'harga_per_malam' => $request->harga_per_malam,
            'kapasitas'       => $request->kapasitas,
            'ukuran_kamar'    => $request->ukuran_kamar,
        ]);

        return redirect()
            ->route('pages.tipe-kamar.index')
            ->with('success', 'Tipe kamar berhasil diupdate');
    }

    /**
     * DELETE TIPE KAMAR
     */
    public function destroy($id)
    {
        $tipeKamar = TipeKamar::findOrFail($id);

        $tipeKamar->delete();

        return redirect()
            ->route('pages.tipe-kamar.index')
            ->with('success', 'Tipe kamar berhasil dihapus');
    }
}