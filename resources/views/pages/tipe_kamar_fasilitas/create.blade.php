@extends('layouts.app')

@section('title', 'Tambah Tipe Kamar Fasilitas')

@section('content')

    <style>
        body {
            background: #f5f7fb;
        }

        .modern-card {
            border: none;
            border-radius: 22px;
            overflow: hidden;
            background: #ffffff;
        }

        .modern-header {
            background: linear-gradient(135deg, #696cff, #5f61e6);
            padding: 30px;
            color: white;
        }

        .modern-header h3,
        .modern-header p {
            color: white !important;
        }

        .form-control,
        .form-select {
            height: 52px;
            border-radius: 14px;
            border: 1px solid #dfe3ea;
            color: #111827 !important;
            background: #fff !important;
        }

        .form-label {
            font-weight: 700;
            color: #374151;
            margin-bottom: 10px;
        }

        .btn {
            border-radius: 14px;
            padding: 12px 22px;
            font-weight: 600;
        }
    </style>

    <div class="container-p-y">

        <div class="card modern-card shadow-lg">

            <div class="modern-header">

                <h3 class="fw-bold mb-1">
                    <i class="bx bx-plus-circle"></i>
                    Tambah Tipe Kamar Fasilitas
                </h3>

                <p class="mb-0">
                    Tambahkan relasi fasilitas untuk tipe kamar hotel
                </p>

            </div>

            <div class="card-body p-5">

                <form action="{{ route('tipe-kamar-fasilitas.store') }}" method="POST">

                    @csrf

                    <div class="mb-4">

                        <label class="form-label">
                            Tipe Kamar
                        </label>

                        <select name="id_tipe" class="form-select">

                            <option value="">
                                -- Pilih Tipe Kamar --
                            </option>

                            @foreach ($tipeKamar as $item)
                                <option value="{{ $item->id_tipe }}">
                                    {{ $item->nama_tipe }}
                                </option>
                            @endforeach

                        </select>

                    </div>

                    <div class="mb-4">

                        <label class="form-label">
                            Fasilitas
                        </label>

                        <select name="id_fasilitas" class="form-select">

                            <option value="">
                                -- Pilih Fasilitas --
                            </option>

                            @foreach ($fasilitas as $item)
                                <option value="{{ $item->id_fasilitas }}">
                                    {{ $item->nama_fasilitas }}
                                </option>
                            @endforeach

                        </select>

                    </div>

                    <div class="d-flex gap-2">

                        <button class="btn btn-primary">

                            <i class="bx bx-save"></i>
                            Simpan

                        </button>

                        <a href="{{ route('tipe-kamar-fasilitas.index') }}" class="btn btn-light border">

                            Kembali

                        </a>

                    </div>

                </form>

            </div>

        </div>

    </div>

@endsection
