@extends('layouts.app')

@section('title', 'Edit Tipe Kamar Fasilitas')

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
            background: linear-gradient(135deg, #ffab00, #ff8f00);
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
                    <i class="bx bx-edit"></i>
                    Edit Tipe Kamar Fasilitas
                </h3>

                <p class="mb-0">
                    Update relasi fasilitas dan tipe kamar
                </p>

            </div>

            <div class="card-body p-5">

                <form action="{{ route('tipe-kamar-fasilitas.update', $tipeKamarFasilitas->id) }}" method="POST">

                    @csrf
                    @method('PUT')

                    <div class="mb-4">

                        <label class="form-label">
                            Tipe Kamar
                        </label>

                        <select name="id_tipe" class="form-select">

                            @foreach ($tipeKamar as $item)
                                <option value="{{ $item->id_tipe }}"
                                    {{ $item->id_tipe == $tipeKamarFasilitas->id_tipe ? 'selected' : '' }}>

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

                            @foreach ($fasilitas as $item)
                                <option value="{{ $item->id_fasilitas }}"
                                    {{ $item->id_fasilitas == $tipeKamarFasilitas->id_fasilitas ? 'selected' : '' }}>

                                    {{ $item->nama_fasilitas }}

                                </option>
                            @endforeach

                        </select>

                    </div>

                    <div class="d-flex gap-2">

                        <button class="btn btn-warning text-white">

                            <i class="bx bx-save"></i>
                            Update

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
