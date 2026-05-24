<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Pelanggan;   // ← Ditambahkan

class DashboardController extends Controller
{
    /**
     * ADMIN DASHBOARD
     */
    public function index()
    {
        $this->authorizeRole('admin');

        // Statistik User
        $totalUsers      = User::count();
        $adminCount      = User::where('role', 'admin')->count();
        $resepsionis     = User::where('role', 'resepsionis')->count();
        $pelangganUser   = User::where('role', 'pelanggan')->count();

        // Statistik Pelanggan (dari tabel pelanggan)
        $totalPelanggan       = Pelanggan::count();
        $pelangganLaki        = Pelanggan::where('jenis_kelamin', 'L')->count();
        $pelangganPerempuan   = Pelanggan::where('jenis_kelamin', 'P')->count();
        $pelangganBaruHariIni = Pelanggan::whereDate('created_at', today())->count();
        $pelangganBulanIni    = Pelanggan::whereMonth('created_at', now()->month)->count();

        return view('pages.dashboard', [
            'title' => 'Dashboard Admin',
            'user'  => Auth::user(),

            // DATA USER
            'totalUsers'      => $totalUsers,
            'adminCount'      => $adminCount,
            'resepsionis'     => $resepsionis,
            'pelanggan'       => $pelangganUser,           // jumlah user dengan role pelanggan
            'userAktif'       => User::where('status', 'aktif')->count(),
            'userBaruHariIni' => User::whereDate('created_at', today())->count(),
            'userBulanIni'    => User::whereMonth('created_at', now()->month)->count(),

            // DATA PELANGGAN (baru ditambahkan)
            'totalPelanggan'          => $totalPelanggan,
            'pelangganLaki'           => $pelangganLaki,
            'pelangganPerempuan'      => $pelangganPerempuan,
            'pelangganBaruHariIni'    => $pelangganBaruHariIni,
            'pelangganBulanIni'       => $pelangganBulanIni,
            'persentaseLaki'          => $totalPelanggan > 0 ? round(($pelangganLaki / $totalPelanggan) * 100, 1) : 0,
            'persentasePerempuan'     => $totalPelanggan > 0 ? round(($pelangganPerempuan / $totalPelanggan) * 100, 1) : 0,
        ]);
    }

    /**
     * RESEPSIONIS DASHBOARD
     */
    public function resepsionis()
    {
        $this->authorizeRole('resepsionis');

        return view('pages.resepsionis.dashboard', [
            'title' => 'Dashboard Resepsionis',
            'user'  => Auth::user(),
        ]);
    }

    /**
     * PELANGGAN DASHBOARD
     */
    public function pelanggan()
    {
        $this->authorizeRole('pelanggan');

        return view('pages.pelanggan.dashboard', [
            'title' => 'Dashboard Pelanggan',
            'user'  => Auth::user(),
        ]);
    }

    /**
     * CHART DISTRIBUSI PELANGGAN
     */
    public function pelangganChart()
    {
        $this->authorizeRole('admin');

        $laki_laki = Pelanggan::where('jenis_kelamin', 'L')->count();
        $perempuan = Pelanggan::where('jenis_kelamin', 'P')->count();
        $total     = $laki_laki + $perempuan;

        return response()->json([
            'total'      => $total,
            'laki_laki'  => $laki_laki,
            'perempuan'  => $perempuan,
        ]);
    }

    /**
     * ROLE CHECK
     */
    private function authorizeRole($role)
    {
        $user = Auth::user();

        if (!$user || $user->role !== $role) {
            abort(403, 'Akses ditolak');
        }
    }
}