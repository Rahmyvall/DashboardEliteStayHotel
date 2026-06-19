@extends('layouts.app')

@section('title', 'Detail Check In / Check Out')

@section('content')

<div class="container-fluid py-4">

    {{-- Header Modern --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-5 gap-3">
        <div>
            <h1 class="fw-bold mb-1 text-dark">
                <i class="fas fa-clipboard-list text-primary me-3"></i>
                Detail Reservasi
            </h1>
            <p class="text-muted fs-5 mb-0">
                {{ $checkin->reservasi->kode_reservasi ?? '-' }}
            </p>
        </div>

        <div class="d-flex gap-2">
            <a href="{{ route('checkin-checkout.index') }}" class="btn btn-outline-secondary btn-lg">
                <i class="fas fa-arrow-left me-2"></i>
                Kembali
            </a>

            <a href="{{ route('checkin-checkout.print', $checkin->id_check) }}" target="_blank"
                class="btn btn-primary btn-lg shadow-sm">
                <i class="fas fa-print me-2"></i>
                Print Invoice
            </a>
        </div>
    </div>

    @php
    $badge = match ($checkin->status) {
    'checked_in' => 'success',
    'checked_out' => 'secondary',
    'late_checkout' => 'warning',
    'cancelled' => 'danger',
    default => 'info',
    };
    @endphp

    {{-- Status Banner --}}
    <div class="mb-4">
        <span class="badge bg-{{ $badge }} fs-5 px-4 py-3 rounded-3">
            <i class="fas fa-circle me-2"></i>
            {{ strtoupper(str_replace('_', ' ', $checkin->status)) }}
        </span>
    </div>

    {{-- Summary Cards --}}
    <div class="row g-4 mb-5">
        <div class="col-lg-3 col-md-6">
            <div class="card h-100 border-0 shadow-sm modern-card">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <i class="fas fa-door-open text-primary fs-3"></i>
                    </div>
                    <small class="text-muted text-uppercase fw-medium">Nomor Kamar</small>
                    <h2 class="fw-bold mb-0 mt-1">
                        {{ $checkin->reservasi->kamar->nomor_kamar ?? '-' }}
                    </h2>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="card h-100 border-0 shadow-sm modern-card">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <i class="fas fa-users text-info fs-3"></i>
                    </div>
                    <small class="text-muted text-uppercase fw-medium">Jumlah Tamu</small>
                    <h2 class="fw-bold mb-0 mt-1">
                        {{ $checkin->jumlah_tamu_aktual ?? 0 }} Orang
                    </h2>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="card h-100 border-0 shadow-sm modern-card">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <i class="fas fa-money-bill-wave text-success fs-3"></i>
                    </div>
                    <small class="text-muted text-uppercase fw-medium">Total Bayar</small>
                    <h2 class="fw-bold mb-0 mt-1 text-success">
                        Rp {{ number_format($checkin->total_bayar ?? 0, 0, ',', '.') }}
                    </h2>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="card h-100 border-0 shadow-sm modern-card">
                <div class="card-body">
                    <small class="text-muted text-uppercase fw-medium">Status</small>
                    <h2 class="fw-bold mb-0 mt-2">
                        {{ $checkin->reservasi->kamar->tipe_kamar->nama_tipe ?? '-' }}
                    </h2>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        {{-- Main Content --}}
        <div class="col-lg-8">

            {{-- Informasi Reservasi --}}
            <div class="card border-0 shadow-sm mb-4 modern-card">
                <div class="card-header bg-white py-4">
                    <h5 class="mb-0 fw-semibold">
                        <i class="fas fa-info-circle text-primary me-2"></i>
                        Informasi Reservasi
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="field-label">Kode Reservasi</div>
                            <div class="field-value">{{ $checkin->reservasi->kode_reservasi ?? '-' }}</div>
                        </div>
                        <div class="col-md-6">
                            <div class="field-label">Nama Tamu</div>
                            <div class="field-value">{{ $checkin->reservasi->pelanggan->nama_lengkap ?? '-' }}</div>
                        </div>
                        <div class="col-md-6">
                            <div class="field-label">Tipe Kamar</div>
                            <div class="field-value">{{ $checkin->reservasi->kamar->tipe_kamar->nama_tipe ?? '-' }}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="field-label">Check In Aktual</div>
                            <div class="field-value">
                                {{ optional($checkin->waktu_checkin_aktual)->format('d M Y • H:i') ?? '-' }}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="field-label">Check Out Aktual</div>
                            <div class="field-value">
                                {{ optional($checkin->waktu_checkout_aktual)->format('d M Y • H:i') ?? '<span class="text-warning">Belum Check Out</span>' }}
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="field-label">Kondisi Kamar</div>
                            <div class="field-value">{{ $checkin->kondisi_kamar ?? '-' }}</div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Catatan Check In & Check Out --}}
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="card border-0 shadow-sm h-100 modern-card">
                        <div class="card-header bg-white py-4">
                            <h5 class="mb-0 fw-semibold text-success">
                                <i class="fas fa-sign-in-alt me-2"></i>
                                Catatan Check In
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="alert alert-light border-0 p-4">
                                {{ $checkin->catatan ?? 'Tidak ada catatan.' }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card border-0 shadow-sm h-100 modern-card">
                        <div class="card-header bg-white py-4">
                            <h5 class="mb-0 fw-semibold text-danger">
                                <i class="fas fa-sign-out-alt me-2"></i>
                                Catatan Check Out
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="alert alert-light border-0 p-4">
                                {{ $checkin->catatan_checkout ?? 'Tidak ada catatan.' }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        {{-- Sidebar Keuangan --}}
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm sticky-top modern-card" style="top: 20px;">
                <div class="card-header bg-white py-4">
                    <h5 class="mb-0 fw-semibold">
                        <i class="fas fa-receipt text-primary me-2"></i>
                        Ringkasan Keuangan
                    </h5>
                </div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between py-3">
                            <span>Deposit</span>
                            <strong>Rp {{ number_format($checkin->deposit ?? 0, 0, ',', '.') }}</strong>
                        </li>
                        <li class="list-group-item d-flex justify-content-between py-3">
                            <span>Biaya Tambahan</span>
                            <strong>Rp {{ number_format($checkin->biaya_tambahan ?? 0, 0, ',', '.') }}</strong>
                        </li>
                        <li class="list-group-item d-flex justify-content-between py-3 text-danger">
                            <span>Denda Late Checkout</span>
                            <strong>Rp {{ number_format($checkin->denda_late_checkout ?? 0, 0, ',', '.') }}</strong>
                        </li>
                        <li class="list-group-item bg-light d-flex justify-content-between py-4 fs-5">
                            <span class="fw-bold">Total Pembayaran</span>
                            <span class="fw-bold text-primary">
                                Rp {{ number_format($checkin->total_bayar ?? 0, 0, ',', '.') }}
                            </span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@push('styles')
<style>
:root {
    --primary: #0d6efd;
}

.modern-card {
    border-radius: 20px;
    overflow: hidden;
    transition: all 0.3s ease;
}

.modern-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1) !important;
}

.card-header {
    border-bottom: 1px solid #f1f3f9;
}

.field-label {
    font-size: 0.8rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    color: #6c757d;
    margin-bottom: 6px;
}

.field-value {
    font-size: 1.05rem;
    font-weight: 600;
    color: #212529;
}

.list-group-item {
    border-color: #f1f3f9;
}

h2 {
    font-size: 2.1rem;
}

.badge {
    font-weight: 600;
    padding: 12px 24px;
}

@media (max-width: 991px) {
    .sticky-top {
        position: relative !important;
        top: auto;
    }
}
</style>
@endpush
