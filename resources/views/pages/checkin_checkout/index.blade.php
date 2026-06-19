@extends('layouts.app')

@section('title', 'Check In / Check Out')

@section('content')
<div class="container-fluid">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-1">Check In & Check Out</h3>
            <small class="text-muted">Manajemen Tamu Hotel</small>
        </div>

        <a href="{{ route('checkin-checkout.create') }}" class="btn btn-primary">
            <i class="fas fa-door-open me-2"></i>
            Check In Baru
        </a>
    </div>

    {{-- Flash Message --}}
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    {{-- Statistik --}}
    <div class="row mb-4">

        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <small class="text-muted">Check In Hari Ini</small>
                            <h3 class="fw-bold">{{ $todayCheckin }}</h3>
                        </div>
                        <i class="fas fa-sign-in-alt fa-2x text-success"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <small class="text-muted">Sedang Menginap</small>
                            <h3 class="fw-bold">{{ $staying }}</h3>
                        </div>
                        <i class="fas fa-bed fa-2x text-primary"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <small class="text-muted">Check Out Hari Ini</small>
                            <h3 class="fw-bold">{{ $todayCheckout }}</h3>
                        </div>
                        <i class="fas fa-sign-out-alt fa-2x text-danger"></i>
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- Filter --}}
    <div class="card shadow-sm border-0 mb-3">
        <div class="card-body">
            <form method="GET">

                <div class="row g-2">

                    <div class="col-md-5">
                        <input type="text" name="search" class="form-control"
                            placeholder="Cari nama tamu / kode reservasi" value="{{ request('search') }}">
                    </div>

                    <div class="col-md-3">
                        <select name="status" class="form-select">

                            <option value="">Semua Status</option>

                            <option value="checked_in" {{ request('status') == 'checked_in' ? 'selected' : '' }}>
                                Checked In
                            </option>

                            <option value="checked_out" {{ request('status') == 'checked_out' ? 'selected' : '' }}>
                                Checked Out
                            </option>

                            <option value="late_checkout" {{ request('status') == 'late_checkout' ? 'selected' : '' }}>
                                Late Checkout
                            </option>

                            <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>
                                Cancelled
                            </option>

                        </select>
                    </div>

                    <div class="col-md-2">
                        <button class="btn btn-primary w-100">
                            <i class="fas fa-search me-1"></i>
                            Filter
                        </button>
                    </div>

                    <div class="col-md-2">
                        <a href="{{ route('checkin-checkout.index') }}" class="btn btn-secondary w-100">
                            Reset
                        </a>
                    </div>

                </div>

            </form>
        </div>
    </div>

    {{-- Tabel --}}
    <div class="card shadow-sm border-0">
        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0">

                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Kamar</th>
                            <th>Check In</th>
                            <th>Check Out</th>
                            <th>Deposit</th>
                            <th>Status</th>
                            <th width="180">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($checkins as $item)

                        @php
                        $reservasi = $item->reservasi;
                        $pelanggan = $reservasi?->pelanggan;
                        $kamar = $reservasi?->kamar;
                        @endphp

                        <tr>

                            <td>
                                <strong>{{ $item->id_check }}</strong>
                            </td>

                            <td>

                                <small class="text-muted">
                                    {{ $kamar?->tipeKamar?->nama_tipe ?? '-' }}
                                </small>
                            </td>

                            <td>
                                @if($item->waktu_checkin_aktual)
                                {{ \Carbon\Carbon::parse($item->waktu_checkin_aktual)->format('d/m/Y') }}
                                <br>
                                <small class="text-muted">
                                    {{ \Carbon\Carbon::parse($item->waktu_checkin_aktual)->format('H:i') }}
                                </small>
                                @else
                                <span class="text-muted">
                                    Belum Check In
                                </span>
                                @endif
                            </td>

                            <td>
                                @if($item->waktu_checkout_aktual)
                                {{ \Carbon\Carbon::parse($item->waktu_checkout_aktual)->format('d/m/Y') }}
                                <br>
                                <small class="text-muted">
                                    {{ \Carbon\Carbon::parse($item->waktu_checkout_aktual)->format('H:i') }}
                                </small>
                                @else
                                <span class="text-warning fw-bold">
                                    Belum Check Out
                                </span>
                                @endif
                            </td>

                            <td>
                                Rp {{ number_format($item->deposit ?? 0, 0, ',', '.') }}
                            </td>

                            <td>

                                @php
                                $badge = match($item->status){
                                'checked_in' => 'success',
                                'checked_out' => 'secondary',
                                'late_checkout' => 'warning',
                                'cancelled' => 'danger',
                                default => 'info'
                                };
                                @endphp

                                <span class="badge bg-{{ $badge }}">
                                    {{ ucwords(str_replace('_', ' ', $item->status)) }}
                                </span>

                                @if($item->is_late_checkout)
                                <span class="badge bg-danger">
                                    Late
                                </span>
                                @endif

                            </td>

                            <td>

                                <a href="{{ route('checkin-checkout.show', $item->id_check) }}"
                                    class="btn btn-info btn-sm">
                                    <i class="fas fa-eye"></i>
                                </a>

                                @if(!$item->waktu_checkout_aktual)
                                <a href="{{ route('checkin-checkout.edit', $item->id_check) }}"
                                    class="btn btn-warning btn-sm">
                                    <i class="fas fa-sign-out-alt"></i>
                                </a>
                                @endif

                            </td>

                        </tr>

                        @empty

                        <tr>
                            <td colspan="8" class="text-center py-4 text-muted">
                                Tidak ada data Check In / Check Out
                            </td>
                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>
    </div>

    {{-- Pagination --}}
    <div class="mt-3">
        {{ $checkins->links() }}
    </div>

</div>
@endsection
