<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Pelanggan;
use App\Models\TipeKamar;
use App\Models\Kamar;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if (!$user) {
            abort(403, 'Akses ditolak');
        }

        // ================= ADMIN =================
        if ($user->role === 'admin') {

            $totalUser = User::count();
            $totalKamar = Kamar::count();

            return view('pages.dashboard', [
                'title' => 'Dashboard Admin',
                'user'  => $user,

                // === DATA UNTUK CARDS ===
                // Users
                'totalUsers'      => $totalUser,
                'adminCount'      => User::where('role', 'admin')->count(),
                'resepsionisCount'=> User::where('role', 'resepsionis')->count(),
                'pelangganUser'   => User::where('role', 'pelanggan')->count(),
                'userAktif'       => User::where('status', 'aktif')->count(),

                // Tipe Kamar
                'tipeKamarCount'  => TipeKamar::count(),

                // Kamar
                'totalKamar'      => $totalKamar,
                'kamarTersedia'   => Kamar::where('status_kamar', 'tersedia')->count(),
                'kamarTerisi'     => Kamar::where('status_kamar', 'terisi')->count(),
                'kamarDipesan'    => Kamar::where('status_kamar', 'dipesan')->count(),

                // === DATA TAMBAHAN UNTUK TABEL ===
                'userBaruHariIni' => User::whereDate('created_at', today())->count(),
                'userBulanIni'    => User::whereMonth('created_at', now()->month)->count(),

                // Pelanggan
                'totalPelanggan'     => Pelanggan::count(),
                'pelangganLaki'      => Pelanggan::where('jenis_kelamin', 'L')->count(),
                'pelangganPerempuan' => Pelanggan::where('jenis_kelamin', 'P')->count(),

                // Persentase (optional, bisa dihitung di blade juga)
                'persentaseAdmin'      => $totalUser ? round(User::where('role', 'admin')->count() / $totalUser * 100, 1) : 0,
                'persentaseResepsionis'=> $totalUser ? round(User::where('role', 'resepsionis')->count() / $totalUser * 100, 1) : 0,
                'persentasePelanggan'  => $totalUser ? round(User::where('role', 'pelanggan')->count() / $totalUser * 100, 1) : 0,
                'persentaseKamarTersedia' => $totalKamar ? round(Kamar::where('status_kamar', 'tersedia')->count() / $totalKamar * 100, 1) : 0,
            ]);
        }

        // ================= PELANGGAN =================
        if ($user->role === 'pelanggan') {
            return view('pages.pelanggan.dashboard', [
                'title' => 'Dashboard Pelanggan',
                'user'  => $user,
            ]);
        }

        abort(403, 'Role tidak valid');
    }

    // ================= CHART API =================
    public function pelangganChart()
    {
        $user = Auth::user();

        if (!$user || !in_array($user->role, ['admin'])) {
            abort(403, 'Akses ditolak');
        }

        $laki = Pelanggan::where('jenis_kelamin', 'L')->count();
        $perempuan = Pelanggan::where('jenis_kelamin', 'P')->count();

        return response()->json([
            'total' => $laki + $perempuan,
            'laki_laki' => $laki,
            'perempuan' => $perempuan,
        ]);
    }
}
