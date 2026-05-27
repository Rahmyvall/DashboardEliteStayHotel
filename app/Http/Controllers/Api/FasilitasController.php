<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Fasilitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FasilitasController extends Controller
{
    /**
     * GET ALL
     */
    public function index()
    {
        $data = Fasilitas::latest()->get();

        return response()->json([
            'success' => true,
            'message' => 'List data fasilitas',
            'data' => $data
        ], 200);
    }

    /**
     * STORE
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_fasilitas' => 'required|string|max:255',
            'icon'           => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'deskripsi'      => 'nullable|string',
        ]);

        $iconPath = null;

        if ($request->hasFile('icon')) {

            $iconPath = $request->file('icon')
                ->store('fasilitas', 'public');
        }

        $data = Fasilitas::create([
            'nama_fasilitas' => $request->nama_fasilitas,
            'icon'           => $iconPath,
            'deskripsi'      => $request->deskripsi,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil ditambahkan',
            'data' => $data
        ], 201);
    }

    /**
     * SHOW
     */
    public function show($id)
    {
        $data = Fasilitas::find($id);

        if (!$data) {

            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Detail data fasilitas',
            'data' => $data
        ], 200);
    }

    /**
     * UPDATE
     */
    public function update(Request $request, $id)
    {
        $data = Fasilitas::find($id);

        if (!$data) {

            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        $request->validate([
            'nama_fasilitas' => 'required|string|max:255',
            'icon'           => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'deskripsi'      => 'nullable|string',
        ]);

        $iconPath = $data->icon;

        if ($request->hasFile('icon')) {

            if ($data->icon && Storage::disk('public')->exists($data->icon)) {

                Storage::disk('public')->delete($data->icon);
            }

            $iconPath = $request->file('icon')
                ->store('fasilitas', 'public');
        }

        $data->update([
            'nama_fasilitas' => $request->nama_fasilitas,
            'icon'           => $iconPath,
            'deskripsi'      => $request->deskripsi,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil diupdate',
            'data' => $data
        ], 200);
    }

    /**
     * DELETE
     */
    public function destroy($id)
    {
        $data = Fasilitas::find($id);

        if (!$data) {

            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        if ($data->icon && Storage::disk('public')->exists($data->icon)) {

            Storage::disk('public')->delete($data->icon);
        }

        $data->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil dihapus'
        ], 200);
    }
}
