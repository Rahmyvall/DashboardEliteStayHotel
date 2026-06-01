@extends('layouts.app')

@section('content')
    @php
        function statusBadge($status)
        {
            return match ($status) {
                'pending' => 'warning',
                'confirmed' => 'success',
                'checkin' => 'primary',
                'checkout' => 'secondary',
                'cancelled' => 'danger',
                'no_show' => 'dark',
                default => 'secondary',
            };
        }

        function paymentBadge($status)
        {
            return match ($status) {
                'paid' => 'success',
                'partial' => 'warning',
                'unpaid' => 'danger',
                'refunded' => 'dark',
                default => 'secondary',
            };
        }

        function approvalBadge($status)
        {
            return match ($status) {
                'approved' => 'success',
                'pending' => 'warning',
                'rejected' => 'danger',
                default => 'secondary',
            };
        }
    @endphp

    <div class="container-fluid py-4">

        {{-- HEADER --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-bold mb-1">🏨 Reservasi Hotel</h2>
                <small class="text-muted">Manajemen booking & approval admin</small>
            </div>

            <a href="{{ route('reservasi.create') }}" class="btn btn-primary shadow-sm rounded-3">
                + Tambah Reservasi
            </a>
        </div>

        {{-- CARD --}}
        <div class="card border-0 shadow-sm rounded-4">

            <div class="card-header bg-white border-0 py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-bold">Daftar Reservasi</h5>
                    <span class="text-muted small">
                        Total: {{ $reservasi->total() }} data
                    </span>
                </div>
            </div>

            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0">

                    <thead class="table-light">
                        <tr>
                            <th>Kode</th>
                            <th>Pelanggan</th>
                            <th>Kamar</th>
                            <th>Status</th>
                            <th>Pembayaran</th>
                            <th>Approval</th>
                            <th>Total</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse ($reservasi as $item)
                            <tr>

                                {{-- KODE --}}
                                <td>
                                    <div class="fw-bold text-primary">
                                        {{ $item->kode_reservasi }}
                                    </div>
                                    <small class="text-muted">
                                        ID: {{ $item->id_reservasi }}
                                    </small>
                                </td>

                                {{-- PELANGGAN --}}
                                <td>
                                    <div class="fw-semibold">
                                        {{ optional($item->pelanggan)->nama_lengkap ?? '-' }}
                                    </div>
                                    <small class="text-muted">
                                        {{ optional($item->pelanggan->user)->email ?? '' }}
                                    </small>
                                </td>

                                {{-- KAMAR --}}
                                <td>
                                    <span class="badge bg-info text-dark rounded-pill px-3 py-2">
                                        🛏 {{ optional($item->kamar)->nomor_kamar ?? '-' }}
                                    </span>
                                </td>

                                {{-- STATUS --}}
                                <td>
                                    <span
                                        class="badge bg-{{ statusBadge($item->status_reservasi) }} rounded-pill px-3 py-2">
                                        {{ ucfirst($item->status_reservasi) }}
                                    </span>
                                </td>

                                {{-- PAYMENT --}}
                                <td>
                                    <span
                                        class="badge bg-{{ paymentBadge($item->status_pembayaran) }} rounded-pill px-3 py-2">
                                        {{ ucfirst($item->status_pembayaran) }}
                                    </span>
                                </td>

                                {{-- APPROVAL --}}
                                <td>
                                    <span
                                        class="badge bg-{{ approvalBadge($item->approval_admin ?? 'pending') }} rounded-pill px-3 py-2">
                                        {{ ucfirst($item->approval_admin ?? 'pending') }}
                                    </span>
                                </td>

                                {{-- TOTAL --}}
                                <td>
                                    <div class="fw-bold text-success">
                                        Rp {{ number_format($item->total_harga ?? 0, 0, ',', '.') }}
                                    </div>
                                </td>

                                {{-- ACTION --}}
                                <td class="text-center">

                                    <div class="btn-group btn-group-sm">

                                        <a href="{{ route('reservasi.show', $item->id_reservasi) }}"
                                            class="btn btn-outline-primary">
                                            👁
                                        </a>

                                        @if (($item->approval_admin ?? 'pending') == 'pending')
                                            <form action="{{ route('reservasi.approve', $item->id_reservasi) }}"
                                                method="POST">
                                                @csrf
                                                @method('PATCH')

                                                <button class="btn btn-success">
                                                    ✔
                                                </button>
                                            </form>

                                            <form action="{{ route('reservasi.reject', $item->id_reservasi) }}"
                                                method="POST">
                                                @csrf
                                                @method('PATCH')

                                                <button class="btn btn-danger">
                                                    ✖
                                                </button>
                                            </form>
                                        @endif

                                        <a href="{{ route('reservasi.edit', $item->id_reservasi) }}"
                                            class="btn btn-outline-warning">
                                            ✏
                                        </a>

                                        <form action="{{ route('reservasi.destroy', $item->id_reservasi) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')

                                            <button class="btn btn-outline-danger"
                                                onclick="return confirm('Hapus data ini?')">
                                                🗑
                                            </button>
                                        </form>

                                    </div>

                                </td>

                            </tr>
                        @empty

                            <tr>
                                <td colspan="8" class="text-center py-5 text-muted">
                                    <div class="py-4">
                                        <h5>Belum ada reservasi</h5>
                                        <small>Silakan tambahkan data reservasi baru</small>
                                    </div>
                                </td>
                            </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>
@endsection
