@extends('layouts.app')

@section('content')
    <div class="container-fluid py-4 px-4">

        {{-- HEADER --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-bold">🏨 Edit Reservasi</h2>
                <small class="text-muted">Update data booking hotel</small>
            </div>

            <a href="{{ route('reservasi.index') }}" class="btn btn-outline-secondary rounded-3">
                ← Kembali
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

        <form action="{{ route('reservasi.update', $reservasi->id_reservasi) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row g-4">

                {{-- LEFT --}}
                <div class="col-lg-8">

                    {{-- RESERVATION INFO --}}
                    <div class="card border-0 shadow-sm rounded-4 mb-3">
                        <div class="card-body">

                            <h5 class="fw-bold mb-3">Reservation Info</h5>

                            <label class="form-label">Kode Reservasi</label>
                            <input type="text" class="form-control bg-light rounded-3"
                                value="{{ $reservasi->kode_reservasi }}" readonly>

                            <label class="form-label mt-3">Pelanggan</label>
                            <select name="id_pelanggan" class="form-select rounded-3">
                                @foreach ($pelanggan as $p)
                                    <option value="{{ $p->id_pelanggan }}"
                                        {{ $reservasi->id_pelanggan == $p->id_pelanggan ? 'selected' : '' }}>
                                        {{ $p->nama_lengkap ?? ($p->user->nama_lengkap ?? '-') }}
                                    </option>
                                @endforeach
                            </select>

                            <label class="form-label mt-3">Kamar</label>
                            <select name="id_kamar" class="form-select rounded-3">
                                @foreach ($kamar as $k)
                                    <option value="{{ $k->id_kamar }}"
                                        {{ $reservasi->id_kamar == $k->id_kamar ? 'selected' : '' }}>
                                        {{ $k->nomor_kamar }} - {{ $k->tipe_kamar->nama_tipe ?? '' }}
                                    </option>
                                @endforeach
                            </select>

                        </div>
                    </div>

                    {{-- STAY --}}
                    <div class="card border-0 shadow-sm rounded-4 mb-3">
                        <div class="card-body">

                            <h5 class="fw-bold mb-3">Stay Schedule</h5>

                            <div class="row">
                                <div class="col-md-6">
                                    <label>Check In</label>
                                    <input type="date" name="check_in" id="check_in" class="form-control rounded-3"
                                        value="{{ $reservasi->check_in }}">
                                </div>

                                <div class="col-md-6">
                                    <label>Lama Menginap</label>
                                    <input type="number" name="lama_menginap" id="lama_menginap"
                                        class="form-control rounded-3" value="{{ $reservasi->lama_menginap }}">
                                </div>
                            </div>

                            <div class="mt-3">
                                <label>Check Out (auto)</label>
                                <input type="date" id="check_out" class="form-control bg-light rounded-3" readonly>
                            </div>

                        </div>
                    </div>

                    {{-- GUEST --}}
                    <div class="card border-0 shadow-sm rounded-4">
                        <div class="card-body">

                            <h5 class="fw-bold mb-3">Guest</h5>

                            <div class="row">
                                <div class="col-md-6">
                                    <label>Dewasa</label>
                                    <input type="number" name="jumlah_dewasa" class="form-control rounded-3"
                                        value="{{ $reservasi->jumlah_dewasa }}">
                                </div>

                                <div class="col-md-6">
                                    <label>Anak</label>
                                    <input type="number" name="jumlah_anak" class="form-control rounded-3"
                                        value="{{ $reservasi->jumlah_anak }}">
                                </div>
                            </div>

                        </div>
                    </div>

                </div>

                {{-- RIGHT --}}
                <div class="col-lg-4">

                    {{-- PAYMENT --}}
                    <div class="card border-0 shadow-sm rounded-4 mb-3">
                        <div class="card-body">

                            <h5 class="fw-bold mb-3">Payment</h5>

                            <label>Status</label>
                            <select name="status_pembayaran" class="form-select rounded-3">
                                <option value="unpaid" {{ $reservasi->status_pembayaran == 'unpaid' ? 'selected' : '' }}>Unpaid
                                </option>
                                <option value="partial" {{ $reservasi->status_pembayaran == 'partial' ? 'selected' : '' }}>
                                    Partial</option>
                                <option value="paid" {{ $reservasi->status_pembayaran == 'paid' ? 'selected' : '' }}>Paid
                                </option>
                                <option value="refunded" {{ $reservasi->status_pembayaran == 'refunded' ? 'selected' : '' }}>
                                    Refunded</option>
                            </select>

                            <label class="mt-3">Metode</label>
                            <select name="metode_pembayaran" class="form-select rounded-3">
                                <option value="cash" {{ $reservasi->metode_pembayaran == 'cash' ? 'selected' : '' }}>Cash
                                </option>
                                <option value="transfer" {{ $reservasi->metode_pembayaran == 'transfer' ? 'selected' : '' }}>
                                    Transfer</option>
                                <option value="qris" {{ $reservasi->metode_pembayaran == 'qris' ? 'selected' : '' }}>QRIS
                                </option>
                                <option value="ewallet" {{ $reservasi->metode_pembayaran == 'ewallet' ? 'selected' : '' }}>
                                    E-Wallet</option>
                            </select>

                        </div>
                    </div>

                    {{-- STATUS --}}
                    <div class="card border-0 shadow-sm rounded-4 mb-3">
                        <div class="card-body">

                            <h5 class="fw-bold mb-3">Reservation Status</h5>

                            <select name="status_reservasi" class="form-select rounded-3">
                                @foreach (['pending', 'confirmed', 'checkin', 'checkout', 'cancelled', 'no_show'] as $status)
                                    <option value="{{ $status }}"
                                        {{ $reservasi->status_reservasi == $status ? 'selected' : '' }}>
                                        {{ ucfirst($status) }}
                                    </option>
                                @endforeach
                            </select>

                        </div>
                    </div>

                    {{-- SUBMIT --}}
                    <button class="btn btn-warning w-100 rounded-3 py-3 fw-bold">
                        Update Reservasi
                    </button>

                </div>

            </div>
        </form>
    </div>

    {{-- SCRIPT AUTO CHECKOUT --}}
    <script>
        const checkIn = document.getElementById('check_in');
        const lama = document.getElementById('lama_menginap');
        const checkOut = document.getElementById('check_out');

        function updateDate() {
            if (!checkIn.value || !lama.value) return;

            let date = new Date(checkIn.value);
            date.setDate(date.getDate() + parseInt(lama.value));

            checkOut.value = date.toISOString().split('T')[0];
        }

        checkIn.addEventListener('input', updateDate);
        lama.addEventListener('input', updateDate);

        window.onload = updateDate;
    </script>

@endsection
