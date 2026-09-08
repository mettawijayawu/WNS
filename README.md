# WNS (Watermelon Noodles & Smoothie) - Web Store & Management System

WNS adalah platform web e-commerce dan sistem manajemen toko untuk penjualan **Watermelon Noodles & Smoothie**. Dibuat secara murni dari awal (*custom native build*) tanpa mengandalkan framework backend, sistem ini dirancang untuk mempermudah pemesanan menu WNS secara online, penghitungan total pesanan otomatis, konfirmasi pembayaran, pengiriman bon/struk transaksi via WhatsApp dan Email, serta pemantauan total pemasokan (pendapatan) toko pada dashboard admin.

---

## 🍉 Fitur Utama

### 🛒 1. Sisi Pengguna / Pelanggan (Customer Store)
- **Informasi & Penjelasan WNS:** Menyediakan informasi komprehensif mengenai konsep dan keunggulan menu Watermelon Noodles & Smoothie.
- **Toko / Katalog Produk (Store & Shop):**
  - Tampilan daftar produk Watermelon Noodles & Smoothie.
  - **Kalkulasi Otomatis (Automatic Totals):** Menghitung total harga, item, dan rincian belanjaan secara real-time saat pelanggan memilih menu.
- **Sistem Pembayaran:**
  - Form pembayaran dan konfirmasi yang responsif.
  - **Pengiriman Bon/Struk Otomatis:** Setelah pembayaran dikonfirmasi, bukti transaksi/bon dikirimkan langsung ke **WhatsApp** dan **Email** pelanggan.

### 🛡️ 2. Sisi Administrator (Admin Dashboard)
- **Pemantauan Total Pemasokan (Revenue Tracking):**
  - Melihat akumulasi total pemasokan/omset dari penjualan Watermelon Noodles & Smoothie secara terstruktur.
- **Manajemen Pesanan & Produk:**
  - Mengelola daftar menu, harga, status pembayaran, serta daftar transaksi masuk.

---

## 🛠️ Teknologi yang Digunakan (Tech Stack)

- **Frontend:** HTML5, CSS3, JavaScript (Vanilla JS)
- **Backend:** Native PHP (*Built from Scratch*)
- **Database:** MySQL / MariaDB
- **Integrasi Notifikasi:**
  - **WhatsApp API Gateway:** Pengiriman otomatis struk belanja via WhatsApp.
  - **Email Service (SMTP):** Pengiriman otomatis bukti transaksi via Email.

---

## 📋 Prasyarat (Prerequisites)

Sebelum menjalankan aplikasi di lingkungan lokal, pastikan Anda telah memasang:
- **Web Server:** XAMPP / Laragon / Apache / Nginx
- **PHP:** Versi 7.4 / 8.x
- **Database:** MySQL / MariaDB

---

## ⚙️ Cara Instalasi & Menjalankan (Installation Guide)

1. **Clone Repositori**
   Clone repositori ke dalam direktori web server Anda (`htdocs` pada XAMPP atau `www` pada Laragon):
   ```bash
   git clone https://github.com/mettawijayawu/WNS.git
   cd WNS
   ```

2. **Pengaturan Database**
   - Buka **phpMyAdmin** (`http://localhost/phpmyadmin`).
   - Buat database baru (contoh: `wns_db`).
   - Impor file SQL database (misalnya `wns.sql` atau `database.sql`) yang tersedia di repositori.

3. **Konfigurasi File Koneksi & API**
   - Sesuaikan file koneksi database (misalnya `koneksi.php`, `config.php`, atau `db.php`):
     ```php
     $host = "localhost";
     $user = "root";
     $pass = "";
     $db   = "wns_db";
     ```
   - Atur kredensial/token untuk **WhatsApp Gateway** dan **SMTP Email** pada file konfigurasi API yang bersangkutan.

4. **Menjalankan Web**
   - Aktifkan modul **Apache** & **MySQL** pada control panel XAMPP/Laragon.
   - Buka browser dan akses alamat:
     ```
     http://localhost/WNS
     ```

---

## 🍜 Alur Pemesanan (Workflow)

1. Pelanggan membaca informasi produk dan memilih menu **Watermelon Noodles & Smoothie** di halaman Store.
2. Total pembayaran dihitung secara otomatis oleh sistem.
3. Pelanggan melakukan konfirmasi dan proses pembayaran.
4. Sistem backend native memproses pesanan dan langsung mengirimkan **bon/struk transaksi** ke **WhatsApp** & **Email** pelanggan.
5. Admin dapat melihat pembaruan transaksi dan **total pemasokan toko** secara real-time di Dashboard Admin.

---

## 📄 Lisensi

Proyek ini dikembangkan secara murni (*custom build*) untuk operasional penjualan Watermelon Noodles & Smoothie (WNS). All Rights Reserved.
