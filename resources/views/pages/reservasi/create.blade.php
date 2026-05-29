@extends('layouts.app')

@section('content')
    <div class="container-fluid py-4">

        {{-- HEADER --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-bold mb-0">🏨 Create New Reservation</h2>
                <small class="text-muted">Hotel Booking Management System</small>
            </div>

            <a href="{{ route('reservasi.index') }}" class="btn btn-outline-secondary rounded-3">
                ← Back
            </a>
        </div>

        {{-- ERROR --}}
        @if ($errors->any())
            <div class="alert alert-danger rounded-3">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('reservasi.store') }}" method="POST">
            @csrf

            <div class="row g-4">

                {{-- LEFT SECTION --}}
                <div class="col-lg-8">

                    {{-- GUEST & ROOM --}}
                    <div class="card border-0 shadow-sm rounded-4 mb-3">
                        <div class="card-body">

                            <h5 class="fw-bold mb-3">Guest & Room</h5>

                            <label class="form-label">Pelanggan</label>
                            <select name="id_pelanggan" class="form-select rounded-3" required>
                                <option value="">-- Select Customer --</option>
                                @foreach ($pelanggan as $p)
                                    <option value="{{ $p->id_pelanggan }}">
                                        {{ $p->nama_lengkap ?? ($p->user->nama_lengkap ?? '-') }}
                                    </option>
                                @endforeach
                            </select>

                            <label class="form-label mt-3">Room</label>
                            <select name="id_kamar" class="form-select rounded-3" required>
                                <option value="">-- Select Room --</option>
                                @foreach ($kamar as $k)
                                    <option value="{{ $k->id_kamar }}">
                                        {{ $k->nomor_kamar }} - {{ $k->tipe_kamar->nama_tipe ?? '' }}
                                    </option>
                                @endforeach
                            </select>

                        </div>
                    </div>

                    {{-- STAY INFO --}}
                    <div class="card border-0 shadow-sm rounded-4">
                        <div class="card-body">

                            <h5 class="fw-bold mb-3">Stay Information</h5>

                            <div class="row">

                                <div class="col-md-6">
                                    <label class="form-label">Check In</label>
                                    <input type="date" name="check_in" class="form-control rounded-3" required>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Length of Stay (Nights)</label>
                                    <input type="number" name="lama_menginap" class="form-control rounded-3" min="1"
                                        value="1" required>
                                </div>

                            </div>

                            <div class="row mt-3">

                                <div class="col-md-6">
                                    <label class="form-label">Diskon (%)</label>
                                    <input type="number" name="diskon_persen" class="form-control rounded-3" min="0"
                                        max="100" value="0">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Pajak (%)</label>
                                    <input type="number" name="pajak_persen" class="form-control rounded-3" min="0"
                                        max="100" value="0">
                                </div>

                            </div>

                        </div>
                    </div>

                </div>

                {{-- RIGHT SECTION --}}
                <div class="col-lg-4">

                    {{-- STATUS CARD --}}
                    <div class="card border-0 shadow-sm rounded-4 mb-3">
                        <div class="card-body">

                            <h5 class="fw-bold mb-3">Booking Status</h5>

                            <label class="form-label">Payment Status</label>
                            <select name="status_pembayaran" class="form-select rounded-3">
                                <option value="unpaid">Unpaid</option>
                                <option value="partial">Partial</option>
                                <option value="paid">Paid</option>
                                <option value="refunded">Refunded</option>
                            </select>

                            <label class="form-label mt-3">Payment Method</label>
                            <select name="metode_pembayaran" class="form-select rounded-3">
                                <option value="">-- Select --</option>
                                <option value="cash">Cash</option>
                                <option value="transfer">Transfer</option>
                                <option value="qris">QRIS</option>
                            </select>

                            <input type="hidden" name="status_reservasi" value="pending">

                        </div>
                    </div>

                    {{-- INFO PANEL --}}
                    <div class="card border-0 shadow-sm rounded-4 mb-3">
                        <div class="card-body">

                            <h6 class="fw-bold">System Info</h6>

                            <div class="small text-muted">
                                ✔ Price auto-calculated<br>
                                ✔ Discount applied automatically<br>
                                ✔ Tax calculated by system<br>
                                ✔ Total generated on backend
                            </div>

                        </div>
                    </div>

                    {{-- SUBMIT --}}
                    <button class="btn btn-primary w-100 rounded-3 py-2 fw-bold">
                        💾 Save Reservation
                    </button>

                </div>

            </div>
        </form>

    </div>
@endsection
