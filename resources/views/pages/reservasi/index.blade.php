@extends('layouts.app')

@section('content')
    @php
        use Carbon\Carbon;

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
                <small class="text-muted">Manajemen booking & persetujuan admin</small>
            </div>

            <a href="{{ route('reservasi.create') }}" class="btn btn-primary">
                + Tambah Reservasi
            </a>
        </div>

        {{-- TABLE --}}
        <div class="card shadow-sm border-0 rounded-4">

            <div class="card-header bg-white border-0">
                <h5 class="mb-0 fw-bold">Daftar Reservasi</h5>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">

                    <thead class="bg-light">
                        <tr>
                            <th>Kode</th>
                            <th>Pelanggan</th>
                            <th>Kamar</th>
                            <th>Status</th>
                            <th>Pembayaran</th>
                            <th>Approval Admin</th>
                            <th>Total</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($reservasi as $item)
                            <tr>

                                {{-- KODE --}}
                                <td class="fw-bold text-primary">
                                    {{ $item->kode_reservasi }}
                                </td>

                                {{-- PELANGGAN --}}
                                <td>
                                    {{ optional($item->pelanggan)->nama_lengkap ?? '-' }}
                                </td>

                                {{-- KAMAR --}}
                                <td>
                                    <span class="badge bg-info text-dark">
                                        {{ optional($item->kamar)->nomor_kamar ?? '-' }}
                                    </span>
                                </td>

                                {{-- STATUS RESERVASI --}}
                                <td>
                                    <span class="badge bg-{{ statusBadge($item->status_reservasi) }}">
                                        {{ ucfirst($item->status_reservasi) }}
                                    </span>
                                </td>

                                {{-- STATUS PEMBAYARAN --}}
                                <td>
                                    <span class="badge bg-{{ paymentBadge($item->status_pembayaran) }}">
                                        {{ ucfirst($item->status_pembayaran) }}
                                    </span>
                                </td>

                                {{-- APPROVAL ADMIN (🔥 NEW) --}}
                                <td>
                                    <span class="badge bg-{{ approvalBadge($item->approval_admin ?? 'pending') }}">
                                        {{ ucfirst($item->approval_admin ?? 'pending') }}
                                    </span>
                                </td>

                                {{-- TOTAL --}}
                                <td class="fw-bold text-success">
                                    Rp {{ number_format($item->total_harga ?? 0, 0, ',', '.') }}
                                </td>

                                {{-- ACTION --}}
                                <td class="text-center">

                                    <a href="{{ route('reservasi.show', $item->id_reservasi) }}"
                                        class="btn btn-sm btn-outline-primary">
                                        👁
                                    </a>

                                    {{-- APPROVE --}}
                                    @if (($item->approval_admin ?? 'pending') == 'pending')
                                        <form action="{{ route('reservasi.approve', $item->id_reservasi) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('PATCH')

                                            <button class="btn btn-sm btn-success">
                                                ✔ Approve
                                            </button>
                                        </form>

                                        <form action="{{ route('reservasi.reject', $item->id_reservasi) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('PATCH')

                                            <button class="btn btn-sm btn-danger">
                                                ✖ Reject
                                            </button>
                                        </form>
                                    @endif

                                    <a href="{{ route('reservasi.edit', $item->id_reservasi) }}"
                                        class="btn btn-sm btn-outline-warning">
                                        ✏
                                    </a>

                                    <form action="{{ route('reservasi.destroy', $item->id_reservasi) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')

                                        <button class="btn btn-sm btn-outline-danger"
                                            onclick="return confirm('Hapus data ini?')">
                                            🗑
                                        </button>
                                    </form>

                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-5 text-muted">
                                    Tidak ada data reservasi
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>

        </div>

    </div>
@endsection
