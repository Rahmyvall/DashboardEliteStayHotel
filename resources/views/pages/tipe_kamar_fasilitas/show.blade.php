@extends('layouts.app')

@section('title', 'Detail Tipe Kamar Fasilitas')

@section('content')

    <style>
        body {
            background: #f5f7fb;
        }

        .detail-card {
            border: none;
            border-radius: 22px;
            overflow: hidden;
            background: #fff;
        }

        .detail-header {
            background: linear-gradient(135deg, #03c3ec, #0099c6);
            padding: 35px;
            color: white;
        }

        .detail-header h3,
        .detail-header p {
            color: white !important;
        }

        .detail-item {
            padding: 22px;
            border-radius: 16px;
            background: #f9fafb;
            margin-bottom: 20px;
        }

        .detail-label {
            font-size: 14px;
            color: #6b7280;
            margin-bottom: 8px;
        }

        .detail-value {
            font-size: 18px;
            font-weight: 700;
            color: #111827;
        }
    </style>

    <div class="container-p-y">

        <div class="card detail-card shadow-lg">

            <div class="detail-header">

                <h3 class="fw-bold mb-1">
                    <i class="bx bx-show-alt"></i>
                    Detail Tipe Kamar Fasilitas
                </h3>

                <p class="mb-0">
                    Informasi lengkap relasi fasilitas dan tipe kamar
                </p>

            </div>

            <div class="card-body p-5">

                <div class="detail-item">

                    <div class="detail-label">
                        Nama Tipe Kamar
                    </div>

                    <div class="detail-value">
                        {{ $tipeKamarFasilitas->tipeKamar->nama_tipe }}
                    </div>

                </div>

                <div class="detail-item">

                    <div class="detail-label">
                        Nama Fasilitas
                    </div>

                    <div class="detail-value">
                        {{ $tipeKamarFasilitas->fasilitas->nama_fasilitas }}
                    </div>

                </div>

                <div class="detail-item">

                    <div class="detail-label">
                        Dibuat Pada
                    </div>

                    <div class="detail-value">
                        {{ $tipeKamarFasilitas->created_at->format('d M Y H:i') }}
                    </div>

                </div>

                <div class="mt-4">

                    <a href="{{ route('tipe-kamar-fasilitas.index') }}" class="btn btn-secondary rounded-pill px-4">

                        <i class="bx bx-arrow-back"></i>
                        Kembali

                    </a>

                </div>

            </div>

        </div>

    </div>

@endsection
