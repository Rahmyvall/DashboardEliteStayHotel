@extends('layouts.app')

@section('title', 'Tambah Pembayaran')

@section('content')

    <style>
        .page-header {
            background: linear-gradient(135deg, #8eaedf, #e8eef8);
            color: white;
            border-radius: 18px;
            padding: 24px;
            margin-bottom: 24px;
        }

        .custom-card {
            border: none;
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 8px 25px rgba(0, 0, 0, .08);
            transition: .3s;
        }

        .custom-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 30px rgba(0, 0, 0, .12);
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
            margin-bottom: 8px;
        }

        .form-control,
        .form-select {
            border-radius: 12px;
            padding: 12px 14px;
        }

        .form-control:focus,
        .form-select:focus {
            box-shadow: 0 0 0 .25rem rgba(13, 110, 253, .15);
            border-color: #0d6efd;
        }

        .upload-box {
            border: 2px dashed #dbe4ff;
            border-radius: 15px;
            padding: 25px;
            text-align: center;
            background: #fafcff;
        }

        .upload-box i {
            font-size: 40px;
            color: #0d6efd;
        }

        #preview-image {
            width: 100%;
            max-height: 300px;
            object-fit: cover;
            border-radius: 15px;
        }

        .btn-save {
            height: 55px;
            border-radius: 14px;
            font-weight: 600;
            font-size: 15px;
        }

        .summary-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }
    </style>

    <div class="container-fluid py-4">

        <!-- HEADER -->
        <div class="page-header d-flex justify-content-between align-items-center">
            <div>
                <h2 class="fw-bold mb-1">
                    <i class="bi bi-credit-card-2-front-fill me-2"></i>
                    Tambah Pembayaran
                </h2>
                <p class="mb-0 opacity-75">
                    Input transaksi pembayaran reservasi pelanggan
                </p>
            </div>

            <a href="{{ route('pembayaran.index') }}" class="btn btn-light fw-semibold">
                <i class="bi bi-arrow-left me-1"></i>
                Kembali
            </a>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger rounded-4">
                <strong>Terjadi Kesalahan!</strong>
                <ul class="mb-0 mt-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('pembayaran.store') }}" method="POST" enctype="multipart/form-data">

            @csrf

            <div class="row g-4">

                <!-- FORM -->
                <div class="col-lg-8">

                    <div class="card custom-card">

                        <div class="card-header">
                            <h5 class="mb-0 fw-bold">
                                <i class="bi bi-wallet2 text-primary me-2"></i>
                                Informasi Pembayaran
                            </h5>
                        </div>

                        <div class="card-body">

                            <div class="mb-4">
                                <label class="form-label">
                                    Reservasi
                                </label>

                                <select name="id_reservasi" class="form-select @error('id_reservasi') is-invalid @enderror"
                                    required>

                                    <option value="">
                                        Pilih Reservasi
                                    </option>

                                    @foreach ($reservasi as $r)
                                        <option value="{{ $r->id_reservasi }}"
                                            {{ old('id_reservasi') == $r->id_reservasi ? 'selected' : '' }}>

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

                                <div class="col-md-6 mb-4">
                                    <label class="form-label">
                                        Tanggal Bayar
                                    </label>

                                    <input type="date" name="tanggal_bayar" value="{{ old('tanggal_bayar') }}"
                                        class="form-control">
                                </div>

                                <div class="col-md-6 mb-4">
                                    <label class="form-label">
                                        Metode Pembayaran
                                    </label>

                                    <select name="metode_pembayaran" class="form-select" required>

                                        <option value="cash">Cash</option>
                                        <option value="transfer">Transfer Bank</option>
                                        <option value="credit_card">Credit Card</option>
                                        <option value="e-wallet">E-Wallet</option>

                                    </select>
                                </div>

                            </div>

                            <div class="mb-4">

                                <label class="form-label">
                                    Jumlah Bayar
                                </label>

                                <div class="input-group">

                                    <span class="input-group-text fw-bold">
                                        Rp
                                    </span>

                                    <input type="number" name="jumlah_bayar" value="{{ old('jumlah_bayar') }}"
                                        class="form-control" placeholder="Masukkan nominal pembayaran" required>

                                </div>

                            </div>

                            <div class="mb-2">

                                <label class="form-label">
                                    Status Pembayaran
                                </label>

                                <select name="status_pembayaran" class="form-select">

                                    <option value="pending">
                                        Pending
                                    </option>

                                    <option value="paid">
                                        Paid
                                    </option>

                                    <option value="refund">
                                        Refund
                                    </option>

                                </select>

                                <small class="text-muted">
                                    Sesuaikan dengan status transaksi saat ini.
                                </small>

                            </div>

                        </div>

                    </div>

                </div>

                <!-- SIDEBAR -->
                <div class="col-lg-4">

                    <div class="card custom-card mb-4">

                        <div class="card-header">
                            <h5 class="mb-0 fw-bold">
                                <i class="bi bi-receipt text-success me-2"></i>
                                Ringkasan
                            </h5>
                        </div>

                        <div class="card-body">

                            <div class="summary-item">
                                <span class="text-muted">Status</span>
                                <span class="badge bg-warning">
                                    Pending
                                </span>
                            </div>

                            <div class="summary-item">
                                <span class="text-muted">Upload Bukti</span>
                                <span>Opsional</span>
                            </div>

                        </div>

                    </div>

                    <div class="card custom-card">

                        <div class="card-header">
                            <h5 class="mb-0 fw-bold">
                                <i class="bi bi-image text-primary me-2"></i>
                                Bukti Pembayaran
                            </h5>
                        </div>

                        <div class="card-body">

                            <div class="upload-box">

                                <i class="bi bi-cloud-arrow-up"></i>

                                <p class="mt-3 mb-2 fw-semibold">
                                    Upload Bukti Pembayaran
                                </p>

                                <input type="file" name="bukti_pembayaran" id="bukti_pembayaran" class="form-control"
                                    accept="image/*">

                                <small class="text-muted">
                                    JPG / PNG (Maks. 2 MB)
                                </small>

                            </div>

                            <div id="preview-wrapper" class="mt-4 d-none">

                                <img id="preview-image" alt="Preview Bukti Pembayaran">

                            </div>

                        </div>

                    </div>

                    <div class="mt-4">

                        <button type="submit" class="btn btn-primary btn-save w-100">

                            <i class="bi bi-check-circle-fill me-2"></i>
                            Simpan Pembayaran

                        </button>

                    </div>

                </div>

            </div>

        </form>
        ```

    </div>
@endsection

@push('scripts')
    <script>
        document.getElementById('bukti_pembayaran')
            .addEventListener('change', function() {

                const file = this.files[0];

                if (!file) return;

                const reader = new FileReader();

                reader.onload = function(e) {

                    document.getElementById('preview-image').src =
                        e.target.result;

                    document.getElementById('preview-wrapper')
                        .classList.remove('d-none');
                };

                reader.readAsDataURL(file);
            });
    </script>
@endpush
