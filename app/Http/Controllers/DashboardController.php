<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Pelanggan;
use App\Models\Kamar;
use App\Models\TipeKamar;
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

    // ======================
    // DATA PELANGGAN
    // ======================
    $lakiLaki = Pelanggan::where('jenis_kelamin', 'L')->count();
    $perempuan = Pelanggan::where('jenis_kelamin', 'P')->count();
    $totalPelanggan = $lakiLaki + $perempuan;

    // ======================
    // DATA RESERVASI
    // ======================
    $totalReservasi = Reservasi::count();

    $statusReservasi = Reservasi::selectRaw("
        SUM(CASE WHEN status_reservasi = 'pending' THEN 1 ELSE 0 END) as pending,
        SUM(CASE WHEN status_reservasi = 'confirmed' THEN 1 ELSE 0 END) as confirmed,
        SUM(CASE WHEN status_reservasi = 'checkin' THEN 1 ELSE 0 END) as checkin,
        SUM(CASE WHEN status_reservasi = 'checkout' THEN 1 ELSE 0 END) as checkout,
        SUM(CASE WHEN status_reservasi = 'cancelled' THEN 1 ELSE 0 END) as cancelled,
        SUM(CASE WHEN status_reservasi = 'no_show' THEN 1 ELSE 0 END) as no_show
    ")->first();

    // ======================
    // PENDAPATAN
    // ======================
    $pendapatan = Reservasi::whereIn(
        'status_reservasi',
        ['confirmed', 'checkin', 'checkout']
    )->sum('total_harga');

    // ======================
    // RETURN VIEW
    // ======================
    return view('pages.dashboard', [
        'title' => 'Dashboard Admin',
        'user' => $user,

        // User
        'totalUsers' => User::count(),
        'adminCount' => User::where('role', 'admin')->count(),
        'resepsionisCount' => User::where('role', 'resepsionis')->count(),
        'pelangganUser' => User::where('role', 'pelanggan')->count(),
        'userAktif' => User::where('status', 'aktif')->count(),
        'userBaruHariIni' => User::whereDate('created_at', today())->count(),
        'userBulanIni' => User::whereMonth('created_at', now()->month)->count(),

        // Kamar
        'totalKamar' => Kamar::count(),
        'kamarTersedia' => Kamar::where('status_kamar', 'tersedia')->count(),
        'kamarTerisi' => Kamar::where('status_kamar', 'terisi')->count(),
        'kamarDipesan' => Kamar::where('status_kamar', 'dipesan')->count(),

        // Tipe Kamar
        'tipeKamarCount' => TipeKamar::count(),
        'tipeKamarFasilitasCount' => TipeKamarFasilitas::count(),

        // Reservasi
        'totalReservasi' => $totalReservasi,
        'reservasiPending' => $statusReservasi->pending ?? 0,
        'reservasiConfirmed' => $statusReservasi->confirmed ?? 0,
        'reservasiCheckin' => $statusReservasi->checkin ?? 0,
        'reservasiCheckout' => $statusReservasi->checkout ?? 0,
        'reservasiCancelled' => $statusReservasi->cancelled ?? 0,
        'reservasiNoShow' => $statusReservasi->no_show ?? 0,

        'reservasiHariIni' => Reservasi::whereDate('tanggal_pesan', today())->count(),
        'reservasiBulanIni' => Reservasi::whereMonth('tanggal_pesan', now()->month)->count(),

        // Pendapatan
        'pendapatan' => $pendapatan,

        // Pelanggan
        'totalPelanggan' => $totalPelanggan,
        'lakiLaki' => $lakiLaki,
        'perempuan' => $perempuan,
    ]);
}
    /**
     * Dashboard Admin
        * Line Chart - Tren Reservasi (untuk AJAX)
     */
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
                ->where('tanggal_pesan', '>=', Carbon::now()->subDays(6)) // 7 hari termasuk hari ini
                ->groupBy('tanggal')
                ->orderBy('tanggal')
                ->get();

            $labels = $data->pluck('tanggal')->map(fn($date) => Carbon::parse($date)->format('d M'));
        } else {
            // 12 Bulan Terakhir
            $data = Reservasi::selectRaw('
                    DATE_FORMAT(tanggal_pesan, "%Y-%m") as bulan,
                    COUNT(*) as total_reservasi,
                    SUM(CASE WHEN status_reservasi = "confirmed" THEN 1 ELSE 0 END) as confirmed,
                    SUM(CASE WHEN status_reservasi = "checkin" THEN 1 ELSE 0 END) as checkin
                ')
                ->where('tanggal_pesan', '>=', Carbon::now()->subMonths(11))
                ->groupBy('bulan')
                ->orderBy('bulan')
                ->get();

            $labels = $data->pluck('bulan')->map(fn($bulan) => Carbon::parse($bulan . '-01')->format('M Y'));
        }

        return response()->json([
            'labels'     => $labels,
            'total'      => $data->pluck('total_reservasi'),
            'confirmed'  => $data->pluck('confirmed'),
            'checkin'    => $data->pluck('checkin'),
        ]);
    }

  public function pendapatanChart()
{
    $tahun = request('year', date('Y'));

    $labels = [];
    $pendapatan = [];
    $totalPendapatan = 0;
    $totalTransaksi = 0;

    for ($bulan = 1; $bulan <= 12; $bulan++) {

        $total = Reservasi::whereYear('tanggal_pesan', $tahun)
            ->whereMonth('tanggal_pesan', $bulan)
            ->whereIn('status_reservasi', [
                'confirmed',
                'checkin',
                'checkout'
            ])
            ->sum('total_harga');

        $transaksi = Reservasi::whereYear('tanggal_pesan', $tahun)
            ->whereMonth('tanggal_pesan', $bulan)
            ->whereIn('status_reservasi', [
                'confirmed',
                'checkin',
                'checkout'
            ])
            ->count();

        $labels[] = Carbon::create()->month($bulan)->translatedFormat('M');

        $pendapatan[] = $total;

        $totalPendapatan += $total;
        $totalTransaksi += $transaksi;
    }

    return response()->json([
        'labels'           => $labels,
        'pendapatan'       => $pendapatan,
        'totalPendapatan'  => $totalPendapatan,
        'rataRata'         => round($totalPendapatan / 12),
        'totalTransaksi'   => $totalTransaksi,
    ]);
}
    /**
     * Chart Pelanggan berdasarkan Gender (untuk Pie/Donut Chart)
     */
    public function pelangganChart()
    {
        $user = Auth::user();
        if (!$user || $user->role !== 'admin') {
            abort(403, 'Akses ditolak');
        }

        $laki = Pelanggan::where('jenis_kelamin', 'L')->count();
        $perempuan = Pelanggan::where('jenis_kelamin', 'P')->count();
        $total = $laki + $perempuan;

        return response()->json([
            'total'      => $total,
            'laki_laki'  => $laki,
            'perempuan'  => $perempuan,
        ]);
    }

    /**
     * Dashboard Pelanggan (jika diperlukan)
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
            'totalKamar'     => Kamar::count(),
            'kamarTersedia'  => Kamar::where('status_kamar', 'tersedia')->count(),
            'tipeKamar'      => TipeKamar::count(),
            'tipeKamarFasilitas' => TipeKamarFasilitas::count(),
        ]);
    }
}