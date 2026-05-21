<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        return $this->checkRole('admin', 'pages.dashboard', 'Dashboard Admin');
    }

    public function resepsionis()
    {
        return $this->checkRole('resepsionis', 'pages.resepsionis.dashboard', 'Dashboard Resepsionis');
    }

    public function pelanggan()
    {
        return $this->checkRole('pelanggan', 'pages.pelanggan.dashboard', 'Dashboard Pelanggan');
    }

    private function checkRole($role, $view, $title)
    {
        $user = Auth::user();

        if (!$user || $user->role !== $role) {
            abort(403, 'Akses ditolak');
        }

        return view($view, [
            'title' => $title,
            'user' => $user,
        ]);
    }
}