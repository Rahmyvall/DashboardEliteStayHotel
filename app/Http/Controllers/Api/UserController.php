<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * LIST USER
     */
    public function index(Request $request)
    {
        $search = $request->query('search'); // lebih aman

        $users = User::when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('nama_lengkap', 'LIKE', "%{$search}%")
                        ->orWhere('email', 'LIKE', "%{$search}%")
                        ->orWhere('no_hp', 'LIKE', "%{$search}%")
                        ->orWhere('role', 'LIKE', "%{$search}%")
                        ->orWhere('status', 'LIKE', "%{$search}%");
                });
            })
            ->latest('id_user')
            ->paginate(10);

        return response()->json([
            'success' => true,
            'message' => 'Data user berhasil diambil',
            'data'    => $users
        ]);
    }

    /**
     * STORE USER
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:100',
            'email'        => 'required|email|unique:users,email',
            'password'     => 'required|min:6',
            'no_hp'        => 'required|string|max:20',
            'role'         => 'required|in:admin,resepsionis,pelanggan',
            'status'       => 'required|in:aktif,nonaktif',
            'foto_profile' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
        ]);

        $foto = null;
        if ($request->hasFile('foto_profile')) {
            $foto = $request->file('foto_profile')->store('users', 'public');
        }

        $user = User::create([
            'nama_lengkap' => $request->nama_lengkap,
            'email'        => $request->email,
            'password'     => Hash::make($request->password),
            'no_hp'        => $request->no_hp,
            'role'         => $request->role,
            'status'       => $request->status,
            'foto_profile' => $foto,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'User berhasil ditambahkan',
            'data'    => $user
        ], 201);
    }

    /**
     * DETAIL USER
     */
    public function show($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Detail user',
            'data'    => $user
        ]);
    }

    /**
     * UPDATE USER
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User tidak ditemukan'
            ], 404);
        }

        $request->validate([
            'nama_lengkap' => 'required|string|max:100',
            'email'        => 'required|email|unique:users,email,' . $id . ',id_user',
            'no_hp'        => 'required|string|max:20',
            'role'         => 'required|in:admin,resepsionis,pelanggan',
            'status'       => 'required|in:aktif,nonaktif',
            'password'     => 'nullable|min:6',
            'foto_profile' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
        ]);

        $data = [
            'nama_lengkap' => $request->nama_lengkap,
            'email'        => $request->email,
            'no_hp'        => $request->no_hp,
            'role'         => $request->role,
            'status'       => $request->status,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        if ($request->hasFile('foto_profile')) {
            // Hapus foto lama
            if ($user->foto_profile && Storage::disk('public')->exists($user->foto_profile)) {
                Storage::disk('public')->delete($user->foto_profile);
            }

            $data['foto_profile'] = $request->file('foto_profile')->store('users', 'public');
        }

        $user->update($data);

        return response()->json([
            'success' => true,
            'message' => 'User berhasil diupdate',
            'data'    => $user->fresh()   // ambil data terbaru
        ]);
    }

    /**
     * DELETE USER
     */
    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User tidak ditemukan'
            ], 404);
        }

        if ($user->foto_profile && Storage::disk('public')->exists($user->foto_profile)) {
            Storage::disk('public')->delete($user->foto_profile);
        }

        $user->delete();

        return response()->json([
            'success' => true,
            'message' => 'User berhasil dihapus'
        ]);
    }
}
