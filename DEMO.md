# Skenario Demo Aplikasi Perpustakaan Digital Kampus

Dokumen ini memuat langkah-langkah pengujian (skenario demo) aplikasi secara menyeluruh dari awal hingga akhir, mencakup autentikasi, otorisasi, operasi CRUD, eager loading, konsumsi REST API internal, dan pengujian endpoint API.

---

## Persiapan Sebelum Demo

1. **Jalankan Terminal 1 (Aplikasi Web):**
   ```bash
   php artisan serve --no-reload --port=8000
   ```
2. **Jalankan Terminal 2 (Internal API Server):**
   ```bash
   php artisan serve --no-reload --port=8011
   ```
3. Akses antarmuka aplikasi melalui browser di `http://127.0.0.1:8000`.

---

## Skenario 1: Autentikasi & Landing Page Dashboard

1. Akses halaman utama `http://127.0.0.1:8000/`. Karena belum login, sistem secara otomatis mengarahkan ke `/login`.
2. Masukkan kredensial akun **Admin**:
   - **Email:** `admin@pens.ac.id`
   - **Password:** `password`
3. Klik tombol **Login**.
4. **Hasil yang diharapkan:**
   - Berhasil masuk dan diarahkan langsung ke halaman **Dashboard** (`/`).
   - Tampil pesan flash sukses: *"Login berhasil, selamat datang Bambang Sutrisno."*
   - Pada navbar bagian kanan atas tampil nama `Bambang Sutrisno (Admin)` beserta tombol Logout.
   - Menu navigasi menampilkan seluruh menu: `Dashboard`, `Buku`, `Kategori`, `Anggota`, `Peminjaman`, `Laporan`, `Profil`.
   - Empat kartu statistik tampil terisi angka dinamis yang diambil dari `GET http://127.0.0.1:8011/api/stats`:
     - Total Buku
     - Total Anggota
     - Sedang Dipinjam
     - Dikembalikan

---

## Skenario 2: Otorisasi & Manajemen Kategori (Khusus Admin)

1. Klik menu **Kategori** di navbar (`/categories`).
2. Tampil daftar kategori yang sudah terisi dari seeder (Fiksi, Teknologi, Sains, Sejarah, Bisnis & Ekonomi, Pengembangan Diri).
3. Buat kategori baru:
   - Nama Kategori: `Ensiklopedia`
   - Deskripsi: `Buku referensi komprehensif sains dan wawasan dunia.`
   - Klik **Simpan**.
4. **Hasil yang diharapkan:** Kategori baru muncul dalam daftar tabel kategori.

---

## Skenario 3: Manajemen Buku & Relasi Kategori

1. Klik menu **Buku** di navbar (`/books`).
2. Perhatikan pagination di bawah tabel buku (menampilkan daftar dengan tombol pagination custom).
3. Kolom "Kategori" menampilkan nama teks kategori (hasil eager loading `category`), bukan hanya angka ID.
4. Klik **Tambah Buku Baru** (`/books/create`):
   - **Judul:** `Arsitektur Komputer Modern`
   - **Penulis:** `Andrew S. Tanenbaum`
   - **Penerbit:** `Pearson`
   - **Tahun Terbit:** `2021`
   - **ISBN:** `9780133591620`
   - **Stok:** `5`
   - **Kategori:** Pilih `Teknologi`
5. Klik **Simpan Buku**.
6. **Hasil yang diharapkan:** Buku tersimpan dan muncul dalam daftar buku.

---

## Skenario 4: Manajemen Anggota & Riwayat Peminjaman

1. Klik menu **Anggota** di navbar (`/members`).
2. Masukkan kata kunci nama/NIM di kolom pencarian (misal: `Siti`) dan tekan enter / tombol cari.
3. Klik tombol **Detail** pada salah satu anggota (misal: `Siti Aminah`).
4. **Hasil yang diharapkan:**
   - Halaman detail anggota menampilkan identitas lengkap (NIM, Nama, Email, No. HP, Status).
   - Di bagian bawah, tampil tabel **Riwayat Peminjaman** milik anggota tersebut yang memuat nama petugas pencatat, tanggal transaksi, buku-buku yang dipinjam, serta badge status.

