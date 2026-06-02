@extends('layouts.app')

@section('title', 'Edit Pembayaran')

@section('content')

    <style>
        .page-header {
            background: linear-gradient(135deg, #0d6efd, #4f8cff);
            color: white;
            border-radius: 18px;
            padding: 24px;
            margin-bottom: 24px;
        }

        .custom-card {
            border: none;
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, .08);
        }

        .custom-card .card-header {
            background: #fff;
            border-bottom: 1px solid #f1f1f1;
            padding: 18px 22px;
        }

        .custom-card .card-body {
            padding: 24px;
        }

        .form-label {
            font-weight: 600;
        }

        .form-control,
        .form-select {
            border-radius: 12px;
            min-height: 50px;
        }

        .upload-area {
            border: 2px dashed #d6e4ff;
            border-radius: 16px;
            padding: 24px;
            text-align: center;
            background: #fafcff;
        }

        .upload-area i {
            font-size: 42px;
            color: #0d6efd;
        }

        .preview-image {
            width: 100%;
            max-height: 350px;
            object-fit: contain;
            border-radius: 12px;
        }

        .btn-save {
            height: 58px;
            border-radius: 14px;
            font-weight: 600;
        }

        .info-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }
    </style>

    <div class="container-fluid py-4">

        {{-- Header --}}
        <div class="page-header d-flex justify-content-between align-items-center">

            <div>
                <h2 class="fw-bold mb-1">
                    <i class="bi bi-pencil-square me-2"></i>
                    Edit Pembayaran
                </h2>

                <p class="mb-0 opacity-75">
                    Update informasi transaksi pembayaran pelanggan
                </p>
            </div>

            <a href="{{ route('pembayaran.index') }}" class="btn btn-light fw-semibold">
                <i class="bi bi-arrow-left me-1"></i>
                Kembali
            </a>

        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('pembayaran.update', $pembayaran->id_pembayaran) }}" method="POST"
            enctype="multipart/form-data">

            @csrf
            @method('PUT')

            <div class="row g-4">

                {{-- Form --}}
                <div class="col-lg-7">

                    <div class="card custom-card">

                        <div class="card-header">
                            <h5 class="mb-0 fw-bold">
                                <i class="bi bi-wallet2 text-primary me-2"></i>
                                Informasi Pembayaran
                            </h5>
                        </div>

                        <div class="card-body">

                            {{-- Reservasi --}}
                            <div class="mb-4">
                                <label class="form-label">Reservasi</label>

                                <select name="id_reservasi" class="form-select @error('id_reservasi') is-invalid @enderror">

                                    @foreach ($reservasi as $r)
                                        <option value="{{ $r->id_reservasi }}"
                                            {{ old('id_reservasi', $pembayaran->id_reservasi) == $r->id_reservasi ? 'selected' : '' }}>
                                            {{ $r->kode_reservasi }}
                                            - {{ $r->pelanggan->nama ?? '-' }}
                                        </option>
                                    @endforeach

                                </select>

                                @error('id_reservasi')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="row">

                                {{-- Tanggal Bayar --}}
                                <div class="col-md-6 mb-4">

                                    <label class="form-label">
                                        Tanggal Bayar
                                    </label>

                                    <input type="date" name="tanggal_bayar"
                                        value="{{ old('tanggal_bayar', $pembayaran->tanggal_bayar ? \Carbon\Carbon::parse($pembayaran->tanggal_bayar)->format('Y-m-d') : '') }}"
                                        class="form-control @error('tanggal_bayar') is-invalid @enderror">

                                    @error('tanggal_bayar')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                </div>

                                {{-- Metode Pembayaran --}}
                                <div class="col-md-6 mb-4">

                                    <label class="form-label">
                                        Metode Pembayaran
                                    </label>

                                    <select name="metode_pembayaran"
                                        class="form-select @error('metode_pembayaran') is-invalid @enderror">

                                        <option value="cash"
                                            {{ old('metode_pembayaran', $pembayaran->metode_pembayaran) == 'cash' ? 'selected' : '' }}>
                                            Cash
                                        </option>

                                        <option value="transfer"
                                            {{ old('metode_pembayaran', $pembayaran->metode_pembayaran) == 'transfer' ? 'selected' : '' }}>
                                            Transfer Bank
                                        </option>

                                        <option value="credit_card"
                                            {{ old('metode_pembayaran', $pembayaran->metode_pembayaran) == 'credit_card' ? 'selected' : '' }}>
                                            Credit Card
                                        </option>

                                        <option value="e-wallet"
                                            {{ old('metode_pembayaran', $pembayaran->metode_pembayaran) == 'e-wallet' ? 'selected' : '' }}>
                                            E-Wallet
                                        </option>

                                    </select>

                                    @error('metode_pembayaran')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                </div>

                            </div>

                            {{-- Jumlah Bayar --}}
                            <div class="mb-4">

                                <label class="form-label">
                                    Jumlah Bayar
                                </label>

                                <div class="input-group">

                                    <span class="input-group-text">
                                        Rp
                                    </span>

                                    <input type="number" name="jumlah_bayar" min="0" step="0.01"
                                        value="{{ old('jumlah_bayar', $pembayaran->jumlah_bayar) }}"
                                        class="form-control @error('jumlah_bayar') is-invalid @enderror">

                                </div>

                                @error('jumlah_bayar')
                                    <div class="text-danger small mt-1">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                            {{-- Status Pembayaran --}}
                            <div class="mb-4">

                                <label class="form-label">
                                    Status Pembayaran
                                </label>

                                <select name="status_pembayaran"
                                    class="form-select @error('status_pembayaran') is-invalid @enderror">

                                    <option value="pending"
                                        {{ old('status_pembayaran', $pembayaran->status_pembayaran) == 'pending' ? 'selected' : '' }}>
                                        Pending
                                    </option>

                                    <option value="paid"
                                        {{ old('status_pembayaran', $pembayaran->status_pembayaran) == 'paid' ? 'selected' : '' }}>
                                        Lunas
                                    </option>

                                    <option value="refund"
                                        {{ old('status_pembayaran', $pembayaran->status_pembayaran) == 'refund' ? 'selected' : '' }}>
                                        Refund
                                    </option>

                                </select>

                                @error('status_pembayaran')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                        </div>

                    </div>

                </div>

                {{-- Sidebar --}}
                <div class="col-lg-5">

                    <div class="card custom-card mb-4">

                        <div class="card-header">
                            <h5 class="mb-0 fw-bold">
                                <i class="bi bi-info-circle text-success me-2"></i>
                                Ringkasan
                            </h5>
                        </div>

                        <div class="card-body">

                            <div class="info-item">
                                <span class="text-muted">ID Pembayaran</span>
                                <strong>#{{ $pembayaran->id_pembayaran }}</strong>
                            </div>

                            <div class="info-item">
                                <span class="text-muted">Status</span>

                                <span class="badge bg-primary">
                                    {{ ucfirst($pembayaran->status_pembayaran) }}
                                </span>
                            </div>

                        </div>

                    </div>

                    {{-- Bukti Pembayaran --}}
                    <div class="card custom-card">

                        <div class="card-header">
                            <h5 class="mb-0 fw-bold">
                                <i class="bi bi-image text-primary me-2"></i>
                                Bukti Pembayaran
                            </h5>
                        </div>

                        <div class="card-body">

                            <div class="upload-area">

                                <i class="bi bi-cloud-arrow-up"></i>

                                <p class="fw-semibold mt-3 mb-2">
                                    Upload Bukti Baru
                                </p>

                                <input type="file" name="bukti_pembayaran" accept=".jpg,.jpeg,.png,image/*"
                                    class="form-control @error('bukti_pembayaran') is-invalid @enderror">

                                @error('bukti_pembayaran')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                                <small class="text-muted">
                                    JPG, JPEG, PNG (Maksimal 2 MB)
                                </small>

                            </div>

                            @if ($pembayaran->bukti_pembayaran)
                                <div class="mt-4">

                                    <label class="form-label">
                                        Bukti Saat Ini
                                    </label>

                                    <div class="border rounded-4 p-3 bg-light">

                                        <img src="{{ asset('storage/' . $pembayaran->bukti_pembayaran) }}"
                                            class="preview-image" alt="Bukti Pembayaran">

                                    </div>

                                </div>
                            @endif

                        </div>

                    </div>

                    <div class="mt-4">

                        <button type="submit" class="btn btn-primary btn-save w-100">

                            <i class="bi bi-check-circle-fill me-2"></i>
                            Simpan Perubahan

                        </button>

                    </div>

                </div>

            </div>

        </form>

    </div>

@endsection
