# Aplikasi Perpustakaan Digital Kampus

Aplikasi manajemen perpustakaan berbasis **Laravel 12** yang dilengkapi dengan autentikasi session, otorisasi berbasis role, relasi antar entitas (Eloquent ORM), penyediaan REST API, serta konsumsi REST API internal untuk dashboard statistik dan laporan peminjaman.

---

## 🚀 Fitur Utama

1. **Autentikasi & Otorisasi**
   - Sistem login/logout manual berbasis session.
   - Proteksi route dengan middleware `auth`.
   - Pembagian hak akses peran (**Admin** & **Petugas**) menggunakan middleware `CheckAdminRole`.
   - Admin memiliki akses penuh termasuk pengelolaan Kategori Buku. Petugas berfokus pada Buku, Anggota, Transaksi Peminjaman, dan Pengembalian.
   - Manajemen profil dan ganti password user.

2. **Master Data & Relasi Eloquent**
   - **Kategori Buku** (One-to-Many ke Buku).
   - **Buku** (Many-to-One ke Kategori, Many-to-Many ke Peminjaman melalui Loan Items).
   - **Anggota** (One-to-Many ke Peminjaman, pencarian nama/NIM).
   - **Peminjaman (Loans)**:
     - Relasi ke Anggota (`member_id`), Petugas (`user_id`), dan multi-buku (`loan_items`).
     - Alur status: `dipinjam`, `dikembalikan`, `terlambat`.
     - Tombol aksi pengembalian cepat satu-klik (`PATCH /loans/{id}/kembalikan`).

3. **REST API (JSON)**
   - Tersedia endpoint publik di prefix `/api`:
     - `GET /api/books`, `POST /api/books`, `GET /api/books/{id}`, `PUT /api/books/{id}`, `DELETE /api/books/{id}`
     - `GET /api/members`, `GET /api/members/{id}`
     - `GET /api/loans`, `POST /api/loans`, `PATCH /api/loans/{id}/kembalikan`
     - `GET /api/stats`
   - Transformasi data response konsisten menggunakan API Resources. Dokumentasi lengkap ada di [API.md](API.md).

4. **Konsumsi API Internal (Client-Side Blade)**
   - **Dashboard**: Mengonsumsi `GET /api/stats` menggunakan Laravel HTTP Client (`Http::get()`) untuk menampilkan ringkasan kartu statistik realtime.
   - **Laporan Peminjaman**: Mengonsumsi `GET /api/loans` dengan opsi filter status (`dipinjam`, `dikembalikan`, `terlambat`).

5. **Data Realistis (Seeder & Factory)**
   - Menggunakan Faker locale Indonesia (`id_ID`).
   - Seeder mencakup User, Kategori, Buku (manual + factory), Anggota (manual + factory), dan Transaksi Peminjaman beragam status.

6. **Custom Pagination**
   - Menggunakan template pagination mandiri tanpa dependensi CSS framework eksternal.

---

## 👥 Akun Demo Pengujian

Semua akun default menggunakan password: `password`

| Peran | Nama | Email | Hak Akses |
|---|---|---|---|
| **Admin** | Bambang Sutrisno | `admin@pens.ac.id` | Dashboard, Buku, Kategori (CRUD), Anggota, Peminjaman, Laporan, Profil |
| **Petugas 1** | Siti Rahmawati | `petugas1@pens.ac.id` | Dashboard, Buku, Anggota, Peminjaman, Laporan, Profil |
| **Petugas 2** | Ahmad Fauzi | `petugas2@pens.ac.id` | Dashboard, Buku, Anggota, Peminjaman, Laporan, Profil |

---

## 🛠️ Panduan Instalasi & Menjalankan Project

### 1. Clone Repository
```bash
git clone https://github.com/Dinataaa1/perpustakaan.git
cd perpustakaan
```

### 2. Install Dependensi PHP
```bash
composer install
```

### 3. Konfigurasi Environment (`.env`)
Salin file `.env.example` ke `.env`:
```bash
copy .env.example .env
```
Pastikan pengaturan berikut ada di dalam file `.env`:
```env
APP_FAKER_LOCALE=id_ID
DB_CONNECTION=sqlite
INTERNAL_API_URL=http://127.0.0.1:8011
```
*Catatan: Pastikan baris `PHP_CLI_SERVER_WORKERS` tetap di-comment (`# PHP_CLI_SERVER_WORKERS=4`) pada environment Windows.*

### 4. Generate Application Key
```bash
php artisan key:generate
```

### 5. Jalankan Migration & Seeder
```bash
php artisan migrate:fresh --seed
```

---

## ⚡ Cara Menjalankan Server

Karena aplikasi Blade mengonsumsi REST API miliknya sendiri melalui HTTP Client, jalankan **dua server lokal** di port berbeda agar tidak terjadi deadlock pemanggilan request:

### Terminal 1: Server Web Utama (Port 8000)
```bash
php artisan serve --no-reload --port=8000
```
Buka browser di: `http://127.0.0.1:8000`

### Terminal 2: Server API Internal (Port 8011)
```bash
php artisan serve --no-reload --port=8011
```
Server ini melayani pemanggilan `INTERNAL_API_URL=http://127.0.0.1:8011` yang dipanggil oleh Dashboard dan Laporan.

---

## 📖 Dokumentasi Lanjutan
- **[DEMO.md](DEMO.md)** : Skenario pengujian & demo aplikasi langkah demi langkah.
- **[API.md](API.md)** : Dokumentasi lengkap seluruh endpoint REST API dan contoh respon JSON.
