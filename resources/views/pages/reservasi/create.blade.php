@extends('layouts.app')

@section('content')
    <div class="container-fluid py-4">

        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-bold mb-1 text-primary">
                    <i class="fas fa-calendar-plus me-2"></i> Buat Reservasi Baru
                </h2>
                <p class="text-muted mb-0">Hotel Booking Management System</p>
            </div>
            <a href="{{ route('reservasi.index') }}" class="btn btn-outline-secondary rounded-3">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger rounded-3">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('reservasi.store') }}" method="POST" id="reservationForm">
            @csrf

            <!-- Hidden Fields -->
            <input type="hidden" name="lama_menginap" id="lama_menginap" value="0">
            <input type="hidden" name="harga_per_malam" id="harga_per_malam" value="0">
            <input type="hidden" name="diskon_nominal" id="diskon_nominal" value="0">
            <input type="hidden" name="pajak_nominal" id="pajak_nominal" value="0">
            <input type="hidden" name="total_harga" id="total_harga" value="0">

            <div class="row g-4">

                <!-- LEFT COLUMN -->
                <div class="col-lg-7">

                    <!-- Guest Information -->
                    <div class="card border-0 shadow-sm rounded-4 mb-4">
                        <div class="card-header bg-white border-0 pt-4 pb-3">
                            <h5 class="fw-bold mb-0"><i class="fas fa-user me-2"></i> Informasi Tamu & Kamar</h5>
                        </div>
                        <div class="card-body">

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Pelanggan <span
                                            class="text-danger">*</span></label>
                                    <select name="id_pelanggan" class="form-select rounded-3" required>
                                        <option value="">-- Pilih Pelanggan --</option>
                                        @foreach ($pelanggan as $p)
                                            <option value="{{ $p->id_pelanggan }}">
                                                {{ $p->nama_lengkap ?? ($p->user?->nama_lengkap ?? '-') }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Kamar <span class="text-danger">*</span></label>
                                    <select name="id_kamar" id="id_kamar" class="form-select rounded-3" required>
                                        <option value="">-- Pilih Kamar --</option>
                                        @foreach ($kamar as $k)
                                            <option value="{{ $k->id_kamar }}" data-harga="{{ $k->harga_per_malam ?? 0 }}">
                                                Kamar {{ $k->nomor_kamar }}
                                                @if ($k->tipe_kamar)
                                                    - {{ $k->tipe_kamar->nama_tipe ?? '' }}
                                                @endif
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- Stay Information -->
                    <div class="card border-0 shadow-sm rounded-4 mb-4">
                        <div class="card-header bg-white border-0 pt-4 pb-3">
                            <h5 class="fw-bold mb-0"><i class="fas fa-calendar-alt me-2"></i> Informasi Menginap</h5>
                        </div>
                        <div class="card-body">

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Check In <span
                                            class="text-danger">*</span></label>
                                    <input type="date" name="check_in" id="check_in" class="form-control rounded-3"
                                        required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Check Out <span
                                            class="text-danger">*</span></label>
                                    <input type="date" name="check_out" id="check_out" class="form-control rounded-3"
                                        required>
                                </div>
                            </div>

                            <div class="row g-3 mt-2">
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Jumlah Dewasa</label>
                                    <input type="number" name="jumlah_dewasa" class="form-control rounded-3" min="1"
                                        value="1">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Jumlah Anak</label>
                                    <input type="number" name="jumlah_anak" class="form-control rounded-3" min="0"
                                        value="0">
                                </div>
                            </div>

                            <div class="row g-3 mt-2">
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Diskon (%)</label>
                                    <input type="number" name="diskon_persen" id="diskon_persen"
                                        class="form-control rounded-3" value="5" readonly>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Pajak (%)</label>
                                    <input type="number" name="pajak_persen" id="pajak_persen"
                                        class="form-control rounded-3" value="11" readonly>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- Catatan -->
                    <div class="card border-0 shadow-sm rounded-4">
                        <div class="card-header bg-white border-0 pt-4 pb-3">
                            <h5 class="fw-bold mb-0"><i class="fas fa-sticky-note me-2"></i> Catatan Tambahan</h5>
                        </div>
                        <div class="card-body">
                            <textarea name="catatan" rows="4" class="form-control rounded-3"
                                placeholder="Permintaan khusus, alergi, kebutuhan tambahan, dll..."></textarea>
                        </div>
                    </div>

                </div>

                <!-- RIGHT COLUMN - Summary -->
                <div class="col-lg-5">

                    <!-- Booking Status -->
                    <div class="card border-0 shadow-sm rounded-4 mb-4">
                        <div class="card-header bg-white border-0 pt-4 pb-3">
                            <h5 class="fw-bold mb-0"><i class="fas fa-info-circle me-2"></i> Status Booking</h5>
                        </div>
                        <div class="card-body">

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Status Pembayaran</label>
                                <select name="status_pembayaran" class="form-select rounded-3">
                                    <option value="unpaid" selected>Unpaid</option>
                                    <option value="partial">Partial</option>
                                    <option value="paid">Paid</option>
                                    <option value="refunded">Refunded</option>
                                </select>
                            </div>

                            <div>
                                <label class="form-label fw-semibold">Metode Pembayaran</label>
                                <select name="metode_pembayaran" class="form-select rounded-3">
                                    <option value="">-- Pilih Metode --</option>
                                    <option value="cash">Cash</option>
                                    <option value="transfer">Transfer Bank</option>
                                    <option value="qris">QRIS</option>
                                </select>
                            </div>

                            <input type="hidden" name="status_reservasi" value="pending">
                        </div>
                    </div>

                    <!-- Price Summary -->
                    <div class="card border-0 shadow-sm rounded-4 sticky-top" style="top: 20px;">
                        <div class="card-header bg-white border-0 pt-4 pb-3">
                            <h5 class="fw-bold mb-0 text-success"><i class="fas fa-calculator me-2"></i> Estimasi Biaya
                            </h5>
                        </div>
                        <div class="card-body">

                            <table class="table table-borderless table-sm">
                                <tr>
                                    <td>Harga per Malam</td>
                                    <td class="text-end fw-medium">Rp <span id="harga">0</span></td>
                                </tr>
                                <tr>
                                    <td>Lama Menginap</td>
                                    <td class="text-end fw-medium"><span id="lama">0</span> malam</td>
                                </tr>
                                <tr class="border-top">
                                    <td>Subtotal</td>
                                    <td class="text-end fw-medium">Rp <span id="subtotal">0</span></td>
                                </tr>

                                <tr class="border-top border-2">
                                    <td class="fs-5 fw-bold">Total</td>
                                    <td class="text-end fs-5 fw-bold text-success">Rp <span id="total">0</span></td>
                                </tr>
                            </table>

                        </div>
                        <div class="card-footer bg-light border-0 rounded-bottom-4">
                            <button type="submit" class="btn btn-primary btn-lg w-100 rounded-3 py-3 fw-bold">
                                <i class="fas fa-save me-2"></i> Simpan Reservasi
                            </button>
                        </div>
                    </div>

                </div>

            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        function rupiah(angka) {
            return new Intl.NumberFormat('id-ID').format(Math.round(angka || 0));
        }

        function parseNumber(val) {
            return isNaN(parseFloat(val)) ? 0 : parseFloat(val);
        }

        function hitungReservasi() {
            const kamarSelect = document.getElementById('id_kamar');
            const harga = parseNumber(kamarSelect?.selectedOptions?.[0]?.dataset?.harga);

            const checkInVal = document.getElementById('check_in').value;
            const checkOutVal = document.getElementById('check_out').value;

            const diskonPersen = parseNumber(document.getElementById('diskon_persen').value);
            const pajakPersen = parseNumber(document.getElementById('pajak_persen').value);

            let malam = 0;

            // ✅ FIX: hitung selisih hari aman (tanpa timezone bug)
            if (checkInVal && checkOutVal) {
                const checkIn = new Date(checkInVal);
                const checkOut = new Date(checkOutVal);

                const diffTime = checkOut - checkIn;
                malam = diffTime > 0 ? Math.ceil(diffTime / (1000 * 60 * 60 * 24)) : 0;
            }

            const subtotal = harga * malam;
            const diskonNominal = subtotal * (diskonPersen / 100);
            const afterDiskon = subtotal - diskonNominal;
            const pajakNominal = afterDiskon * (pajakPersen / 100);
            const total = afterDiskon + pajakNominal;

            // ===== UPDATE UI =====
            document.getElementById('harga').textContent = rupiah(harga);
            document.getElementById('lama').textContent = malam;
            document.getElementById('subtotal').textContent = rupiah(subtotal);
            document.getElementById('diskon').textContent = rupiah(diskonNominal);
            document.getElementById('pajak').textContent = rupiah(pajakNominal);
            document.getElementById('total').textContent = rupiah(total);

            // ===== UPDATE HIDDEN INPUT (CRUD STORE) =====
            document.getElementById('lama_menginap').value = malam;
            document.getElementById('harga_per_malam').value = harga;
            document.getElementById('diskon_nominal').value = diskonNominal;
            document.getElementById('pajak_nominal').value = pajakNominal;
            document.getElementById('total_harga').value = total;
        }

        document.addEventListener('DOMContentLoaded', function() {
            const fields = [
                'id_kamar',
                'check_in',
                'check_out',
                'diskon_persen',
                'pajak_persen'
            ];

            fields.forEach(id => {
                const el = document.getElementById(id);
                if (el) {
                    el.addEventListener('input', hitungReservasi);
                    el.addEventListener('change', hitungReservasi);
                }
            });

            // hitung awal
            hitungReservasi();
        });
    </script>
@endpush
