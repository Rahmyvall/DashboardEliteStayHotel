@extends('layouts.app')

@section('content')
    <div class="container-fluid py-4">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-bold">🏨 Edit Reservasi</h2>
                <small class="text-muted">Update Data Reservasi</small>
            </div>

            <a href="{{ route('reservasi.index') }}" class="btn btn-outline-secondary">
                ← Kembali
            </a>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $e)
                        <li>{{ $e }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('reservasi.update', $reservasi->id_reservasi) }}" method="POST">

            @csrf
            @method('PUT')

            <div class="row">

                {{-- LEFT --}}
                <div class="col-lg-8">

                    <div class="card shadow-sm border-0 mb-3">
                        <div class="card-body">

                            <h5 class="fw-bold mb-3">
                                Data Reservasi
                            </h5>

                            <div class="mb-3">
                                <label>Kode Reservasi</label>
                                <input type="text" class="form-control" value="{{ $reservasi->kode_reservasi }}"
                                    readonly>
                            </div>

                            <div class="mb-3">
                                <label>Pelanggan</label>

                                <select name="id_pelanggan" class="form-select" required>

                                    @foreach ($pelanggan as $p)
                                        <option value="{{ $p->id_pelanggan }}"
                                            {{ $reservasi->id_pelanggan == $p->id_pelanggan ? 'selected' : '' }}>

                                            {{ $p->nama_lengkap ?? ($p->user->nama_lengkap ?? '-') }}

                                        </option>
                                    @endforeach

                                </select>
                            </div>

                            <div class="mb-3">
                                <label>Kamar</label>

                                <select name="id_kamar" class="form-select" required>

                                    @foreach ($kamar as $k)
                                        <option value="{{ $k->id_kamar }}"
                                            {{ $reservasi->id_kamar == $k->id_kamar ? 'selected' : '' }}>

                                            {{ $k->nomor_kamar }}
                                            -
                                            {{ $k->tipe_kamar->nama_tipe ?? '-' }}

                                        </option>
                                    @endforeach

                                </select>
                            </div>

                        </div>
                    </div>

                    {{-- JADWAL --}}
                    <div class="card shadow-sm border-0 mb-3">
                        <div class="card-body">

                            <h5 class="fw-bold mb-3">
                                Jadwal Menginap
                            </h5>

                            <div class="row">

                                <div class="col-md-6">
                                    <label>Check In</label>

                                    <input type="date" name="check_in" class="form-control"
                                        value="{{ old('check_in', $reservasi->check_in) }}" required>
                                </div>

                                <div class="col-md-6">
                                    <label>Check Out</label>

                                    <input type="date" name="check_out" class="form-control"
                                        value="{{ old('check_out', $reservasi->check_out) }}" required>
                                </div>

                            </div>

                        </div>
                    </div>

                    {{-- TAMU --}}
                    <div class="card shadow-sm border-0">
                        <div class="card-body">

                            <h5 class="fw-bold mb-3">
                                Data Tamu
                            </h5>

                            <div class="row">

                                <div class="col-md-6">
                                    <label>Dewasa</label>

                                    <input type="number" name="jumlah_dewasa" min="1" class="form-control"
                                        value="{{ old('jumlah_dewasa', $reservasi->jumlah_dewasa) }}">
                                </div>

                                <div class="col-md-6">
                                    <label>Anak</label>

                                    <input type="number" name="jumlah_anak" min="0" class="form-control"
                                        value="{{ old('jumlah_anak', $reservasi->jumlah_anak) }}">
                                </div>

                            </div>

                        </div>
                    </div>

                </div>

                {{-- RIGHT --}}
                <div class="col-lg-4">

                    <div class="card shadow-sm border-0 mb-3">
                        <div class="card-body">

                            <h5 class="fw-bold mb-3">
                                Diskon & Pajak
                            </h5>

                            <div class="mb-3">
                                <label>Diskon (%)</label>

                                <input type="number" name="diskon_persen" min="0" max="100"
                                    class="form-control" value="{{ old('diskon_persen', $reservasi->diskon_persen ?? 0) }}">
                            </div>

                            <div>
                                <label>Pajak (%)</label>

                                <input type="number" name="pajak_persen" min="0" max="100" class="form-control"
                                    value="{{ old('pajak_persen', $reservasi->pajak_persen ?? 0) }}">
                            </div>

                        </div>
                    </div>

                    <div class="card shadow-sm border-0 mb-3">
                        <div class="card-body">

                            <h5 class="fw-bold mb-3">
                                Pembayaran
                            </h5>

                            <div class="mb-3">
                                <label>Status Pembayaran</label>

                                <select name="status_pembayaran" class="form-select">

                                    <option value="unpaid" {{ $reservasi->status_pembayaran == 'unpaid' ? 'selected' : '' }}>
                                        Unpaid
                                    </option>

                                    <option value="partial"
                                        {{ $reservasi->status_pembayaran == 'partial' ? 'selected' : '' }}>
                                        Partial
                                    </option>

                                    <option value="paid" {{ $reservasi->status_pembayaran == 'paid' ? 'selected' : '' }}>
                                        Paid
                                    </option>

                                </select>
                            </div>

                            <div>
                                <label>Metode Pembayaran</label>

                                <select name="metode_pembayaran" class="form-select">

                                    <option value="cash" {{ $reservasi->metode_pembayaran == 'cash' ? 'selected' : '' }}>
                                        Cash</option>

                                    <option value="transfer"
                                        {{ $reservasi->metode_pembayaran == 'transfer' ? 'selected' : '' }}>Transfer</option>

                                    <option value="qris" {{ $reservasi->metode_pembayaran == 'qris' ? 'selected' : '' }}>
                                        QRIS</option>

                                </select>
                            </div>

                        </div>
                    </div>

                    <div class="card shadow-sm border-0 mb-3">
                        <div class="card-body">

                            <label>Status Reservasi</label>

                            <select name="status_reservasi" class="form-select">

                                <option value="pending">Pending</option>
                                <option value="confirmed">Confirmed</option>
                                <option value="checkin">Check In</option>
                                <option value="checkout">Check Out</option>
                                <option value="cancelled">Cancelled</option>

                            </select>

                        </div>
                    </div>

                    <button type="submit" class="btn btn-warning w-100 fw-bold">
                        💾 Update Reservasi
                    </button>

                </div>

            </div>

        </form>
    </div>
@endsection
