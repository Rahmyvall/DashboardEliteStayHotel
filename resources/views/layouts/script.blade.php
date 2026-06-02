<!-- Vendor Scripts -->
<script src="{{ asset('dashtrap/admin/dist/assets/js/vendor.min.js') }}"></script>
<script src="{{ asset('dashtrap/admin/dist/assets/js/app.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- Chart Libraries -->
<script src="{{ asset('dashtrap/admin/dist/assets/libs/apexcharts/apexcharts.min.js') }}"></script>

<!-- Custom Scripts -->
<script>
    // Logout Handler
    document.getElementById('btnLogout')?.addEventListener('click', function() {
        const loading = document.getElementById('logoutLoading');
        if (loading) loading.classList.remove('d-none');

        this.disabled = true;
        this.innerHTML = 'Logging out...';

        setTimeout(() => {
            document.getElementById('logoutForm').submit();
        }, 600);
    });

    // ==================== PIE CHART - PELANGGAN ====================
    document.addEventListener('DOMContentLoaded', function() {
        const chartEl = document.querySelector("#apex-pie-pelanggan");
        if (!chartEl) return;

        fetch('{{ route('admin.dashboard.pelanggan.chart') }}')
            .then(response => {
                if (!response.ok) throw new Error('Network error');
                return response.json();
            })
            .then(data => {
                const laki = data.laki_laki ?? 0;
                const perempuan = data.perempuan ?? 0;
                const total = laki + perempuan;

                // Update angka
                document.getElementById('total-pelanggan').textContent = total;
                document.getElementById('count-laki').textContent = laki;
                document.getElementById('count-perempuan').textContent = perempuan;

                // Chart Options (Donut - lebih modern)
                const options = {
                    series: [laki, perempuan],
                    chart: {
                        type: 'donut',
                        height: 280,
                        toolbar: {
                            show: false
                        }
                    },
                    labels: ['Laki-laki', 'Perempuan'],
                    colors: ['#3b82f6', '#ec4899'],
                    legend: {
                        position: 'bottom',
                        fontSize: '14px',
                        markers: {
                            width: 10,
                            height: 10,
                            radius: 2
                        }
                    },
                    plotOptions: {
                        pie: {
                            donut: {
                                size: '72%',
                                labels: {
                                    show: true,
                                    total: {
                                        show: true,
                                        label: 'Total',
                                        fontSize: '14px',
                                        fontWeight: 600
                                    }
                                }
                            }
                        }
                    },
                    dataLabels: {
                        enabled: true,
                        formatter: (val) => val.toFixed(1) + '%'
                    },
                    tooltip: {
                        y: {
                            formatter: (val) => val + " orang"
                        }
                    }
                };

                const chart = new ApexCharts(chartEl, options);
                chart.render();
            })
            .catch(err => {
                console.error(err);
                chartEl.innerHTML =
                    `<p class="text-center text-danger mt-4">Gagal memuat grafik pelanggan</p>`;
            });
    });

    // ==================== BAR CHART - STATUS RESERVASI ====================
    document.addEventListener('DOMContentLoaded', function() {
        const options = {
            series: [{
                name: 'Jumlah Reservasi',
                data: [
                    {{ $grafikReservasi['pending'] ?? 0 }},
                    {{ $grafikReservasi['confirmed'] ?? 0 }},
                    {{ $grafikReservasi['checkin'] ?? 0 }},
                    {{ $grafikReservasi['checkout'] ?? 0 }},
                    {{ $grafikReservasi['cancelled'] ?? 0 }}
                ]
            }],

            chart: {
                type: 'bar',
                height: 350,
                toolbar: {
                    show: false
                }
            },

            plotOptions: {
                bar: {
                    borderRadius: 8,
                    columnWidth: '55%',
                    distributed: true
                }
            },

            colors: ['#ffc107', '#198754', '#0dcaf0', '#6c757d', '#dc3545'],
            dataLabels: {
                enabled: true
            },

            xaxis: {
                categories: ['Pending', 'Confirmed', 'Check In', 'Check Out', 'Cancelled'],
                axisBorder: {
                    show: false
                }
            },

            yaxis: {
                title: {
                    text: 'Jumlah Reservasi'
                }
            },

            tooltip: {
                y: {
                    formatter: val => val + " reservasi"
                }
            }
        };

        const chart = new ApexCharts(document.querySelector("#apex-column-1"), options);
        chart.render();
    });

    // ==================== LINE CHART - TREN RESERVASI ====================
    let reservasiChart;

    function loadReservasiChart(periode = 'monthly') {
        $.ajax({
            url: "{{ route('dashboard.reservasi-line') }}",
            method: 'GET',
            data: {
                periode: periode
            },
            success: function(response) {

                if (reservasiChart) reservasiChart.destroy();

                const options = {
                    series: [{
                            name: 'Total Reservasi',
                            data: response.total
                        },
                        {
                            name: 'Confirmed',
                            data: response.confirmed
                        },
                        {
                            name: 'Check-in',
                            data: response.checkin
                        }
                    ],
                    chart: {
                        type: 'line',
                        height: 350,
                        toolbar: {
                            show: true
                        },
                        zoom: {
                            enabled: false
                        }
                    },
                    colors: ['#3b82f6', '#10b981', '#8b5cf6'],
                    stroke: {
                        curve: 'smooth',
                        width: 3
                    },
                    markers: {
                        size: 5,
                        strokeColors: '#fff',
                        strokeWidth: 2,
                        hover: {
                            size: 7
                        }
                    },
                    xaxis: {
                        categories: response.labels,
                        tickPlacement: 'on'
                    },
                    yaxis: {
                        min: 0,
                        title: {
                            text: 'Jumlah Reservasi'
                        }
                    },
                    legend: {
                        position: 'top',
                        horizontalAlign: 'right'
                    },
                    grid: {
                        borderColor: '#f1f5f9',
                        strokeDashArray: 3
                    },
                    tooltip: {
                        shared: true,
                        intersect: false
                    }
                };

                reservasiChart = new ApexCharts(document.querySelector("#apex-line-reservasi"), options);
                reservasiChart.render();
            },
            error: function() {
                console.error("Gagal memuat data tren reservasi");
            }
        });
    }

    // Event Listener untuk Line Chart
    document.addEventListener('DOMContentLoaded', function() {
        loadReservasiChart(); // default

        $('#periode-reservasi').on('change', function() {
            loadReservasiChart(this.value);
        });
    });

    // ==================== TABLE CLICKABLE ====================
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.table-row-clickable').forEach(row => {
            row.addEventListener('click', function() {
                const href = this.getAttribute('data-href');
                if (href) window.location.href = href;
            });
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        const canvas = document.getElementById('pendapatanChart');

        if (!canvas) return;

        const ctx = canvas.getContext('2d');

        let pendapatanChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [],
                datasets: [{
                    label: 'Pendapatan (Rp)',
                    data: [],
                    backgroundColor: 'rgba(25, 135, 84, 0.8)',
                    borderColor: 'rgba(25, 135, 84, 1)',
                    borderWidth: 1,
                    borderRadius: 8,
                    maxBarThickness: 40
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,

                plugins: {
                    legend: {
                        display: false
                    },

                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return 'Rp ' + Number(context.raw || 0)
                                    .toLocaleString('id-ID');
                            }
                        }
                    }
                },

                scales: {
                    x: {
                        grid: {
                            display: false
                        }
                    },

                    y: {
                        beginAtZero: true,

                        ticks: {
                            callback: function(value) {
                                return 'Rp ' + Number(value)
                                    .toLocaleString('id-ID');
                            }
                        }
                    }
                }
            }
        });

        function loadPendapatan(year) {

            fetch(`/dashboard/pendapatan-chart?year=${year}`)
                .then(response => response.json())
                .then(data => {

                    pendapatanChart.data.labels = data.labels;
                    pendapatanChart.data.datasets[0].data = data.pendapatan;
                    pendapatanChart.update();

                    document.getElementById('totalTahun').innerHTML =
                        'Rp ' + Number(data.totalPendapatan || 0)
                        .toLocaleString('id-ID');

                    document.getElementById('rataRata').innerHTML =
                        'Rp ' + Number(data.rataRata || 0)
                        .toLocaleString('id-ID');

                    document.getElementById('totalTransaksi').innerHTML =
                        Number(data.totalTransaksi || 0)
                        .toLocaleString('id-ID');
                })
                .catch(error => {
                    console.error('Gagal memuat data pendapatan:', error);
                });
        }

        const yearFilter = document.getElementById('yearFilter');

        if (yearFilter) {

            loadPendapatan(yearFilter.value);

            yearFilter.addEventListener('change', function() {
                loadPendapatan(this.value);
            });
        }

    });
</script>
@push('styles')
    <style>
        .card-clickable {
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .card-clickable:hover {
            transform: translateY(-6px);
            box-shadow: 0 12px 25px rgba(0, 0, 0, 0.12) !important;
        }

        .table-row-clickable {
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .table-row-clickable:hover {
            background-color: #f8f9fa;
        }
    </style>
@endpush
