<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Models\User;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    /**
     * LIST PELANGGAN
     */
    public function index(Request $request)
    {
        $search = $request->search;

        $pelanggan = Pelanggan::with('user')
            ->when($search, function ($query) use ($search) {

                $query->where(function ($q) use ($search) {

                    $q->where('nik', 'LIKE', "%{$search}%")
                        ->orWhere('jenis_kelamin', 'LIKE', "%{$search}%")
                        ->orWhere('alamat', 'LIKE', "%{$search}%")
                        ->orWhere('kota', 'LIKE', "%{$search}%")
                        ->orWhere('negara', 'LIKE', "%{$search}%");

                });

            })
            ->latest('id_pelanggan')
            ->paginate(10)
            ->withQueryString();

        return view('pages.pelanggan1.index', compact('pelanggan', 'search'));
    }

    /**
     * FORM CREATE
     */
    public function create()
    {
        $users = User::where('role', 'pelanggan')->get();

        return view('pages.pelanggan1.create', compact('users'));
    }

    /**
     * STORE PELANGGAN
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_user'        => 'required|exists:users,id_user',
            'nik'            => 'nullable|string|max:20|unique:pelanggan,nik',
            'jenis_kelamin'  => 'required|in:L,P',
            'alamat'         => 'nullable|string',
            'kota'           => 'nullable|string|max:100',
            'negara'         => 'nullable|string|max:100',
            'tanggal_lahir'  => 'nullable|date',
        ]);

        /**
         * SIMPAN PELANGGAN
         */
        Pelanggan::create([
            'id_user'        => $request->id_user,
            'nik'            => $request->nik,
            'jenis_kelamin'  => $request->jenis_kelamin,
            'alamat'         => $request->alamat,
            'kota'           => $request->kota,
            'negara'         => $request->negara,
            'tanggal_lahir'  => $request->tanggal_lahir,
        ]);

        return redirect()
            ->route('pelanggan1.index')
            ->with('success', 'Pelanggan berhasil ditambahkan');
    }

    /**
     * SHOW PELANGGAN
     */
    public function show($id)
    {
        $pelanggan = Pelanggan::with('user')
            ->findOrFail($id);

        return view('pages.pelanggan1.show', compact('pelanggan'));
    }

    /**
     * FORM EDIT
     */
    public function edit($id)
    {
        $pelanggan = Pelanggan::findOrFail($id);

        $users = User::where('role', 'pelanggan')->get();

        return view('pages.pelanggan1.edit', compact('pelanggan', 'users'));
    }

    /**
     * UPDATE PELANGGAN
     */
    public function update(Request $request, $id)
    {
        $pelanggan = Pelanggan::findOrFail($id);

        $request->validate([
            'id_user'        => 'required|exists:users,id_user',
            'nik'            => 'nullable|string|max:20|unique:pelanggan,nik,' . $id . ',id_pelanggan',
            'jenis_kelamin'  => 'required|in:L,P',
            'alamat'         => 'nullable|string',
            'kota'           => 'nullable|string|max:100',
            'negara'         => 'nullable|string|max:100',
            'tanggal_lahir'  => 'nullable|date',
        ]);

        /**
         * UPDATE DATABASE
         */
        $pelanggan->update([
            'id_user'        => $request->id_user,
            'nik'            => $request->nik,
            'jenis_kelamin'  => $request->jenis_kelamin,
            'alamat'         => $request->alamat,
            'kota'           => $request->kota,
            'negara'         => $request->negara,
            'tanggal_lahir'  => $request->tanggal_lahir,
        ]);

        return redirect()
            ->route('pelanggan1.index')
            ->with('success', 'Pelanggan berhasil diupdate');
    }

    /**
     * DELETE PELANGGAN
     */
    public function destroy($id)
    {
        $pelanggan = Pelanggan::findOrFail($id);

        /**
         * HAPUS PELANGGAN
         */
        $pelanggan->delete();

        return redirect()
            ->route('pelanggan1.index')
            ->with('success', 'Pelanggan berhasil dihapus');
    }
}