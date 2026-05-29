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
    document.addEventListener("DOMContentLoaded", function() {

        const languageButtons = document.querySelectorAll(".change-language");
        const currentFlag = document.getElementById("current-language-flag");
        const currentText = document.getElementById("current-language-text");

        // =========================
        // TRANSLATIONS (Lengkap + Tabel Users)
        // =========================
        const translations = {
            en: {
                menu: "Menu",
                data_master: "Master Data",
                transaksi: "Transactions",
                lainnya: "Others",
                fitur_lainnya: "Other Features",

                dashboard: "Dashboard",
                users: "Users",
                pelanggan: "Customers",
                tipe_kamar: "Room Types",
                kamar: "Rooms",
                fasilitas: "Facilities",
                tipe_kamar_fasilitas: "Room Type Facilities",

                reservasi: "Reservations",
                detail_reservasi: "Reservation Details",
                pembayaran: "Payments",
                checkin_checkout: "Check In / Check Out",

                review: "Reviews",
                promo: "Promos",
                reservasi_promo: "Promo Reservations",
                log_aktivitas: "Activity Logs",
                notifikasi: "Notifications",

                // === TABEL USERS ===
                id: "ID",
                nama: "Name",
                email: "Email",
                role: "Role",
                status: "Status",
                tanggal_dibuat: "Created At",
                aksi: "Actions",
                tambah_user: "Add User",
                edit: "Edit",
                hapus: "Delete",
                aktif: "Active",
                nonaktif: "Inactive",
                semua: "All",
                cari: "Search",
                tidak_ada_data: "No data available",
                tampilkan: "Showing",
                dari: "to",
                entri: "entries"
            },

            id: {
                menu: "Menu",
                data_master: "Data Master",
                transaksi: "Transaksi",
                lainnya: "Lainnya",
                fitur_lainnya: "Fitur Lainnya",

                dashboard: "Dashboard",
                users: "Pengguna",
                pelanggan: "Pelanggan",
                tipe_kamar: "Tipe Kamar",
                kamar: "Kamar",
                fasilitas: "Fasilitas",
                tipe_kamar_fasilitas: "Fasilitas Tipe Kamar",

                reservasi: "Reservasi",
                detail_reservasi: "Detail Reservasi",
                pembayaran: "Pembayaran",
                checkin_checkout: "Check In / Check Out",

                review: "Ulasan",
                promo: "Promo",
                reservasi_promo: "Reservasi Promo",
                log_aktivitas: "Log Aktivitas",
                notifikasi: "Notifikasi",

                // === TABEL USERS ===
                id: "ID",
                nama: "Nama",
                email: "Email",
                role: "Peran",
                status: "Status",
                tanggal_dibuat: "Tanggal Dibuat",
                aksi: "Aksi",
                tambah_user: "Tambah Pengguna",
                edit: "Edit",
                hapus: "Hapus",
                aktif: "Aktif",
                nonaktif: "Nonaktif",
                semua: "Semua",
                cari: "Cari",
                tidak_ada_data: "Tidak ada data",
                tampilkan: "Menampilkan",
                dari: "sampai",
                entri: "entri"
            },

            de: {
                menu: "Menü",
                data_master: "Masterdaten",
                transaksi: "Transaktionen",
                lainnya: "Andere",
                fitur_lainnya: "Weitere Funktionen",

                dashboard: "Dashboard",
                users: "Benutzer",
                pelanggan: "Kunden",
                tipe_kamar: "Zimmertypen",
                kamar: "Zimmer",
                fasilitas: "Einrichtungen",
                tipe_kamar_fasilitas: "Zimmertyp Einrichtungen",

                reservasi: "Reservierungen",
                detail_reservasi: "Reservierungsdetails",
                pembayaran: "Zahlungen",
                checkin_checkout: "Check-In / Check-Out",

                review: "Bewertungen",
                promo: "Angebote",
                reservasi_promo: "Promo Reservierungen",
                log_aktivitas: "Aktivitätsprotokoll",
                notifikasi: "Benachrichtigungen",

                // === TABEL USERS ===
                id: "ID",
                nama: "Name",
                email: "E-Mail",
                role: "Rolle",
                status: "Status",
                tanggal_dibuat: "Erstellt am",
                aksi: "Aktionen",
                tambah_user: "Benutzer hinzufügen",
                edit: "Bearbeiten",
                hapus: "Löschen",
                aktif: "Aktiv",
                nonaktif: "Inaktiv",
                semua: "Alle",
                cari: "Suchen",
                tidak_ada_data: "Keine Daten verfügbar",
                tampilkan: "Zeige",
                dari: "bis",
                entri: "Einträge"
            },

            es: {
                menu: "Menú",
                data_master: "Datos Maestros",
                transaksi: "Transacciones",
                lainnya: "Otros",
                fitur_lainnya: "Otras Funciones",

                dashboard: "Panel",
                users: "Usuarios",
                pelanggan: "Clientes",
                tipe_kamar: "Tipos de Habitación",
                kamar: "Habitaciones",
                fasilitas: "Instalaciones",
                tipe_kamar_fasilitas: "Instalaciones del Tipo de Habitación",

                reservasi: "Reservas",
                detail_reservasi: "Detalles de Reserva",
                pembayaran: "Pagos",
                checkin_checkout: "Check In / Check Out",

                review: "Reseñas",
                promo: "Promociones",
                reservasi_promo: "Reservas Promocionales",
                log_aktivitas: "Registro de Actividades",
                notifikasi: "Notificaciones",

                // === TABEL USERS ===
                id: "ID",
                nama: "Nombre",
                email: "Correo",
                role: "Rol",
                status: "Estado",
                tanggal_dibuat: "Creado en",
                aksi: "Acciones",
                tambah_user: "Agregar Usuario",
                edit: "Editar",
                hapus: "Eliminar",
                aktif: "Activo",
                nonaktif: "Inactivo",
                semua: "Todos",
                cari: "Buscar",
                tidak_ada_data: "No hay datos disponibles",
                tampilkan: "Mostrando",
                dari: "a",
                entri: "entradas"
            },

            it: {
                menu: "Menu",
                data_master: "Dati Principali",
                transaksi: "Transazioni",
                lainnya: "Altro",
                fitur_lainnya: "Altre Funzioni",

                dashboard: "Dashboard",
                users: "Utenti",
                pelanggan: "Clienti",
                tipe_kamar: "Tipi di Camera",
                kamar: "Camere",
                fasilitas: "Servizi",
                tipe_kamar_fasilitas: "Servizi Tipo Camera",

                reservasi: "Prenotazioni",
                detail_reservasi: "Dettagli Prenotazione",
                pembayaran: "Pagamenti",
                checkin_checkout: "Check In / Check Out",

                review: "Recensioni",
                promo: "Promozioni",
                reservasi_promo: "Prenotazioni Promo",
                log_aktivitas: "Registro Attività",
                notifikasi: "Notifiche",

                // === TABEL USERS ===
                id: "ID",
                nama: "Nome",
                email: "Email",
                role: "Ruolo",
                status: "Stato",
                tanggal_dibuat: "Creato il",
                aksi: "Azioni",
                tambah_user: "Aggiungi Utente",
                edit: "Modifica",
                hapus: "Elimina",
                aktif: "Attivo",
                nonaktif: "Inattivo",
                semua: "Tutti",
                cari: "Cerca",
                tidak_ada_data: "Nessun dato disponibile",
                tampilkan: "Mostrando",
                dari: "a",
                entri: "voci"
            },

            ru: {
                menu: "Меню",
                data_master: "Основные Данные",
                transaksi: "Транзакции",
                lainnya: "Другое",
                fitur_lainnya: "Другие Функции",

                dashboard: "Панель управления",
                users: "Пользователи",
                pelanggan: "Клиенты",
                tipe_kamar: "Типы Номеров",
                kamar: "Номера",
                fasilitas: "Удобства",
                tipe_kamar_fasilitas: "Удобства Типа Номера",

                reservasi: "Бронирования",
                detail_reservasi: "Детали Бронирования",
                pembayaran: "Платежи",
                checkin_checkout: "Заезд / Выезд",

                review: "Отзывы",
                promo: "Акции",
                reservasi_promo: "Акционные Бронирования",
                log_aktivitas: "Журнал Активности",
                notifikasi: "Уведомления",

                // === TABEL USERS ===
                id: "ID",
                nama: "Имя",
                email: "Электронная почта",
                role: "Роль",
                status: "Статус",
                tanggal_dibuat: "Создано",
                aksi: "Действия",
                tambah_user: "Добавить пользователя",
                edit: "Редактировать",
                hapus: "Удалить",
                aktif: "Активен",
                nonaktif: "Неактивен",
                semua: "Все",
                cari: "Поиск",
                tidak_ada_data: "Нет данных",
                tampilkan: "Показано",
                dari: "до",
                entri: "записей"
            }
        };

        // Default Language
        let currentLang = localStorage.getItem("dashboard_language") || "en";
        applyLanguage(currentLang);

        // Language Button Click
        languageButtons.forEach(button => {
            button.addEventListener("click", function() {
                const lang = this.dataset.lang;
                localStorage.setItem("dashboard_language", lang);
                applyLanguage(lang);
            });
        });

        // Apply Language Function
        function applyLanguage(lang) {
            const t = translations[lang];
            if (!t) return;

            // Update Flag & Text
            const selected = document.querySelector(`[data-lang="${lang}"]`);
            if (selected) {
                currentFlag.src = selected.dataset.flag;
                currentText.innerText = selected.dataset.text;
            }

            // Update Menu Titles
            const menuTitles = document.querySelectorAll(".menu-title");
            if (menuTitles[0]) menuTitles[0].innerText = t.menu;
            if (menuTitles[1]) menuTitles[1].innerText = t.data_master;
            if (menuTitles[2]) menuTitles[2].innerText = t.transaksi;
            if (menuTitles[3]) menuTitles[3].innerText = t.lainnya;

            // Update Menu Text (data-key)
            document.querySelectorAll(".menu-text").forEach(el => {
                const key = el.dataset.key;
                if (key && t[key]) {
                    el.innerText = t[key];
                }
            });

            // Update Table & Other Elements (data-translate)
            document.querySelectorAll("[data-translate]").forEach(el => {
                const key = el.dataset.translate;
                if (key && t[key]) {
                    el.innerText = t[key];
                }
            });
        }
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {

        const translations = {
            en: {
                dashboard: "Dashboard",
                users: "Users"
            },
            id: {
                dashboard: "Dashboard",
                users: "Pengguna"
            }
        };

        function applyLanguage(lang) {
            const t = translations[lang];
            if (!t) return;

            document.querySelectorAll(".menu-text").forEach(el => {
                const key = el.dataset.key;
                if (t[key]) el.innerText = t[key];
            });
        }

        const saved = localStorage.getItem("lang") || "en";
        applyLanguage(saved);

        document.querySelectorAll(".change-language").forEach(btn => {
            btn.addEventListener("click", function() {
                const lang = this.dataset.lang;
                localStorage.setItem("lang", lang);
                applyLanguage(lang);
            });
        });

    });
</script>
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
