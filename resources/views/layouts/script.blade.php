<script src="{{ asset('dashtrap/admin/dist/assets/js/vendor.min.js') }}"></script>

<!-- App js -->
<script src="{{ asset('dashtrap/admin/dist/assets/js/app.js') }}"></script>

<!-- Knob charts js -->
<script src="{{ asset('dashtrap/admin/dist/assets/libs/jquery-knob/jquery.knob.min.js') }}"></script>

<!-- Sparkline Js-->
<script src="{{ asset('dashtrap/admin/dist/assets/libs/jquery-sparkline/jquery.sparkline.min.js') }}"></script>

<script src="{{ asset('dashtrap/admin/dist/assets/libs/morris.js/morris.min.js') }}"></script>

<script src="{{ asset('dashtrap/admin/dist/assets/libs/raphael/raphael.min.js') }}"></script>
<script src="{{ asset('dashtrap/admin/dist/assets/libs/apexcharts/apexcharts.min.js') }}"></script>
<script src="https://apexcharts.com/samples/assets/irregular-data-series.js"></script>
<script src="https://apexcharts.com/samples/assets/ohlc.js"></script>


<!-- Demo js -->
<script src="{{ asset('dashtrap/admin/dist/assets/js/pages/apexcharts.js') }}"></script>

<!-- Dashboard init-->
<script src="{{ asset('dashtrap/admin/dist/assets/js/pages/dashboard.js') }}"></script>

<!-- OPTIONAL: Bootstrap only jika vendor.min.js belum include bootstrap -->
{{--

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
--}}
<script>
    document.getElementById('btnLogout')
        .addEventListener('click', function() {

            // tampilkan loading
            document.getElementById('logoutLoading')
                .classList.remove('d-none');

            // disable tombol
            this.disabled = true;

            this.innerHTML = 'Logging out...';

            // delay sedikit agar loading terlihat
            setTimeout(() => {

                document.getElementById('logoutForm')
                    .submit();

            }, 500);
        });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {

        const chartElement = document.querySelector("#apex-pie-pelanggan");

        if (!chartElement) {
            console.error("Element #apex-pie-pelanggan tidak ditemukan!");
            return;
        }

        fetch('{{ route('admin.dashboard.pelanggan.chart') }}')
            .then(response => {
                if (!response.ok) throw new Error('Gagal mengambil data');
                return response.json();
            })
            .then(data => {
                document.getElementById('total-pelanggan').textContent = data.total;
                document.getElementById('count-laki').textContent = data.laki_laki;
                document.getElementById('count-perempuan').textContent = data.perempuan;

                const options = {
                    series: [data.laki_laki, data.perempuan],
                    chart: {
                        type: 'pie',
                        height: 280,
                        toolbar: {
                            show: false
                        }
                    },
                    labels: ['Laki-laki', 'Perempuan'],
                    colors: ['#3b82f6', '#ec4899'],
                    legend: {
                        position: 'bottom',
                        fontSize: '14px'
                    },
                    dataLabels: {
                        enabled: true,
                        formatter: function(val) {
                            return val.toFixed(1) + "%";
                        }
                    },
                    tooltip: {
                        y: {
                            formatter: (val) => val + " orang"
                        }
                    }
                };

                const chart = new ApexCharts(chartElement, options);
                chart.render();
            })
            .catch(error => {
                console.error('Error:', error);
                chartElement.innerHTML = `<p class="text-center text-danger mt-5">Gagal memuat grafik</p>`;
            });
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {

        const el = document.querySelector("#apex-pie-pelanggan");
        if (!el) return;

        fetch("{{ route('admin.dashboard.pelanggan.chart') }}")
            .then(res => res.json())
            .then(data => {

                const laki = data.laki_laki ?? 0;
                const perempuan = data.perempuan ?? 0;
                const total = laki + perempuan;

                // update angka
                document.getElementById("total-pelanggan").innerText = total;
                document.getElementById("count-laki").innerText = laki;
                document.getElementById("count-perempuan").innerText = perempuan;

                // clear container (IMPORTANT)
                el.innerHTML = "";

                const options = {
                    series: [laki, perempuan],
                    chart: {
                        type: 'donut',
                        height: 280
                    },
                    labels: ['Laki-laki', 'Perempuan'],
                    colors: ['#0d6efd', '#dc3545'],
                    legend: {
                        position: 'bottom'
                    },
                    plotOptions: {
                        pie: {
                            donut: {
                                size: '70%'
                            }
                        }
                    }
                };

                const chart = new ApexCharts(el, options);
                chart.render();

            })
            .catch(err => {
                console.error("Chart error:", err);
                el.innerHTML = "<div class='text-danger text-center'>Gagal load chart</div>";
            });

    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {

        var options = {

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
                    borderRadius: 6,
                    columnWidth: '50%',
                    distributed: true
                }
            },

            colors: [
                '#ffc107', // pending
                '#198754', // confirmed
                '#0dcaf0', // checkin
                '#6c757d', // checkout
                '#dc3545' // cancelled
            ],

            dataLabels: {
                enabled: true
            },

            stroke: {
                show: true,
                width: 2,
                colors: ['transparent']
            },

            xaxis: {
                categories: [
                    'Pending',
                    'Confirmed',
                    'Check In',
                    'Check Out',
                    'Cancelled'
                ]
            },

            yaxis: {
                title: {
                    text: 'Jumlah Reservasi'
                }
            },

            fill: {
                opacity: 1
            },

            tooltip: {
                y: {
                    formatter: function(val) {
                        return val + " reservasi";
                    }
                }
            },

            noData: {
                text: 'Belum ada data reservasi'
            }
        };

        var chart = new ApexCharts(
            document.querySelector("#apex-column-1"),
            options
        );

        chart.render();

    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {

        let chart;

        function loadReservasiChart(periode = 'monthly') {
            $.ajax({
                url: "{{ route('dashboard.reservasi-line') }}", // sesuaikan route
                method: 'GET',
                data: {
                    periode: periode
                },
                success: function(response) {

                    if (chart) chart.destroy();

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
                            hover: {
                                size: 7
                            }
                        },
                        xaxis: {
                            categories: response.labels,
                            tickPlacement: 'on'
                        },
                        yaxis: {
                            title: {
                                text: 'Jumlah Reservasi'
                            },
                            min: 0
                        },
                        legend: {
                            position: 'top',
                            horizontalAlign: 'right'
                        },
                        tooltip: {
                            shared: true,
                            intersect: false,
                        },
                        grid: {
                            borderColor: '#e5e7eb'
                        }
                    };

                    chart = new ApexCharts(document.querySelector("#apex-line-reservasi"), options);
                    chart.render();
                }
            });
        }

        // Load default
        loadReservasiChart();

        // Event change periode
        $('#periode-reservasi').on('change', function() {
            loadReservasiChart(this.value);
        });
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
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Klik pada baris tabel
            document.querySelectorAll('.table-row-clickable').forEach(row => {
                row.addEventListener('click', function() {
                    const href = this.getAttribute('data-href');
                    if (href) window.location.href = href;
                });
            });
        });
    </script>
@endpush
