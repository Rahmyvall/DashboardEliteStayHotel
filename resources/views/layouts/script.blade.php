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
