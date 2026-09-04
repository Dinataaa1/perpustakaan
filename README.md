# Aplikasi Perpustakaan

## Nama Aplikasi
Aplikasi Perpustakaan

## Tujuan
Aplikasi ini dibuat untuk mengelola data perpustakaan seperti data buku,
anggota, dan peminjaman buku.

## Cara Menjalankan Project

1. Clone repository:
```bash
git clone https://github.com/Dinataaa1/perpustakaan.git
```

2. Masuk ke folder project:
```bash
cd perpustakaan
```

3. Install dependency:
```bash
composer install
```

4. Buat file `.env`:
```bash
copy .env.example .env
```

5. Generate application key:
```bash
php artisan key:generate
```

6. Jalankan migration:
```bash
php artisan migrate
```

7. Jalankan server Laravel:
```bash
php artisan serve --no-reload --port=8000
```

8. Buka aplikasi melalui browser:
```text
http://127.0.0.1:8000
```

## Konsep MVC
Model bertugas mengatur data dan interaksi dengan database.
View bertugas menampilkan tampilan kepada pengguna.
Controller menjadi penghubung antara Model dan View serta mengatur alur proses aplikasi.
