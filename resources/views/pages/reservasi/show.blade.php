@extends('layouts.app')

@section('content')
    <style>
        @media print {
            .no-print {
                display: none !important;
            }

            body {
                background: #fff !important;
                font-family: "Courier New", monospace;
            }

            .invoice-box {
                box-shadow: none !important;
                border: none !important;
                width: 100%;
            }
        }

        .invoice-box {
            max-width: 780px;
            margin: auto;
            background: #fff;
            border: 1px solid #eee;
            padding: 30px;
            border-radius: 10px;
        }

        .hotel-name {
            text-align: center;
            font-weight: 800;
            font-size: 22px;
            letter-spacing: 2px;
        }

        .hotel-sub {
            text-align: center;
            font-size: 12px;
            color: #777;
        }

        .divider {
            border-top: 1px dashed #ccc;
            margin: 10px 0;
        }

        .section-title {
            font-size: 12px;
            font-weight: 700;
            margin-top: 18px;
            margin-bottom: 6px;
            color: #333;
            border-bottom: 1px dashed #ddd;
            padding-bottom: 4px;
        }

        .info-line {
            font-size: 13px;
            margin-bottom: 4px;
            color: #444;
        }

        .total-box {
            font-weight: 800;
            font-size: 15px;
        }

        .text-right {
            text-align: right;
        }

        .badge-status {
            padding: 4px 10px;
            font-size: 12px;
            border-radius: 20px;
            background: #f1f1f1;
            display: inline-block;
        }

        .header-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
    </style>

    @php
        use Carbon\Carbon;

        $checkIn = $reservasi->check_in ? Carbon::parse($reservasi->check_in) : null;
        $checkOut = $reservasi->check_out ? Carbon::parse($reservasi->check_out) : null;

        $lama = $checkIn && $checkOut ? $checkIn->diffInDays($checkOut) : 0;

        $harga = $reservasi->harga_per_malam ?? 0;
        $subtotal = $harga * $lama;

        $diskon = $reservasi->diskon_nominal ?? 0;
        $total = $reservasi->total_harga ?? $subtotal - $diskon;
    @endphp

    <div class="container py-4">

        {{-- HEADER --}}
        <div class="no-print header-top mb-3">
            <div>
                <h4 class="mb-0">Detail Reservasi</h4>
                <small class="text-muted">Invoice & Struk Hotel</small>
            </div>

            <div>
                <a href="{{ route('reservasi.edit', $reservasi->id_reservasi) }}" class="btn btn-warning btn-sm">Edit</a>
                <button onclick="window.print()" class="btn btn-dark btn-sm">Print</button>
            </div>
        </div>

        {{-- INVOICE --}}
        <div class="invoice-box shadow-sm">

            {{-- HOTEL HEADER --}}
            <div class="hotel-name">HOTEL PREMIUM</div>
            <div class="hotel-sub">Jl. Example No.1 • Telp: 0812-xxxx-xxxx</div>

            <div class="divider"></div>

            {{-- RESERVATION --}}
            <div class="info-line">
                <b>Kode:</b> {{ $reservasi->kode_reservasi }}
            </div>

            <div class="info-line">
                <b>Status:</b>
                <span class="badge-status">
                    {{ strtoupper($reservasi->status_reservasi) }}
                </span>
            </div>

            <div class="divider"></div>

            {{-- GUEST --}}
            <div class="section-title">DATA TAMU</div>

            <div class="info-line">
                {{ $reservasi->pelanggan->user->nama_lengkap ?? '-' }}
            </div>

            <div class="info-line">
                {{ $reservasi->pelanggan->user->email ?? '-' }}
            </div>

            {{-- ROOM --}}
            <div class="section-title">DETAIL KAMAR</div>

            <div class="info-line">
                Kamar: {{ $reservasi->kamar->nomor_kamar ?? '-' }}
            </div>

            <div class="info-line">
                Check In: {{ $checkIn?->format('d M Y') ?? '-' }}
            </div>

            <div class="info-line">
                Check Out: {{ $checkOut?->format('d M Y') ?? '-' }}
            </div>

            <div class="info-line">
                Lama Menginap: {{ $lama }} malam
            </div>

            <div class="info-line">
                Tamu: {{ $reservasi->jumlah_dewasa ?? 0 }} dewasa,
                {{ $reservasi->jumlah_anak ?? 0 }} anak
            </div>

            {{-- PAYMENT --}}
            <div class="section-title">RINCIAN PEMBAYARAN</div>

            <table width="100%">
                <tr>
                    <td>Harga / Malam</td>
                    <td class="text-right">Rp {{ number_format($harga, 0, ',', '.') }}</td>
                </tr>

                <tr>
                    <td>Subtotal</td>
                    <td class="text-right">Rp {{ number_format($subtotal, 0, ',', '.') }}</td>
                </tr>

                <tr>
                    <td>Diskon</td>
                    <td class="text-right text-danger">
                        - Rp {{ number_format($diskon, 0, ',', '.') }}
                    </td>
                </tr>
            </table>

            <div class="divider"></div>

            <table width="100%">
                <tr class="total-box">
                    <td>TOTAL</td>
                    <td class="text-right">
                        Rp {{ number_format($total, 0, ',', '.') }}
                    </td>
                </tr>
            </table>

            <div class="divider"></div>

            {{-- PAYMENT INFO --}}
            <div class="info-line">
                Status Bayar: {{ strtoupper($reservasi->status_pembayaran) }}
            </div>

            <div class="info-line">
                Metode: {{ strtoupper($reservasi->metode_pembayaran ?? '-') }}
            </div>

            {{-- NOTE --}}
            @if ($reservasi->catatan)
                <div class="section-title">CATATAN</div>
                <div class="info-line">
                    {{ $reservasi->catatan }}
                </div>
            @endif

            <div class="divider"></div>

            {{-- BARCODE --}}
            <div class="text-center">
                <svg id="barcode"></svg>
            </div>

            <div class="hotel-sub mt-2">
                Terima kasih telah menginap di Hotel Premium
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.6/dist/JsBarcode.all.min.js"></script>
    <script>
        JsBarcode("#barcode", "{{ $reservasi->kode_reservasi }}", {
            format: "CODE128",
            width: 2,
            height: 50,
            displayValue: true
        });
    </script>
@endsection
