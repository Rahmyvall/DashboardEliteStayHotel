<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Pelanggan;
use App\Models\TipeKamar;
use App\Models\Kamar;
use App\Models\TipeKamarFasilitas;

class DashboardController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | DASHBOARD ADMIN
    |--------------------------------------------------------------------------
    */
    public function index()
    {
        $user = Auth::user();

        if (!$user || $user->role !== 'admin') {
            abort(403, 'Akses ditolak');
        }

        // ================= TOTAL =================
        $totalUser = User::count();
        $totalKamar = Kamar::count();
        $totalTipeKamar = TipeKamar::count();
        $totalTipeKamarFasilitas = TipeKamarFasilitas::count();

        return view('pages.dashboard', [

            'title' => 'Dashboard Admin',
            'user'  => $user,

            // =========================================================
            // USERS
            // =========================================================
            'totalUsers' => $totalUser,

            'adminCount' =>
                User::where('role', 'admin')->count(),

            'resepsionisCount' =>
                User::where('role', 'resepsionis')->count(),

            'pelangganUser' =>
                User::where('role', 'pelanggan')->count(),

            'userAktif' =>
                User::where('status', 'aktif')->count(),

            'userBaruHariIni' =>
                User::whereDate('created_at', today())->count(),

            'userBulanIni' =>
                User::whereMonth('created_at', now()->month)->count(),

            // =========================================================
            // TIPE KAMAR
            // =========================================================
            'tipeKamarCount' =>
                $totalTipeKamar,

            // =========================================================
            // TIPE KAMAR FASILITAS
            // =========================================================
            'tipeKamarFasilitasCount' =>
                $totalTipeKamarFasilitas,

            // =========================================================
            // KAMAR
            // =========================================================
            'totalKamar' =>
                $totalKamar,

            'kamarTersedia' =>
                Kamar::where('status_kamar', 'tersedia')->count(),

            'kamarTerisi' =>
                Kamar::where('status_kamar', 'terisi')->count(),

            'kamarDipesan' =>
                Kamar::where('status_kamar', 'dipesan')->count(),

            // =========================================================
            // PELANGGAN
            // =========================================================
            'totalPelanggan' =>
                Pelanggan::count(),

            'pelangganLaki' =>
                Pelanggan::where('jenis_kelamin', 'L')->count(),

            'pelangganPerempuan' =>
                Pelanggan::where('jenis_kelamin', 'P')->count(),

            // =========================================================
            // PERSENTASE USER
            // =========================================================
            'persentaseAdmin' =>

                $totalUser

                    ? round(
                        User::where('role', 'admin')->count()
                            / $totalUser * 100,
                        1
                    )

                    : 0,

            'persentaseResepsionis' =>

                $totalUser

                    ? round(
                        User::where('role', 'resepsionis')->count()
                            / $totalUser * 100,
                        1
                    )

                    : 0,

            'persentasePelanggan' =>

                $totalUser

                    ? round(
                        User::where('role', 'pelanggan')->count()
                            / $totalUser * 100,
                        1
                    )

                    : 0,

            // =========================================================
            // PERSENTASE KAMAR
            // =========================================================
            'persentaseKamarTersedia' =>

                $totalKamar

                    ? round(
                        Kamar::where('status_kamar', 'tersedia')->count()
                            / $totalKamar * 100,
                        1
                    )

                    : 0,

            'persentaseKamarTerisi' =>

                $totalKamar

                    ? round(
                        Kamar::where('status_kamar', 'terisi')->count()
                            / $totalKamar * 100,
                        1
                    )

                    : 0,

            'persentaseKamarDipesan' =>

                $totalKamar

                    ? round(
                        Kamar::where('status_kamar', 'dipesan')->count()
                            / $totalKamar * 100,
                        1
                    )

                    : 0,

            // =========================================================
            // PERSENTASE TIPE KAMAR FASILITAS
            // =========================================================
            'persentaseTipeKamarFasilitas' =>

                $totalTipeKamar

                    ? round(
                        $totalTipeKamarFasilitas
                            / $totalTipeKamar * 100,
                        1
                    )

                    : 0,
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | DASHBOARD PELANGGAN
    |--------------------------------------------------------------------------
    */
    public function pelanggan()
    {
        $user = Auth::user();

        if (!$user || $user->role !== 'pelanggan') {
            abort(403, 'Akses ditolak');
        }

        return view('pages.pelanggan.dashboard', [

            'title' => 'Dashboard Pelanggan',

            'user'  => $user,

            'totalKamar' =>
                Kamar::count(),

            'kamarTersedia' =>
                Kamar::where('status_kamar', 'tersedia')->count(),

            'tipeKamar' =>
                TipeKamar::count(),

            'tipeKamarFasilitas' =>
                TipeKamarFasilitas::count(),
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | CHART API
    |--------------------------------------------------------------------------
    */
    public function pelangganChart()
    {
        $user = Auth::user();

        if (!$user || $user->role !== 'admin') {
            abort(403, 'Akses ditolak');
        }

        $laki =
            Pelanggan::where('jenis_kelamin', 'L')->count();

        $perempuan =
            Pelanggan::where('jenis_kelamin', 'P')->count();

        return response()->json([

            'total' =>
                $laki + $perempuan,

            'laki_laki' =>
                $laki,

            'perempuan' =>
                $perempuan,
        ]);
    }
}
