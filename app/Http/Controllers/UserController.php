<?php

namespace App\Http\Controllers;

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
        $search = $request->search;

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
            ->paginate(10)
            ->withQueryString();

        return view('pages.user.index', compact('users', 'search'));
    }

    /**
     * FORM CREATE
     */
    public function create()
    {
        return view('pages.user.create');
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

            // VALIDASI FOTO
            'foto_profile' => 'nullable|image|mimetypes:image/jpeg,image/png|max:5120',
        ]);

        /**
         * UPLOAD FOTO
         */
        $foto = null;

        if ($request->hasFile('foto_profile')) {

            $foto = $request->file('foto_profile')
                ->store('users', 'public');
        }

        /**
         * SIMPAN USER
         */
        User::create([
            'nama_lengkap' => $request->nama_lengkap,
            'email'        => $request->email,
            'password'     => Hash::make($request->password),
            'no_hp'        => $request->no_hp,
            'role'         => $request->role,
            'status'       => $request->status,
            'foto_profile' => $foto,
        ]);

        return redirect()
            ->route('users.index')
            ->with('success', 'User berhasil ditambahkan');
    }

    /**
     * SHOW USER
     */
    public function show($id)
    {
        $user = User::findOrFail($id);

        return view('pages.user.show', compact('user'));
    }

    /**
     * FORM EDIT
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('pages.user.edit', compact('user'));
    }

    /**
     * UPDATE USER
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'nama_lengkap' => 'required|string|max:100',
            'email'        => 'required|email|unique:users,email,' . $id . ',id_user',
            'no_hp'        => 'required|string|max:20',
            'role'         => 'required|in:admin,resepsionis,pelanggan',
            'status'       => 'required|in:aktif,nonaktif',
            'password'     => 'nullable|min:6',

            // VALIDASI FOTO
            'foto_profile' => 'nullable|image|mimetypes:image/jpeg,image/png|max:5120',
        ]);

        /**
         * DATA UPDATE
         */
        $data = [
            'nama_lengkap' => $request->nama_lengkap,
            'email'        => $request->email,
            'no_hp'        => $request->no_hp,
            'role'         => $request->role,
            'status'       => $request->status,
        ];

        /**
         * UPDATE PASSWORD
         */
        if ($request->filled('password')) {

            $data['password'] = Hash::make($request->password);
        }

        /**
         * UPDATE FOTO
         */
        if ($request->hasFile('foto_profile')) {

            /**
             * HAPUS FOTO LAMA
             */
            if (
                $user->foto_profile &&
                Storage::disk('public')->exists($user->foto_profile)
            ) {

                Storage::disk('public')
                    ->delete($user->foto_profile);
            }

            /**
             * UPLOAD FOTO BARU
             */
            $data['foto_profile'] = $request->file('foto_profile')
                ->store('users', 'public');
        }

        /**
         * UPDATE DATABASE
         */
        $user->update($data);

        return redirect()
            ->route('users.index')
            ->with('success', 'User berhasil diupdate');
    }

    /**
     * DELETE USER
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        /**
         * HAPUS FOTO
         */
        if (
            $user->foto_profile &&
            Storage::disk('public')->exists($user->foto_profile)
        ) {

            Storage::disk('public')
                ->delete($user->foto_profile);
        }

        /**
         * HAPUS USER
         */
        $user->delete();

        return redirect()
            ->route('users.index')
            ->with('success', 'User berhasil dihapus');
    }
}
