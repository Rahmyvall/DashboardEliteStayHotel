<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TipeKamar;
use App\Models\Fasilitas;
use App\Models\TipeKamarFasilitas;

class TipeKamarFasilitasController extends Controller
{
    /**
     * INDEX
     * Menampilkan semua relasi tipe kamar & fasilitas
     */
    public function index(Request $request)
    {
        $query = TipeKamarFasilitas::with([
            'tipeKamar',
            'fasilitas'
        ]);

        // SEARCH
        if ($request->filled('search')) {

            $search = $request->search;

            $query->where(function ($q) use ($search) {

                $q->whereHas('tipeKamar', function ($qt) use ($search) {
                    $qt->where(
                        'nama_tipe',
                        'like',
                        "%{$search}%"
                    );
                })

                ->orWhereHas('fasilitas', function ($qf) use ($search) {
                    $qf->where(
                        'nama_fasilitas',
                        'like',
                        "%{$search}%"
                    );
                });
            });
        }

        $tipeKamarFasilitas = $query
            ->latest()
            ->paginate(10)
            ->appends($request->query());

        return view(
            'pages.tipe_kamar_fasilitas.index',
            compact('tipeKamarFasilitas')
        );
    }

    /**
     * CREATE
     */
    public function create()
    {
        return view(
            'pages.tipe_kamar_fasilitas.create',
            [
                'tipeKamar' => TipeKamar::orderBy(
                    'nama_tipe'
                )->get(),

                'fasilitas' => Fasilitas::orderBy(
                    'nama_fasilitas'
                )->get(),
            ]
        );
    }

    /**
     * STORE
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_tipe' => 'required|exists:tipe_kamar,id_tipe',

            'id_fasilitas' => 'required|exists:fasilitas,id_fasilitas',
        ]);

        // CEK DUPLIKAT
        $exists = TipeKamarFasilitas::where(
            'id_tipe',
            $request->id_tipe
        )
        ->where(
            'id_fasilitas',
            $request->id_fasilitas
        )
        ->exists();

        if ($exists) {
            return back()->with(
                'error',
                'Fasilitas sudah ada pada tipe kamar ini.'
            );
        }

        TipeKamarFasilitas::create([
            'id_tipe' => $request->id_tipe,

            'id_fasilitas' => $request->id_fasilitas,
        ]);

        return redirect()
            ->route('tipe-kamar-fasilitas.index')
            ->with(
                'success',
                'Fasilitas berhasil ditambahkan ke tipe kamar.'
            );
    }

    /**
     * SHOW
     */
    public function show($id)
    {
        $tipeKamarFasilitas = TipeKamarFasilitas::with([
            'tipeKamar',
            'fasilitas'
        ])->findOrFail($id);

        return view(
            'pages.tipe_kamar_fasilitas.show',
            compact('tipeKamarFasilitas')
        );
    }

    /**
     * EDIT
     */
    public function edit($id)
    {
        $tipeKamarFasilitas = TipeKamarFasilitas::findOrFail($id);

        return view(
            'pages.tipe_kamar_fasilitas.edit',
            [
                'tipeKamarFasilitas' => $tipeKamarFasilitas,

                'tipeKamar' => TipeKamar::orderBy(
                    'nama_tipe'
                )->get(),

                'fasilitas' => Fasilitas::orderBy(
                    'nama_fasilitas'
                )->get(),
            ]
        );
    }

    /**
     * UPDATE
     */
    public function update(Request $request, $id)
    {
        $tipeKamarFasilitas = TipeKamarFasilitas::findOrFail($id);

        $request->validate([
            'id_tipe' => 'required|exists:tipe_kamar,id_tipe',

            'id_fasilitas' => 'required|exists:fasilitas,id_fasilitas',
        ]);

        // VALIDASI DUPLIKAT
        $exists = TipeKamarFasilitas::where(
            'id_tipe',
            $request->id_tipe
        )
        ->where(
            'id_fasilitas',
            $request->id_fasilitas
        )
        ->where(
            'id',
            '!=',
            $id
        )
        ->exists();

        if ($exists) {
            return back()->with(
                'error',
                'Relasi fasilitas sudah tersedia.'
            );
        }

        $tipeKamarFasilitas->update([
            'id_tipe' => $request->id_tipe,

            'id_fasilitas' => $request->id_fasilitas,
        ]);

        return redirect()
            ->route('tipe-kamar-fasilitas.index')
            ->with(
                'success',
                'Data berhasil diperbarui.'
            );
    }

    /**
     * DELETE
     */
    public function destroy($id)
    {
        $tipeKamarFasilitas = TipeKamarFasilitasController::findOrFail($id);

        $tipeKamarFasilitas->delete();

        return redirect()
            ->route('tipe-kamar-fasilitas.index')
            ->with(
                'success',
                'Relasi fasilitas berhasil dihapus.'
            );
    }
}
