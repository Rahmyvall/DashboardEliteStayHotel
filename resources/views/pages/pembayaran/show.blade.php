@extends('layouts.app')

@section('title', 'Detail Pembayaran')

@section('content')

    <style>
        .invoice-wrapper {
            max-width: 900px;
            margin: auto;
        }

        .invoice-card {
            border: none;
            border-radius: 18px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, .08);
            overflow: hidden;
        }

        .invoice-header {
            background: linear-gradient(135deg, #0d6efd, #4f8cff);
            color: white;
            padding: 25px;
        }

        .invoice-title {
            font-size: 28px;
            font-weight: 700;
        }

        .info-table th {
            width: 250px;
            background: #f8f9fa;
            font-weight: 600;
        }

        .total-box {
            background: #f8fff9;
            border: 1px solid #d1f5d8;
            border-radius: 15px;
            padding: 20px;
            text-align: center;
        }

        .total-box h2 {
            color: #198754;
            font-weight: 700;
            margin: 0;
        }

        .payment-proof {
            width: 100%;
            max-height: 350px;
            object-fit: contain;
            border-radius: 10px;
            border: 1px solid #dee2e6;
        }

        /* PRINT */
        @media print {

            @page {
                size: A4 portrait;
                margin: 10mm;
            }

            .no-print,
            .navbar,
            .sidebar,
            footer {
                display: none !important;
            }

            body {
                background: #fff !important;
            }

            .invoice-card {
                box-shadow: none !important;
                border: 1px solid #000 !important;
            }

            .invoice-header {
                background: #fff !important;
                color: #000 !important;
                border-bottom: 2px solid #000;
            }

            .payment-proof {
                max-height: 180px;
            }

            table td,
            table th {
                padding: 6px !important;
                font-size: 12px;
            }

            .total-box {
                border: 1px solid #000;
            }
        }
    </style>

    <div class="container-fluid py-4">

        {{-- BUTTON --}}
        <div class="d-flex justify-content-end gap-2 mb-3 no-print">

            <button onclick="window.print()" class="btn btn-primary">
                <i class="bi bi-printer"></i>
                Cetak
            </button>

            <a href="{{ route('pembayaran.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i>
                Kembali
            </a>

        </div>

        <div class="invoice-wrapper">

            <div class="card invoice-card">

                {{-- HEADER --}}
                <div class="invoice-header">

                    <div class="row">

                        <div class="col-8">
                            <h2 class="invoice-title">
                                INVOICE PEMBAYARAN
                            </h2>

                            <small>
                                Sistem Reservasi Hotel
                            </small>
                        </div>

                        <div class="col-4 text-end">

                            <strong>
                                Invoice #
                                {{ $pembayaran->id_pembayaran }}
                            </strong>

                            <br>

                            <small>
                                {{ \Carbon\Carbon::parse($pembayaran->tanggal_bayar)->format('d M Y') }}
                            </small>

                        </div>

                    </div>

                </div>

                {{-- BODY --}}
                <div class="card-body p-4">

                    <table class="table table-bordered info-table">

                        <tr>
                            <th>Kode Reservasi</th>
                            <td>
                                {{ $pembayaran->reservasi->kode_reservasi ?? '-' }}
                            </td>
                        </tr>

                        <tr>
                            <th>Tanggal Pembayaran</th>
                            <td>
                                {{ \Carbon\Carbon::parse($pembayaran->tanggal_bayar)->format('d F Y H:i') }}
                            </td>
                        </tr>

                        <tr>
                            <th>Metode Pembayaran</th>
                            <td>
                                {{ ucfirst($pembayaran->metode_pembayaran) }}
                            </td>
                        </tr>

                        <tr>
                            <th>Status Pembayaran</th>
                            <td>
                                {{ strtoupper($pembayaran->status_pembayaran) }}
                            </td>
                        </tr>

                    </table>

                    {{-- TOTAL --}}
                    <div class="total-box my-4">

                        <small>Total Pembayaran</small>

                        <h2>
                            Rp {{ number_format($pembayaran->jumlah_bayar, 0, ',', '.') }}
                        </h2>

                    </div>

                    {{-- BUKTI --}}
                    @if ($pembayaran->bukti_pembayaran)
                        <h5 class="fw-bold mb-3">
                            Bukti Pembayaran
                        </h5>

                        <div class="text-center">

                            <img src="{{ asset('storage/' . $pembayaran->bukti_pembayaran) }}" class="payment-proof"
                                alt="Bukti Pembayaran">

                        </div>
                    @endif

                    {{-- TTD --}}
                    <div class="row mt-5">

                        <div class="col-6 text-center">

                            Mengetahui,

                            <br><br><br>

                            __________________

                        </div>

                        <div class="col-6 text-center">

                            Penerima,

                            <br><br><br>

                            __________________

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection

@push('scripts')
    <script>
        const params = new URLSearchParams(window.location.search);

        if (params.get('print') === '1') {
            window.onload = () => {
                setTimeout(() => {
                    window.print();
                }, 500);
            };
        }
    </script>
@endpush
