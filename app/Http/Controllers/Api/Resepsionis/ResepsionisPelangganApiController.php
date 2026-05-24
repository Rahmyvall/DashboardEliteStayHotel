<?php

namespace App\Http\Controllers\Api\Resepsionis;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ResepsionisPelangganApiController extends Controller
{
    /**
     * Display a listing of pelanggan
     */
    public function index()
    {
        $pelanggan = User::with('pelanggan')
            ->where('role', 'pelanggan')
            ->latest()
            ->paginate(10);

        return response()->json([
            'success' => true,
            'message' => 'Data pelanggan berhasil diambil',
            'data' => $pelanggan
        ]);
    }

    /**
     * Store a newly created pelanggan
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_lengkap'   => 'required|string|max:255',
            'email'          => 'required|email|unique:users,email',
            'password'       => ['required', 'confirmed', Password::defaults()],
            'no_hp'          => 'nullable|string|max:20',
            'foto_profile'   => 'nullable|image|mimes:jpg,jpeg,png|max:2048',

            'nik'            => 'nullable|string|max:20|unique:pelanggan,nik',
            'jenis_kelamin'  => 'required|in:L,P',
            'alamat'         => 'nullable|string',
            'kota'           => 'nullable|string|max:100',
            'negara'         => 'nullable|string|max:100',
            'tanggal_lahir'  => 'nullable|date',
        ]);

        DB::beginTransaction();

        try {

            $fotoPath = null;

            if ($request->hasFile('foto_profile')) {

                $fotoPath = $request->file('foto_profile')
                    ->store('profile', 'public');
            }

            // create user
            $user = User::create([
                'nama_lengkap' => $request->nama_lengkap,
                'email'        => $request->email,
                'password'     => Hash::make($request->password),
                'no_hp'        => $request->no_hp,
                'role'         => 'pelanggan',
                'foto_profile' => $fotoPath,
                'status'       => 'aktif',
            ]);

            // create pelanggan
            $pelanggan = Pelanggan::create([
                'id_user'       => $user->id_user,
                'nik'           => $request->nik,
                'jenis_kelamin' => $request->jenis_kelamin,
                'alamat'        => $request->alamat,
                'kota'          => $request->kota,
                'negara'        => $request->negara,
                'tanggal_lahir' => $request->tanggal_lahir,
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Pelanggan berhasil ditambahkan',
                'data' => [
                    'user' => $user,
                    'pelanggan' => $pelanggan
                ]
            ], 201);

        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Gagal menambahkan pelanggan',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display specified pelanggan
     */
    public function show($id)
    {
        $pelanggan = User::with('pelanggan')
            ->where('role', 'pelanggan')
            ->find($id);

        if (!$pelanggan) {

            return response()->json([
                'success' => false,
                'message' => 'Pelanggan tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $pelanggan
        ]);
    }

    /**
     * Update pelanggan
     */
    public function update(Request $request, $id)
    {
        $user = User::with('pelanggan')
            ->where('role', 'pelanggan')
            ->find($id);

        if (!$user) {

            return response()->json([
                'success' => false,
                'message' => 'Pelanggan tidak ditemukan'
            ], 404);
        }

        $request->validate([
            'nama_lengkap'   => 'required|string|max:255',
            'email'          => 'required|email|unique:users,email,' . $user->id_user . ',id_user',
            'no_hp'          => 'nullable|string|max:20',

            'nik'            => 'nullable|string|max:20|unique:pelanggan,nik,' . $user->pelanggan->id_pelanggan . ',id_pelanggan',
            'jenis_kelamin'  => 'required|in:L,P',
            'alamat'         => 'nullable|string',
            'kota'           => 'nullable|string|max:100',
            'negara'         => 'nullable|string|max:100',
            'tanggal_lahir'  => 'nullable|date',
        ]);

        DB::beginTransaction();

        try {

            if ($request->hasFile('foto_profile')) {

                $fotoPath = $request->file('foto_profile')
                    ->store('profile', 'public');

                $user->foto_profile = $fotoPath;
                $user->save();
            }

            // update users
            $user->update([
                'nama_lengkap' => $request->nama_lengkap,
                'email'        => $request->email,
                'no_hp'        => $request->no_hp,
            ]);

            // update pelanggan
            $user->pelanggan->update([
                'nik'           => $request->nik,
                'jenis_kelamin' => $request->jenis_kelamin,
                'alamat'        => $request->alamat,
                'kota'          => $request->kota,
                'negara'        => $request->negara,
                'tanggal_lahir' => $request->tanggal_lahir,
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Pelanggan berhasil diupdate',
                'data' => $user->load('pelanggan')
            ]);

        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Gagal update pelanggan',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove pelanggan
     */
    public function destroy($id)
    {
        $user = User::where('role', 'pelanggan')
            ->find($id);

        if (!$user) {

            return response()->json([
                'success' => false,
                'message' => 'Pelanggan tidak ditemukan'
            ], 404);
        }

        // delete photo
        if ($user->foto_profile) {

            $path = public_path('storage/' . $user->foto_profile);

            if (file_exists($path)) {
                unlink($path);
            }
        }

        $user->delete();

        return response()->json([
            'success' => true,
            'message' => 'Pelanggan berhasil dihapus'
        ]);
    }
}