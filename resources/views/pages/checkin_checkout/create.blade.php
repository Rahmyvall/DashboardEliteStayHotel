@extends('layouts.app')

@section('title', 'Check In Tamu')

@section('content')

    <div class="container-fluid">

        <div class="row justify-content-center">
            <div class="col-lg-12">

                {{-- Header --}}
                <div class="d-flex align-items-center mb-4">
                    <div>
                        <h3 class="fw-bold mb-1">
                            <i class="fas fa-door-open text-primary me-2"></i>
                            Check In Tamu
                        </h3>
                        <small class="text-muted">
                            Proses check in berdasarkan reservasi yang telah dikonfirmasi
                        </small>
                    </div>
                </div>

                {{-- Error --}}
                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('checkin-checkout.store') }}" method="POST">
                    @csrf

                    <div class="card border-0 shadow-sm">

                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0">
                                Informasi Check In
                            </h5>
                        </div>

                        <div class="card-body">

                            {{-- Reservasi --}}
                            <div class="mb-4">
                                <label class="form-label fw-bold">
                                    Reservasi
                                    <span class="text-danger">*</span>
                                </label>

                                <select name="id_reservasi" id="id_reservasi"
                                    class="form-select @error('id_reservasi') is-invalid @enderror" required>

                                    <option value="">
                                        -- Pilih Reservasi --
                                    </option>

                                    @foreach ($reservasi as $item)
                                        <option value="{{ $item->id_reservasi }}"
                                            data-checkin="{{ $item->tanggal_checkin }}"
                                            data-checkout="{{ $item->tanggal_checkout }}"
                                            data-pelanggan="{{ $item->pelanggan->nama_lengkap ?? '-' }}"
                                            data-kamar="{{ $item->kamar->nomor_kamar ?? '-' }}"
                                            {{ old('id_reservasi') == $item->id_reservasi ? 'selected' : '' }}>

                                            {{ $item->kode_reservasi }}
                                            -
                                            {{ $item->pelanggan->nama_lengkap ?? '-' }}
                                            -
                                            Kamar {{ $item->kamar->nomor_kamar ?? '-' }}

                                        </option>
                                    @endforeach

                                </select>

                                @error('id_reservasi')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            {{-- Preview Reservasi --}}
                            <div class="card bg-light border-0 mb-4">
                                <div class="card-body">

                                    <div class="row">

                                        <div class="col-md-6 mb-3">
                                            <label class="text-muted small">
                                                Nama Tamu
                                            </label>

                                            <div id="preview_pelanggan" class="fw-bold">
                                                -
                                            </div>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="text-muted small">
                                                Nomor Kamar
                                            </label>

                                            <div id="preview_kamar" class="fw-bold">
                                                -
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="text-muted small">
                                                Jadwal Check In
                                            </label>

                                            <div id="preview_checkin" class="fw-bold text-success">
                                                -
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="text-muted small">
                                                Jadwal Check Out
                                            </label>

                                            <div id="preview_checkout" class="fw-bold text-danger">
                                                -
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>

                            <div class="row">

                                {{-- Jumlah Tamu --}}
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">
                                        Jumlah Tamu Aktual
                                    </label>

                                    <input type="number" min="1" name="jumlah_tamu_aktual"
                                        value="{{ old('jumlah_tamu_aktual', 1) }}"
                                        class="form-control @error('jumlah_tamu_aktual') is-invalid @enderror">

                                    @error('jumlah_tamu_aktual')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                {{-- Deposit --}}
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">
                                        Deposit
                                    </label>

                                    <div class="input-group">
                                        <span class="input-group-text">
                                            Rp
                                        </span>

                                        <input type="number" min="0" name="deposit" value="{{ old('deposit', 0) }}"
                                            class="form-control @error('deposit') is-invalid @enderror">
                                    </div>

                                    @error('deposit')
                                        <div class="text-danger small">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                            </div>

                            {{-- Catatan --}}
                            <div class="mb-3">
                                <label class="form-label fw-bold">
                                    Catatan Check In
                                </label>

                                <textarea name="catatan_checkin" rows="4" class="form-control @error('catatan_checkin') is-invalid @enderror"
                                    placeholder="Catatan tambahan saat proses check in">{{ old('catatan_checkin') }}</textarea>

                                @error('catatan_checkin')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                        </div>

                        <div class="card-footer bg-white">

                            <div class="d-flex justify-content-between">

                                <a href="{{ route('checkin-checkout.index') }}" class="btn btn-outline-secondary">

                                    <i class="fas fa-arrow-left me-1"></i>
                                    Kembali

                                </a>

                                <button type="submit" class="btn btn-success">

                                    <i class="fas fa-check-circle me-1"></i>
                                    Proses Check In

                                </button>

                            </div>

                        </div>

                    </div>

                </form>

            </div>
        </div>

    </div>
@endsection

@push('scripts')
    <script>
        const reservasiSelect = document.getElementById('id_reservasi');

        reservasiSelect.addEventListener('change', function() {

            const selected =
                this.options[this.selectedIndex];

            document.getElementById('preview_pelanggan').innerText =
                selected.dataset.pelanggan || '-';

            document.getElementById('preview_kamar').innerText =
                selected.dataset.kamar || '-';

            document.getElementById('preview_checkin').innerText =
                selected.dataset.checkin || '-';

            document.getElementById('preview_checkout').innerText =
                selected.dataset.checkout || '-';

        });
    </script>
@endpush
