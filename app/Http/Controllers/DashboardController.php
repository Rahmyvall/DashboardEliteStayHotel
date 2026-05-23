<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;

class DashboardController extends Controller
{
    /**
     * ADMIN DASHBOARD
     */
    public function index()
    {
        $this->authorizeRole('admin');

        return view('pages.dashboard', [
            'title' => 'Dashboard Admin',
            'user'  => Auth::user(),

            // DATA ADMIN
            'totalUsers'      => User::count(),
            'adminCount'      => User::where('role', 'admin')->count(),
            'resepsionis'     => User::where('role', 'resepsionis')->count(),
            'pelanggan'       => User::where('role', 'pelanggan')->count(),
            'userAktif'       => User::where('status', 'aktif')->count(),
            'userBaruHariIni' => User::whereDate('created_at', today())->count(),
            'userBulanIni'    => User::whereMonth('created_at', now()->month)->count(),
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
     * ROLE CHECK SIMPLE (BERSIH & AMAN)
     */
    private function authorizeRole($role)
    {
        $user = Auth::user();

        if (!$user || $user->role !== $role) {
            abort(403, 'Akses ditolak');
        }
    }
}
