<p align="center">
  <a href="https://laravel.com" target="_blank">
    <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
  </a>
</p>

<h1 align="center">Hotel Management Dashboard</h1>

<p align="center">
Dashboard manajemen hotel modern berbasis Laravel yang dirancang untuk memantau dan mengelola operasional hotel secara real-time secara efisien, terintegrasi, dan mudah digunakan.
</p>

<p align="center">
<a href="https://github.com/laravel/framework/actions">
<img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status">
</a>
<a href="https://packagist.org/packages/laravel/framework">
<img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads">
</a>
<a href="https://packagist.org/packages/laravel/framework">
<img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version">
</a>
<a href="https://packagist.org/packages/laravel/framework">
<img src="https://img.shields.io/packagist/l/laravel/framework" alt="License">
</a>
</p>

---

## 📌 Tentang Project

Hotel Management Dashboard merupakan aplikasi manajemen hotel modern yang dikembangkan menggunakan framework Laravel untuk membantu proses operasional hotel menjadi lebih efektif, cepat, dan terintegrasi dalam satu sistem.

Aplikasi ini menyediakan fitur pengelolaan hotel secara real-time yang mencakup:

- Manajemen reservasi kamar
- Pengelolaan data tamu
- Monitoring ketersediaan kamar
- Transaksi pembayaran
- Dashboard statistik operasional
- Laporan performa hotel
- Sistem administrasi terintegrasi

Dengan desain antarmuka yang modern, responsif, dan user-friendly, sistem ini dirancang untuk meningkatkan efisiensi kerja staf hotel serta mempermudah proses monitoring dan pengambilan keputusan.

---

# 🛠 Framework & Technology Stack

| Technology                   | Description                            |
| ---------------------------- | -------------------------------------- |
| **Laravel**                  | Backend framework utama berbasis PHP   |
| **PHP**                      | Bahasa pemrograman server-side         |
| **MySQL**                    | Database management system             |
| **Bootstrap / Tailwind CSS** | Framework UI & styling modern          |
| **JavaScript**               | Interaktivitas dan manipulasi frontend |
| **Blade Template Engine**    | Template engine bawaan Laravel         |
| **Eloquent ORM**             | ORM Laravel untuk manajemen database   |
| **Laravel Authentication**   | Sistem autentikasi dan keamanan user   |

---

## 🚀 Fitur Utama

- ✅ Dashboard Monitoring Real-Time
- ✅ Sistem Reservasi Hotel
- ✅ Manajemen Data Tamu
- ✅ Status & Ketersediaan Kamar
- ✅ Manajemen Pembayaran
- ✅ Riwayat Transaksi
- ✅ Laporan dan Analitik
- ✅ User Management & Authentication
- ✅ Responsive Admin Dashboard

---

## 📂 Struktur Sistem

```bash
Hotel Management Dashboard
│── Authentication System
│── Reservation Management
│── Guest Management
│── Room Management
│── Payment Transaction
│── Reporting System
│── Dashboard Analytics
└── Admin Panel
```

# Clone repository

git clone https://github.com/Rahmyvall/DashboardEliteStayHotel.git

# Masuk ke folder project

cd hotel-management-dashboard

# Install dependency

composer install

# Copy environment

cp .env.example .env

# Generate application key

php artisan key:generate

# Migrasi database

php artisan migrate

# Jalankan server

php artisan serve
