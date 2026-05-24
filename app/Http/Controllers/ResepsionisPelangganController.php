<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ResepsionisPelangganController extends Controller
{
    /**
     * Menampilkan daftar pelanggan
     */
    public function index()
    {
        $pelanggan = User::with('pelanggan')
            ->where('role', 'pelanggan')
            ->orderBy('nama_lengkap')
            ->paginate(10);

        return view('pages.resepsionis.pelanggan.index', compact('pelanggan'));
    }

    /**
     * Form tambah pelanggan
     */
    public function create()
    {
        return view('pages.resepsionis.pelanggan.create');
    }

    /**
     * Simpan pelanggan baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_lengkap'   => 'required|string|max:255',
            'email'          => 'required|email|max:255|unique:users,email',
            'password'       => ['required', 'confirmed', Password::defaults()],
            'no_hp'          => 'nullable|string|max:20',
            'foto_profile'   => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:5048',

            // tabel pelanggan
            'nik'            => 'nullable|string|max:20|unique:pelanggan,nik',
            'jenis_kelamin'  => 'required|in:L,P',
            'alamat'         => 'nullable|string',
            'kota'           => 'nullable|string|max:100',
            'negara'         => 'nullable|string|max:100',
            'tanggal_lahir'  => 'nullable|date',
        ]);

        DB::beginTransaction();

        try {

            // Upload foto
            $fotoPath = null;

            if ($request->hasFile('foto_profile')) {
                $fotoPath = $request->file('foto_profile')
                    ->store('profile', 'public');
            }

            // Simpan user
            $user = User::create([
                'nama_lengkap' => $request->nama_lengkap,
                'email'        => $request->email,
                'password'     => Hash::make($request->password),
                'no_hp'        => $request->no_hp,
                'role'         => 'pelanggan',
                'foto_profile' => $fotoPath,
                'status'       => 'aktif',
            ]);

            // Simpan detail pelanggan
            Pelanggan::create([
                'id_user'        => $user->id_user,
                'nik'            => $request->nik,
                'jenis_kelamin'  => $request->jenis_kelamin,
                'alamat'         => $request->alamat,
                'kota'           => $request->kota,
                'negara'         => $request->negara,
                'tanggal_lahir'  => $request->tanggal_lahir,
            ]);

            DB::commit();

            return redirect()
                ->route('resepsionis.pelanggan.index')
                ->with('success', 'Pelanggan berhasil ditambahkan');

        } catch (\Exception $e) {

            DB::rollBack();

            return back()
                ->withInput()
                ->with('error', 'Gagal menambahkan pelanggan');
        }
    }

    /**
     * Hapus pelanggan
     */
    public function destroy(User $pelanggan)
    {
        // Hapus foto jika ada
        if ($pelanggan->foto_profile) {

            $path = public_path('storage/' . $pelanggan->foto_profile);

            if (file_exists($path)) {
                unlink($path);
            }
        }

        // otomatis hapus data pelanggan karena cascade
        $pelanggan->delete();

        return redirect()
            ->route('resepsionis.pelanggan.index')
            ->with('success', 'Pelanggan berhasil dihapus');
    }
}