---

## Skenario 5: Transaksi Peminjaman Baru

1. Klik menu **Peminjaman** di navbar (`/loans`).
2. Klik tombol **Tambah Peminjaman** (`/loans/create`).
3. Form peminjaman menampilkan informasi:
   - **Petugas:** Teks nama login otomatis (misal: `Bambang Sutrisno`), tanpa dropdown manual.
   - **Pilih Anggota:** Pilih salah satu anggota dari dropdown.
   - **Tanggal Pinjam:** Terisi default tanggal hari ini.
   - **Tanggal Batas Kembali:** Terisi default 7 hari ke depan.
   - **Pilih Buku:** Centang satu atau dua judul buku yang ingin dipinjam.
4. Klik **Simpan Peminjaman**.
5. **Hasil yang diharapkan:**
   - Data peminjaman tersimpan dan masuk ke daftar tabel peminjaman dengan status badge kuning `Dipinjam`.

---

## Skenario 6: Proses Pengembalian Buku

1. Pada halaman daftar peminjaman (`/loans`), temukan baris data peminjaman yang berstatus `Dipinjam`.
2. Klik tombol hijau **Kembalikan** pada kolom Aksi.
3. **Hasil yang diharapkan:**
   - Muncul alert sukses: *"Buku berhasil dikembalikan."*
   - Status peminjaman berubah menjadi badge hijau `Dikembalikan`.
   - Tombol "Kembalikan" otomatis hilang karena transaksi sudah selesai.

---

## Skenario 7: Laporan Peminjaman (Konsumsi REST API)

1. Klik menu **Laporan** di navbar (`/loans/report`).
2. Halaman ini mengambil data langsung dari `GET http://127.0.0.1:8011/api/loans` melalui Laravel HTTP Client.
3. Coba fitur filter status:
   - Pilih **Sedang Dipinjam**, tabel otomatis menampilkan transaksi yang berstatus dipinjam saja.
   - Pilih **Dikembalikan**, tabel menampilkan transaksi yang sudah dikembalikan lengkap dengan tanggal pengembaliannya.
   - Pilih **Terlambat**, tabel menampilkan transaksi yang melebihi batas waktu.
   - Klik **Reset** untuk kembali melihat semua transaksi.

---

## Skenario 8: Pengujian Role Petugas (Otorisasi)

1. Klik tombol **Logout** di pojok kanan atas navbar.
2. Login kembali menggunakan akun **Petugas**:
   - **Email:** `petugas1@pens.ac.id`
   - **Password:** `password`
3. **Hasil yang diharapkan:**
   - Berhasil login sebagai `Siti Rahmawati (Petugas)`.
   - Menu **Kategori** tidak tampil di navbar.
   - Jika petugas mencoba mengakses manual URL `http://127.0.0.1:8000/categories`, sistem langsung menolak dengan response **403 Forbidden**.
   - Petugas tetap dapat mengelola Buku, Anggota, Transaksi Peminjaman, dan Laporan secara normal.

---

## Skenario 9: Pengujian REST API Eksternal (Postman / cURL)

Seluruh endpoint REST API dapat diuji secara langsung menggunakan Postman atau perintah terminal:

1. **Ambil Statistik Perpustakaan:**
   ```bash
   curl -X GET http://127.0.0.1:8011/api/stats
   ```
   *Response 200 OK dengan JSON ringkasan jumlah buku, anggota, dan status peminjaman.*

2. **Ambil Daftar Buku:**
   ```bash
   curl -X GET http://127.0.0.1:8011/api/books
   ```
   *Response 200 OK dengan format resource `data`, pagination metadata, dan nama kategori.*

3. **Ambil Daftar Peminjaman:**
   ```bash
   curl -X GET "http://127.0.0.1:8011/api/loans?status=dipinjam"
   ```
   *Response 200 OK dengan daftar transaksi peminjaman aktif.*
