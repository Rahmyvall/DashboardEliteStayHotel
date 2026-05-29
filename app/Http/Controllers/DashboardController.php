<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Pelanggan;
use App\Models\TipeKamar;
use App\Models\Kamar;
use App\Models\TipeKamarFasilitas;
use App\Models\Reservasi;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if (!$user || $user->role !== 'admin') {
            abort(403, 'Akses ditolak');
        }

        // =========================
        // TOTAL DATA
        // =========================
        $totalUser = User::count();
        $totalKamar = Kamar::count();
        $totalTipeKamar = TipeKamar::count();
        $totalTipeKamarFasilitas = TipeKamarFasilitas::count();
        $totalReservasi = Reservasi::count();

        // =========================
        // STATUS RESERVASI
        // =========================
        $statusReservasi = Reservasi::selectRaw("
            SUM(CASE WHEN status_reservasi = 'pending' THEN 1 ELSE 0 END) as pending,
            SUM(CASE WHEN status_reservasi = 'confirmed' THEN 1 ELSE 0 END) as confirmed,
            SUM(CASE WHEN status_reservasi = 'checkin' THEN 1 ELSE 0 END) as checkin,
            SUM(CASE WHEN status_reservasi = 'checkout' THEN 1 ELSE 0 END) as checkout,
            SUM(CASE WHEN status_reservasi = 'cancelled' THEN 1 ELSE 0 END) as cancelled,
            SUM(CASE WHEN status_reservasi = 'no_show' THEN 1 ELSE 0 END) as no_show
        ")->first();

        // =========================
        // DATA UNTUK VIEW
        // =========================
        return view('pages.dashboard', [
            'title' => 'Dashboard Admin',
            'user'  => $user,

            // USERS
            'totalUsers' => $totalUser,
            'adminCount' => User::where('role', 'admin')->count(),
            'resepsionisCount' => User::where('role', 'resepsionis')->count(),
            'pelangganUser' => User::where('role', 'pelanggan')->count(),
            'userAktif' => User::where('status', 'aktif')->count(),
            'userBaruHariIni' => User::whereDate('created_at', today())->count(),
            'userBulanIni' => User::whereMonth('created_at', now()->month)->count(),

            // KAMAR
            'totalKamar' => $totalKamar,
            'kamarTersedia' => Kamar::where('status_kamar', 'tersedia')->count(),
            'kamarTerisi' => Kamar::where('status_kamar', 'terisi')->count(),
            'kamarDipesan' => Kamar::where('status_kamar', 'dipesan')->count(),

            // TIPE KAMAR
            'tipeKamarCount' => $totalTipeKamar,
            'tipeKamarFasilitasCount' => $totalTipeKamarFasilitas,

            // RESERVASI
            'totalReservasi' => $totalReservasi,
            'reservasiPending' => $statusReservasi->pending ?? 0,
            'reservasiConfirmed' => $statusReservasi->confirmed ?? 0,
            'reservasiCheckin' => $statusReservasi->checkin ?? 0,
            'reservasiCheckout' => $statusReservasi->checkout ?? 0,
            'reservasiCancelled' => $statusReservasi->cancelled ?? 0,

            'reservasiHariIni' => Reservasi::whereDate('tanggal_pesan', today())->count(),
            'reservasiBulanIni' => Reservasi::whereMonth('tanggal_pesan', now()->month)->count(),

            'totalPendapatan' => Reservasi::whereIn('status_reservasi', ['confirmed', 'checkin', 'checkout'])
                                ->sum('total_harga'),

            // PELANGGAN
            'totalPelanggan' => Pelanggan::count(),
            'pelangganLaki' => Pelanggan::where('jenis_kelamin', 'L')->count(),
            'pelangganPerempuan' => Pelanggan::where('jenis_kelamin', 'P')->count(),
        ]);
    }

    // =========================
    // LINE CHART RESERVASI (Baru)
    // =========================
    public function getReservasiLineChart()
    {
        $user = Auth::user();
        if (!$user || $user->role !== 'admin') {
            abort(403, 'Akses ditolak');
        }

        $periode = request('periode', 'monthly');

        if ($periode === 'daily') {
            // 7 Hari Terakhir
            $data = Reservasi::selectRaw('
                    DATE(tanggal_pesan) as tanggal,
                    COUNT(*) as total_reservasi,
                    SUM(CASE WHEN status_reservasi = "confirmed" THEN 1 ELSE 0 END) as confirmed,
                    SUM(CASE WHEN status_reservasi = "checkin" THEN 1 ELSE 0 END) as checkin
                ')
                ->where('tanggal_pesan', '>=', Carbon::now()->subDays(7))
                ->groupBy('tanggal')
                ->orderBy('tanggal')
                ->get();

            $labels = $data->pluck('tanggal')->map(fn($date) => Carbon::parse($date)->format('d M'));
        } else {
            // Bulanan (12 bulan terakhir)
            $data = Reservasi::selectRaw('
                    DATE_FORMAT(tanggal_pesan, "%Y-%m") as bulan,
                    COUNT(*) as total_reservasi,
                    SUM(CASE WHEN status_reservasi = "confirmed" THEN 1 ELSE 0 END) as confirmed,
                    SUM(CASE WHEN status_reservasi = "checkin" THEN 1 ELSE 0 END) as checkin
                ')
                ->where('tanggal_pesan', '>=', Carbon::now()->subMonths(12))
                ->groupBy('bulan')
                ->orderBy('bulan')
                ->get();

            $labels = $data->pluck('bulan')->map(fn($bulan) => Carbon::parse($bulan)->format('M Y'));
        }

        return response()->json([
            'labels'     => $labels,
            'total'      => $data->pluck('total_reservasi'),
            'confirmed'  => $data->pluck('confirmed'),
            'checkin'    => $data->pluck('checkin'),
        ]);
    }

    // =========================
    // PELANGGAN DASHBOARD
    // =========================
    public function pelanggan()
    {
        $user = Auth::user();

        if (!$user || $user->role !== 'pelanggan') {
            abort(403, 'Akses ditolak');
        }

        return view('pages.pelanggan.dashboard', [
            'title' => 'Dashboard Pelanggan',
            'user'  => $user,
            'totalKamar' => Kamar::count(),
            'kamarTersedia' => Kamar::where('status_kamar', 'tersedia')->count(),
            'tipeKamar' => TipeKamar::count(),
            'tipeKamarFasilitas' => TipeKamarFasilitas::count(),
        ]);
    }

    // =========================
    // CHART PELANGGAN (Gender)
    // =========================
    public function pelangganChart()
    {
        $user = Auth::user();

        if (!$user || $user->role !== 'admin') {
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
