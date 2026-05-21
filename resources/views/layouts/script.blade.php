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
    // TRANSLATIONS
    // =========================
    const translations = {

        // ENGLISH
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
            notifikasi: "Notifications"
        },

        // INDONESIA
        id: {
            menu: "Menu",
            data_master: "Data Master",
            transaksi: "Transaksi",
            lainnya: "Lainnya",
            fitur_lainnya: "Fitur Lainnya",

            dashboard: "Dashboard",
            users: "Users",
            pelanggan: "Pelanggan",
            tipe_kamar: "Tipe Kamar",
            kamar: "Kamar",
            fasilitas: "Fasilitas",
            tipe_kamar_fasilitas: "Tipe Kamar Fasilitas",

            reservasi: "Reservasi",
            detail_reservasi: "Detail Reservasi",
            pembayaran: "Pembayaran",
            checkin_checkout: "Check In / Check Out",

            review: "Review",
            promo: "Promo",
            reservasi_promo: "Reservasi Promo",
            log_aktivitas: "Log Aktivitas",
            notifikasi: "Notifikasi"
        },

        // GERMAN
        de: {
            menu: "Menü",
            data_master: "Masterdaten",
            transaksi: "Transaktionen",
            lainnya: "Andere",
            fitur_lainnya: "Weitere Funktionen",

            dashboard: "Instrumententafel",
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
            promo: "Promo",
            reservasi_promo: "Promo Reservierungen",
            log_aktivitas: "Aktivitätsprotokoll",
            notifikasi: "Benachrichtigungen"
        },

        // SPANISH
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
            notifikasi: "Notificaciones"
        },

        // ITALIAN
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
            notifikasi: "Notifiche"
        },

        // RUSSIAN
        ru: {
            menu: "Меню",
            data_master: "Основные Данные",
            transaksi: "Транзакции",
            lainnya: "Другое",
            fitur_lainnya: "Другие Функции",

            dashboard: "Панель",
            users: "Пользователи",
            pelanggan: "Клиенты",
            tipe_kamar: "Типы Комнат",
            kamar: "Комнаты",
            fasilitas: "Удобства",
            tipe_kamar_fasilitas: "Удобства Типа Комнаты",

            reservasi: "Бронирования",
            detail_reservasi: "Детали Бронирования",
            pembayaran: "Платежи",
            checkin_checkout: "Заезд / Выезд",

            review: "Отзывы",
            promo: "Акции",
            reservasi_promo: "Акционные Бронирования",
            log_aktivitas: "Журнал Активности",
            notifikasi: "Уведомления"
        }

    };

    // =========================
    // DEFAULT LANGUAGE
    // =========================
    const savedLang = localStorage.getItem("dashboard_language") || "en";

    applyLanguage(savedLang);

    // =========================
    // CLICK LANGUAGE
    // =========================
    languageButtons.forEach(button => {

        button.addEventListener("click", function() {

            const lang = this.dataset.lang;

            localStorage.setItem("dashboard_language", lang);

            applyLanguage(lang);

        });

    });

    // =========================
    // APPLY LANGUAGE
    // =========================
    function applyLanguage(lang) {

        const t = translations[lang];

        if (!t) return;

        // FLAG & TEXT
        const selected = document.querySelector(`[data-lang="${lang}"]`);

        currentFlag.src = selected.dataset.flag;
        currentText.innerText = selected.dataset.text;

        // MENU TITLE
        const menuTitles = document.querySelectorAll(".menu-title");

        if (menuTitles[0]) menuTitles[0].innerText = t.menu;
        if (menuTitles[1]) menuTitles[1].innerText = t.data_master;
        if (menuTitles[2]) menuTitles[2].innerText = t.transaksi;
        if (menuTitles[3]) menuTitles[3].innerText = t.lainnya;

        // MENU TEXT
        document.querySelectorAll(".menu-text").forEach(el => {

            const key = el.dataset.key;

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