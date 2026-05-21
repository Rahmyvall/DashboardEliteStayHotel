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

---

## 📸 Screenshot Aplikasi

### 🧩 ER Diagram

<p align="center">
  <img src="/assets/erd.png" width="90%" alt="ER Diagram">
</p>

### 🖥 Dashboard Utama

<p align="center">
  <img src="https://via.placeholder.com/1000x500.png?text=Dashboard+Hotel+Management" width="90%" alt="Dashboard">
</p>

### 🛎 Manajemen Reservasi

<p align="center">
  <img src="https://via.placeholder.com/1000x500.png?text=Reservation+Management" width="90%" alt="Reservation">
</p>

### 🏨 Manajemen Kamar

<p align="center">
  <img src="https://via.placeholder.com/1000x500.png?text=Room+Management" width="90%" alt="Room Management">
</p>

---

## 🧩 Fitur Sistem

- Manajemen reservasi kamar
- Pengelolaan data tamu
- Monitoring ketersediaan kamar
- Transaksi pembayaran
- Dashboard statistik operasional
- Laporan performa hotel
- Sistem administrasi terintegrasi
- User management & authentication

---

## 🛠 Technology Stack (Client & HRD Overview)

| Technology               | Role in System         | Business Value                                     |
| ------------------------ | ---------------------- | -------------------------------------------------- |
| Laravel                  | Core backend system    | Stabil, scalable, dan aman untuk sistem perusahaan |
| PHP                      | Server-side processing | Performa cepat dan efisien                         |
| MySQL                    | Database management    | Data hotel terstruktur dan aman                    |
| Bootstrap / Tailwind CSS | UI design system       | Tampilan modern & mudah digunakan                  |
| JavaScript               | Frontend interaction   | UX lebih interaktif dan responsif                  |
| Blade Template Engine    | UI rendering           | Pengembangan UI lebih cepat                        |
| Eloquent ORM             | Database layer         | Pengelolaan data lebih efisien                     |
| Laravel Authentication   | Security system        | Proteksi akses berdasarkan role                    |

---

## 🚀 Cara Install

```bash
git clone https://github.com/Rahmyvall/DashboardEliteStayHotel.git

cd hotel-management-dashboard

composer install

cp .env.example .env

php artisan key:generate

php artisan migrate

php artisan serve
```
