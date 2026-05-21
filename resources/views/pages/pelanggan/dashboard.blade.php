@extends('layouts.app')

@section('content')

<div class="container-fluid py-3">

    {{-- TITLE --}}
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h3 class="fw-semibold mb-1">{{ $title }}</h3>
            <small class="text-muted">Overview dashboard terbaru</small>
        </div>
    </div>

    {{-- CARDS --}}
    <div class="row g-4">

        @php
        $cards = [
        ['title' => 'Cost per Unit', 'value' => '$17.21', 'badge' => 'Daily', 'progress' => 57, 'trend' => '+12.5%',
        'icon' => 'up', 'color' => 'success'],
        ['title' => 'Market Revenue', 'value' => '$1875.54', 'badge' => 'Per Week', 'progress' => 57, 'trend' =>
        '-18.71%', 'icon' => 'down', 'color' => 'danger'],
        ['title' => 'Expenses', 'value' => '$784.62', 'badge' => 'Per Month', 'progress' => 57, 'trend' => '+57%',
        'icon' => 'up', 'color' => 'warning'],
        ['title' => 'Daily Visits', 'value' => '115,187', 'badge' => 'All Time', 'progress' => 57, 'trend' => '-17.8%',
        'icon' => 'down', 'color' => 'info'],
        ];
        @endphp

        @foreach($cards as $c)
        <div class="col-md-6 col-xl-3">
            <div class="card border-0 shadow-sm rounded-4 h-100 hover-shadow transition">

                <div class="card-body p-4">

                    {{-- HEADER --}}
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="d-flex align-items-center gap-2">
                            <div class="rounded-circle bg-{{ $c['color'] }} bg-opacity-10 text-{{ $c['color'] }} d-flex align-items-center justify-content-center"
                                style="width:38px;height:38px;">
                                <i class="mdi mdi-chart-box-outline"></i>
                            </div>

                            <div>
                                <div class="small text-muted">{{ $c['title'] }}</div>
                                <div class="fw-semibold text-dark">{{ $c['badge'] }}</div>
                            </div>
                        </div>
                    </div>

                    {{-- VALUE --}}
                    <div class="d-flex justify-content-between align-items-end mb-3">
                        <h3 class="fw-bold mb-0">{{ $c['value'] }}</h3>

                        <div class="text-end">
                            <div class="small fw-semibold text-{{ $c['color'] }}">
                                {{ $c['trend'] }}
                                <i class="mdi mdi-arrow-{{ $c['icon'] }}"></i>
                            </div>
                        </div>
                    </div>

                    {{-- PROGRESS --}}
                    <div class="progress rounded-pill" style="height:6px;">
                        <div class="progress-bar bg-{{ $c['color'] }}" style="width: {{ $c['progress'] }}%"></div>
                    </div>

                </div>
            </div>
        </div>
        @endforeach

    </div>

    {{-- CHART SECTION --}}
    <div class="row mt-4 g-4">

        <div class="col-lg-5">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4">
                    <h6 class="fw-semibold mb-3">Basic Column Chart</h6>
                    <div id="apex-column-1" class="apex-charts"></div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4">
                    <h6 class="fw-semibold mb-3">Simple Pie Chart</h6>
                    <div id="apex-pie-1" class="apex-charts"></div>
                </div>
            </div>
        </div>

        <div class="col-lg-3">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4">
                    <h6 class="fw-semibold mb-3">Candlestick</h6>
                    <div id="apex-candlestick-1" class="apex-charts"></div>
                </div>
            </div>
        </div>

    </div>

    {{-- TABLE + REVENUE --}}
    <div class="row mt-4 g-4">

        {{-- CHART --}}
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4">

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <h6 class="fw-semibold mb-1">Total Revenue</h6>
                            <small class="text-muted">Overview performance</small>
                        </div>

                        <div class="dropdown">
                            <button class="btn btn-sm btn-light rounded-circle shadow-sm"
                                style="width:38px;height:38px;" data-bs-toggle="dropdown">
                                <i class="mdi mdi-dots-vertical"></i>
                            </button>

                            <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 rounded-3">
                                <li><a class="dropdown-item" href="#">Action</a></li>
                                <li><a class="dropdown-item" href="#">Another</a></li>
                            </ul>
                        </div>
                    </div>

                    <div id="morris-line-example" style="height:280px;"></div>

                </div>
            </div>
        </div>

        {{-- TABLE --}}
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4">

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <h6 class="fw-semibold mb-1">Top 5 Customers</h6>
                            <small class="text-muted">Latest registered users</small>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table align-middle table-hover modern-table mb-0">

                            <thead>
                                <tr>
                                    <th>Customer</th>
                                    <th>Contact</th>
                                    <th>Location</th>
                                    <th class="text-end">Date</th>
                                </tr>
                            </thead>

                            <tbody>
                                @for($i = 1; $i <= 5; $i++) <tr>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <div
                                                class="avatar-sm bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center fw-semibold">
                                                U{{ $i }}
                                            </div>
                                            <div class="fw-medium">User {{ $i }}</div>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="small">
                                            <div>+62 xxx</div>
                                            <div class="text-muted">user@email.com</div>
                                        </div>
                                    </td>

                                    <td>
                                        <span class="badge bg-light text-dark rounded-pill">
                                            Indonesia
                                        </span>
                                    </td>

                                    <td class="text-end text-muted small">
                                        2026-05-21
                                    </td>
                                    </tr>
                                    @endfor
                            </tbody>

                        </table>
                    </div>

                </div>
            </div>
        </div>

    </div>

</div>

@endsection