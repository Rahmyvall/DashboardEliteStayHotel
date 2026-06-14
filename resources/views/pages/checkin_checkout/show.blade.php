@extends('layouts.app')

@section('title', 'Detail Check In / Check Out')

@section('content')
    <div class="container-fluid">

        @php
            $badge = match ($checkin->status) {
                'checked_in' => 'success',
                'checked_out' => 'secondary',
                'late_checkout' => 'warning',
                'cancelled' => 'danger',
                default => 'info',
            };
        @endphp

        {{-- Header --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-bold mb-1">
                    <i class="fas fa-clipboard-list text-primary me-2"></i>
                    Detail Check In / Check Out
                </h2>
                <p class="text-muted mb-0">
                    Informasi lengkap reservasi tamu
                </p>
            </div>

            <a href="{{ route('checkin-checkout.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-1"></i>
                Kembali
            </a>
        </div>

        {{-- Summary --}}
        <div class="row g-3 mb-4">

            <div class="col-md-3">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body">
                        <small class="text-muted">Nomor Kamar</small>
                        <h4 class="mb-0">
                            {{ $checkin->reservasi->kamar->nomor_kamar ?? '-' }}
                        </h4>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body">
                        <small class="text-muted">Jumlah Tamu</small>
                        <h4 class="mb-0">
                            {{ $checkin->jumlah_tamu_aktual ?? 0 }}
                        </h4>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body">
                        <small class="text-muted">Total Bayar</small>
                        <h4 class="mb-0">
                            Rp {{ number_format($checkin->total_bayar ?? 0, 0, ',', '.') }}
                        </h4>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body">
                        <small class="text-muted">Status</small>
                        <div class="mt-2">
                            <span class="badge bg-{{ $badge }}">
                                {{ strtoupper(str_replace('_', ' ', $checkin->status)) }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="row">

            {{-- Detail Reservasi --}}
            <div class="col-lg-8">

                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-white">
                        <h5 class="mb-0 fw-bold">
                            Informasi Reservasi
                        </h5>
                    </div>

                    <div class="card-body">

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="text-muted">Kode Reservasi</label>
                                <div class="fw-semibold">
                                    {{ $checkin->reservasi->kode_reservasi ?? '-' }}
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label class="text-muted">Nama Tamu</label>
                                <div class="fw-semibold">
                                    {{ $checkin->reservasi->pelanggan->nama_lengkap ?? '-' }}
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="text-muted">Nomor Kamar</label>
                                <div class="fw-semibold">
                                    {{ $checkin->reservasi->kamar->nomor_kamar ?? '-' }}
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label class="text-muted">Tipe Kamar</label>
                                <div class="fw-semibold">
                                    {{ $checkin->reservasi->kamar->tipe_kamar->nama_tipe ?? '-' }}
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="text-muted">Check In Aktual</label>
                                <div class="fw-semibold">
                                    {{ optional($checkin->waktu_checkin_aktual)->format('d M Y H:i') ?? '-' }}
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label class="text-muted">Check Out Aktual</label>
                                <div class="fw-semibold">
                                    {{ optional($checkin->waktu_checkout_aktual)->format('d M Y H:i') ?? 'Belum Check Out' }}
                                </div>
                            </div>
                        </div>

                        <div>
                            <label class="text-muted">Kondisi Kamar</label>
                            <div class="fw-semibold">
                                {{ $checkin->kondisi_kamar ?? '-' }}
                            </div>
                        </div>

                    </div>
                </div>

                {{-- Catatan Check In --}}
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-white">
                        <h5 class="mb-0 fw-bold">Catatan Check In</h5>
                    </div>

                    <div class="card-body">
                        {{ $checkin->catatan ?? 'Tidak ada catatan' }}
                    </div>
                </div>

                {{-- Catatan Check Out --}}
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white">
                        <h5 class="mb-0 fw-bold">Catatan Check Out</h5>
                    </div>

                    <div class="card-body">
                        {{ $checkin->catatan_checkout ?? 'Tidak ada catatan' }}
                    </div>
                </div>

            </div>

            {{-- Sidebar --}}
            <div class="col-lg-4">

                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-white">
                        <h5 class="mb-0 fw-bold">
                            Ringkasan Keuangan
                        </h5>
                    </div>

                    <div class="card-body">

                        <div class="d-flex justify-content-between mb-3">
                            <span>Deposit</span>
                            <strong>
                                Rp {{ number_format($checkin->deposit ?? 0, 0, ',', '.') }}
                            </strong>
                        </div>

                        <div class="d-flex justify-content-between mb-3">
                            <span>Biaya Tambahan</span>
                            <strong>
                                Rp {{ number_format($checkin->biaya_tambahan ?? 0, 0, ',', '.') }}
                            </strong>
                        </div>

                        <div class="d-flex justify-content-between mb-3">
                            <span>Denda Late Checkout</span>
                            <strong class="text-danger">
                                Rp {{ number_format($checkin->denda_late_checkout ?? 0, 0, ',', '.') }}
                            </strong>
                        </div>

                        <hr>

                        <div class="d-flex justify-content-between">
                            <span class="fw-bold">Total Bayar</span>
                            <span class="fw-bold text-primary">
                                Rp {{ number_format($checkin->total_bayar ?? 0, 0, ',', '.') }}
                            </span>
                        </div>

                    </div>
                </div>

            </div>

        </div>

    </div>
@endsection

@push('styles')
    <style>
        body {
            background: #f5f7fb;
        }

        .card {
            border-radius: 12px;
        }

        .card-header {
            border-bottom: 1px solid #eef2f7;
        }

        label {
            font-size: 13px;
            margin-bottom: 4px;
        }

        .fw-semibold {
            font-size: 15px;
        }
    </style>
@endpush
