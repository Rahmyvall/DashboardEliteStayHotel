@extends('layouts.app')

@section('content')
    @php
        use Carbon\Carbon;

        $checkIn = $reservasi->check_in ? Carbon::parse($reservasi->check_in) : null;
        $checkOut = $reservasi->check_out ? Carbon::parse($reservasi->check_out) : null;
    @endphp

    <div class="container-fluid py-4">

        {{-- HEADER --}}
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-5">
            <div>
                <h1 class="fw-bold text-dark mb-1">Detail Reservasi</h1>
                <p class="text-muted mb-0">Informasi lengkap booking tamu hotel</p>
            </div>

            <div class="d-flex gap-2">
                <a href="{{ route('reservasi.edit', $reservasi->id_reservasi) }}" class="btn btn-warning shadow-sm">
                    Edit
                </a>

                <button class="btn btn-dark shadow-sm" onclick="window.print()">
                    Print Invoice
                </button>
            </div>
        </div>

        {{-- CARD --}}
        <div class="card border-0 shadow-sm" id="printArea">
            <div class="card-body p-5">

                {{-- HEADER INVOICE --}}
                <div class="d-flex justify-content-between mb-4">
                    <div>
                        <h2 class="fw-bold text-primary mb-1">HOTEL PREMIUM</h2>
                        <small class="text-muted">Sistem Reservasi Hotel</small>
                    </div>

                    <div class="text-end">
                        <h4 class="fw-bold text-primary">{{ $reservasi->kode_reservasi }}</h4>

                        <span
                            class="badge
                        @if ($reservasi->status_reservasi == 'confirmed') bg-success
                        @elseif($reservasi->status_reservasi == 'pending') bg-warning text-dark
                        @elseif($reservasi->status_reservasi == 'checkin') bg-info
                        @elseif($reservasi->status_reservasi == 'checkout') bg-secondary
                        @elseif($reservasi->status_reservasi == 'cancelled') bg-danger
                        @else bg-dark @endif">

                            {{ ucfirst($reservasi->status_reservasi) }}
                        </span>
                    </div>
                </div>

                <hr>

                <div class="row">

                    {{-- PELANGGAN --}}
                    <div class="col-md-6 mb-4">
                        <h6 class="fw-bold mb-3">Pelanggan</h6>

                        <p class="mb-1">
                            {{ optional(optional($reservasi->pelanggan)->user)->nama_lengkap ?? '-' }}
                        </p>

                        <small class="text-muted">
                            {{ optional(optional($reservasi->pelanggan)->user)->email ?? '-' }}
                        </small>
                    </div>

                    {{-- RESERVASI --}}
                    <div class="col-md-6 mb-4">
                        <h6 class="fw-bold mb-3">Detail Menginap</h6>

                        <p>Kamar: <b>{{ optional($reservasi->kamar)->nomor_kamar ?? '-' }}</b></p>

                        <p>
                            Check In:
                            <b>{{ $checkIn ? $checkIn->format('d M Y') : '-' }}</b>
                        </p>

                        <p>
                            Check Out:
                            <b>{{ $checkOut ? $checkOut->format('d M Y') : '-' }}</b>
                        </p>

                        <p>Lama: <b>{{ $reservasi->lama_menginap ?? 0 }} malam</b></p>
                    </div>
                </div>

                <hr>

                {{-- HARGA --}}
                <h6 class="fw-bold mb-3">Rincian Pembayaran</h6>

                <table class="table table-bordered">
                    <tr>
                        <td>Harga / Malam</td>
                        <td class="text-end">
                            Rp {{ number_format($reservasi->harga_per_malam ?? 0, 0, ',', '.') }}
                        </td>
                    </tr>

                    <tr>
                        <td>Subtotal</td>
                        <td class="text-end">
                            Rp
                            {{ number_format(($reservasi->harga_per_malam ?? 0) * ($reservasi->lama_menginap ?? 0), 0, ',', '.') }}
                        </td>
                    </tr>

                    @if (($reservasi->diskon_persen ?? 0) > 0)
                        <tr>
                            <td>Diskon ({{ $reservasi->diskon_persen }}%)</td>
                            <td class="text-end text-danger">
                                - Rp {{ number_format($reservasi->diskon_nominal ?? 0, 0, ',', '.') }}
                            </td>
                        </tr>
                    @endif

                    @if (($reservasi->pajak_persen ?? 0) > 0)
                        <tr>
                            <td>Pajak ({{ $reservasi->pajak_persen }}%)</td>
                            <td class="text-end">
                                Rp {{ number_format($reservasi->pajak_nominal ?? 0, 0, ',', '.') }}
                            </td>
                        </tr>
                    @endif

                    <tr class="table-dark fw-bold">
                        <td>Total</td>
                        <td class="text-end">
                            Rp {{ number_format($reservasi->total_harga ?? 0, 0, ',', '.') }}
                        </td>
                    </tr>
                </table>

                <hr>

                {{-- STATUS --}}
                <div class="d-flex gap-2 align-items-center">

                    <span class="badge bg-primary">
                        {{ ucfirst($reservasi->status_pembayaran) }}
                    </span>

                    @if ($reservasi->metode_pembayaran)
                        <span class="badge bg-light text-dark">
                            {{ strtoupper($reservasi->metode_pembayaran) }}
                        </span>
                    @endif

                </div>

                {{-- BARCODE --}}
                <div class="text-center mt-5">
                    <svg id="barcode"></svg>
                </div>

            </div>
        </div>
    </div>

    {{-- JS BARCODE --}}
    <script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.6/dist/JsBarcode.all.min.js"></script>
    <script>
        JsBarcode("#barcode", "{{ $reservasi->kode_reservasi }}", {
            format: "CODE128",
            width: 2,
            height: 70,
            displayValue: true
        });
    </script>
@endsection
