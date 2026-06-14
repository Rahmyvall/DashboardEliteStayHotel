@extends('layouts.app')

@section('title', 'Proses Check Out')

@section('content')

    <div class="container-fluid">

        {{-- Header --}}
        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>
                <h2 class="fw-bold mb-1">
                    Proses Check Out
                </h2>

                <p class="text-muted mb-0">
                    Lengkapi data check out tamu
                </p>
            </div>

            <a href="{{ route('checkin-checkout.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-1"></i>
                Kembali
            </a>

        </div>

        <div class="row g-4">

            {{-- Informasi Tamu --}}
            <div class="col-lg-4">

                <div class="card border-0 shadow-sm">

                    <div class="card-header bg-primary text-white">
                        <h6 class="mb-0">
                            <i class="fas fa-user me-2"></i>
                            Informasi Tamu
                        </h6>
                    </div>

                    <div class="card-body">

                        <div class="mb-3">
                            <small class="text-muted">
                                Nama Tamu
                            </small>

                            <div class="fw-bold">
                                {{ $checkin->reservasi?->pelanggan?->nama_lengkap ?? '-' }}
                            </div>
                        </div>

                        <div class="mb-3">
                            <small class="text-muted">
                                Kode Reservasi
                            </small>

                            <div class="fw-bold">
                                {{ $checkin->reservasi?->kode_reservasi ?? '-' }}
                            </div>
                        </div>

                        <div class="mb-3">
                            <small class="text-muted">
                                Nomor Kamar
                            </small>

                            <div class="fw-bold">
                                {{ $checkin->reservasi?->kamar?->nomor_kamar ?? '-' }}
                            </div>
                        </div>

                        <div class="mb-3">
                            <small class="text-muted">
                                Tipe Kamar
                            </small>

                            <div class="fw-bold">
                                {{ $checkin->reservasi?->kamar?->tipeKamar?->nama_tipe ?? '-' }}
                            </div>
                        </div>

                        <div class="mb-3">
                            <small class="text-muted">
                                Check In Aktual
                            </small>

                            <div class="fw-bold text-success">
                                {{ optional($checkin->waktu_checkin_aktual)->format('d M Y H:i') }}
                            </div>
                        </div>

                        <div>
                            <small class="text-muted">
                                Deposit
                            </small>

                            <div class="fw-bold text-primary fs-5">
                                Rp {{ number_format($checkin->deposit ?? 0, 0, ',', '.') }}
                            </div>
                        </div>

                    </div>

                </div>

            </div>

            {{-- Form Checkout --}}
            <div class="col-lg-8">

                <div class="card border-0 shadow-sm">

                    <div class="card-header bg-warning">
                        <h5 class="mb-0">
                            <i class="fas fa-sign-out-alt me-2"></i>
                            Form Check Out
                        </h5>
                    </div>

                    <div class="card-body">

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('checkin-checkout.update', $checkin->id_check) }}" method="POST">

                            @csrf
                            @method('PUT')

                            <div class="row">

                                {{-- Biaya Tambahan --}}
                                <div class="col-md-6 mb-3">

                                    <label class="form-label fw-semibold">
                                        Biaya Tambahan
                                    </label>

                                    <div class="input-group">
                                        <span class="input-group-text">
                                            Rp
                                        </span>

                                        <input type="number" min="0" name="biaya_tambahan"
                                            value="{{ old('biaya_tambahan', 0) }}" class="form-control">
                                    </div>

                                </div>

                                {{-- Kondisi Kamar --}}
                                <div class="col-md-6 mb-3">

                                    <label class="form-label fw-semibold">
                                        Kondisi Kamar
                                    </label>

                                    <select name="kondisi_kamar" class="form-select">

                                        <option value="">
                                            Pilih Kondisi
                                        </option>

                                        <option value="baik">
                                            Baik
                                        </option>

                                        <option value="kotor">
                                            Kotor
                                        </option>

                                        <option value="rusak_ringan">
                                            Rusak Ringan
                                        </option>

                                        <option value="rusak_berat">
                                            Rusak Berat
                                        </option>

                                    </select>

                                </div>

                                {{-- Late Checkout --}}
                                <div class="col-md-12 mb-3">

                                    <div class="form-check form-switch">

                                        <input class="form-check-input" type="checkbox" id="is_late_checkout"
                                            name="is_late_checkout" value="1">

                                        <label class="form-check-label" for="is_late_checkout">

                                            Late Checkout

                                        </label>

                                    </div>

                                </div>

                                {{-- Denda --}}
                                <div class="col-md-6 mb-3">

                                    <label class="form-label fw-semibold">
                                        Denda Late Checkout
                                    </label>

                                    <div class="input-group">

                                        <span class="input-group-text">
                                            Rp
                                        </span>

                                        <input type="number" min="0" name="denda_late_checkout"
                                            value="{{ old('denda_late_checkout', 0) }}" class="form-control">

                                    </div>

                                </div>

                                {{-- Total Estimasi --}}
                                <div class="col-md-6 mb-3">

                                    <label class="form-label fw-semibold">
                                        Deposit Saat Ini
                                    </label>

                                    <input type="text" readonly class="form-control bg-light"
                                        value="Rp {{ number_format($checkin->deposit ?? 0, 0, ',', '.') }}">

                                </div>

                                {{-- Catatan --}}
                                <div class="col-md-12 mb-4">

                                    <label class="form-label fw-semibold">
                                        Catatan Check Out
                                    </label>

                                    <textarea name="catatan_checkout" rows="4" class="form-control" placeholder="Masukkan catatan check out...">{{ old('catatan_checkout') }}</textarea>

                                </div>

                            </div>

                            <div class="d-flex justify-content-end gap-2">

                                <a href="{{ route('checkin-checkout.index') }}" class="btn btn-light border">
                                    Batal
                                </a>

                                <button type="submit" class="btn btn-success">

                                    <i class="fas fa-check-circle me-1"></i>

                                    Proses Check Out

                                </button>

                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection
