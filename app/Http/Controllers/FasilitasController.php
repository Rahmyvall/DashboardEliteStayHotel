<?php

namespace App\Http\Controllers;

use App\Models\Fasilitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FasilitasController extends Controller
{
    /**
     * INDEX - Daftar Fasilitas
     */
    public function index(Request $request)
    {
        $query = Fasilitas::query();

        // Search fasilitas
        if ($request->filled('search')) {

            $search = $request->search;

            $query->where(function ($q) use ($search) {

                $q->where('nama_fasilitas', 'like', "%{$search}%")
                  ->orWhere('deskripsi', 'like', "%{$search}%");

            });
        }

        // Ambil data fasilitas
        $fasilitas = $query->latest()
            ->paginate(10)
            ->appends($request->query());

        // Statistik
        $stats = [
            'total' => Fasilitas::count(),
        ];

        return view('pages.fasilitas.index', compact('fasilitas', 'stats'));
    }

    /**
     * EDIT - Form Edit Fasilitas
     */
    public function edit($id)
    {
        $fasilitas = Fasilitas::findOrFail($id);

        return view('pages.fasilitas.edit', compact('fasilitas'));
    }

    /**
     * UPDATE - Update Data Fasilitas
     */
    public function update(Request $request, $id)
    {
        $fasilitas = Fasilitas::findOrFail($id);

        // Validasi
        $request->validate([
            'nama_fasilitas' => 'required|string|max:255',
            'icon'           => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'deskripsi'      => 'nullable|string',
        ], [
            'nama_fasilitas.required' => 'Nama fasilitas wajib diisi.',
            'icon.image'              => 'File harus berupa gambar.',
        ]);

        // Upload gambar baru
        if ($request->hasFile('icon')) {

            // Hapus gambar lama
            if ($fasilitas->icon && Storage::disk('public')->exists($fasilitas->icon)) {

                Storage::disk('public')->delete($fasilitas->icon);

            }

            // Simpan gambar baru
            $iconPath = $request->file('icon')
                ->store('fasilitas', 'public');

        } else {

            $iconPath = $fasilitas->icon;

        }

        // Update data
        $fasilitas->update([
            'nama_fasilitas' => $request->nama_fasilitas,
            'icon'           => $iconPath,
            'deskripsi'      => $request->deskripsi,
        ]);

        return redirect()
            ->route('fasilitas.index')
            ->with('success', 'Data fasilitas berhasil diperbarui.');
    }

    /**
     * DELETE - Hapus Fasilitas
     */
    public function destroy($id)
    {
        $fasilitas = Fasilitas::findOrFail($id);

        $nama = $fasilitas->nama_fasilitas;

        // Hapus gambar
        if ($fasilitas->icon && Storage::disk('public')->exists($fasilitas->icon)) {

            Storage::disk('public')->delete($fasilitas->icon);

        }

        $fasilitas->delete();

        return redirect()
            ->route('fasilitas.index')
            ->with('success', "Fasilitas {$nama} berhasil dihapus.");
    }
}
