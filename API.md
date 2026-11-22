# Dokumentasi REST API Perpustakaan

Dokumentasi seluruh 11 endpoint REST API sistem perpustakaan pada Pertemuan 9.
Base URL: `http://127.0.0.1:8000/api`  
Semua request sebaiknya menyertakan header:
```http
Accept: application/json
Content-Type: application/json
```

---

## 1. Ringkasan Endpoint

| No | Method | URL | Deskripsi | Status Code |
|---|---|---|---|---|
| 1 | `GET` | `/api/books` | Mengambil daftar buku (bisa filter judul & category_id) | 200 OK |
| 2 | `GET` | `/api/books/{id}` | Mengambil detail satu buku | 200 OK / 404 Not Found |
| 3 | `POST` | `/api/books` | Menambahkan buku baru | 201 Created / 422 Unprocessable |
| 4 | `PUT` | `/api/books/{id}` | Memperbarui data buku | 200 OK / 422 Unprocessable |
| 5 | `DELETE` | `/api/books/{id}` | Menghapus buku | 200 OK / 404 Not Found |
| 6 | `GET` | `/api/members` | Mengambil daftar anggota terpaginasi | 200 OK |
| 7 | `GET` | `/api/members/{id}` | Mengambil detail satu anggota | 200 OK / 404 Not Found |
| 8 | `GET` | `/api/loans` | Mengambil daftar peminjaman beserta relasi | 200 OK |
| 9 | `POST` | `/api/loans` | Membuat transaksi peminjaman baru | 201 Created / 422 Unprocessable |
| 10 | `PUT` | `/api/loans/{id}/kembalikan` | Mengubah status peminjaman jadi dikembalikan | 200 OK / 404 Not Found |
| 11 | `GET` | `/api/stats` | Ringkasan statistik sistem perpustakaan | 200 OK |

---

## 2. Rincian dan Contoh Response Tiap Endpoint

### 1. `GET /api/books`
- **Query Parameter Opsional**:
  - `judul`: Filter nama buku (pencarian teks / LIKE)
  - `category_id`: Filter id kategori buku
  - `page`: Nomor halaman pagination
- **Status Code**: `200 OK`
- **Contoh Response**:
```json
{
  "data": [
    {
      "id": 1,
      "judul": "Laskar Pelangi",
      "penulis": "Andrea Hirata",
      "penerbit": "Bentang Pustaka",
      "tahun_terbit": 2005,
      "isbn": "9789793062792",
      "stok": 5,
      "sampul": null,
      "category": {
        "id": 1,
        "nama_kategori": "Fiksi"
      },
      "created_at": "2026-11-22T00:17:38.000000Z",
      "updated_at": "2026-11-22T00:17:38.000000Z"
    }
  ],
  "links": {
    "first": "http://127.0.0.1:8000/api/books?page=1",
    "last": "http://127.0.0.1:8000/api/books?page=1",
    "prev": null,
    "next": null
  },
  "meta": {
    "current_page": 1,
    "from": 1,
    "last_page": 1,
    "per_page": 10,
    "total": 1
  }
}
```

---

### 2. `GET /api/books/{id}`
- **Status Code**: `200 OK` (Sukses) / `404 Not Found` (Jika ID tidak ada)
- **Contoh Response (200 OK)**:
```json
{
  "data": {
    "id": 1,
    "judul": "Laskar Pelangi",
    "penulis": "Andrea Hirata",
    "penerbit": "Bentang Pustaka",
    "tahun_terbit": 2005,
    "isbn": "9789793062792",
    "stok": 5,
    "sampul": null,
    "category": {
      "id": 1,
      "nama_kategori": "Fiksi"
    },
    "created_at": "2026-11-22T00:17:38.000000Z",
    "updated_at": "2026-11-22T00:17:38.000000Z"
  }
}
```
- **Contoh Response (404 Not Found)**:
```json
{
  "message": "No query results for model [App\\Models\\Book] 999"
}
```

---

### 3. `POST /api/books`
- **Request Body (JSON)**:
```json
{
  "judul": "Refactoring",
  "penulis": "Martin Fowler",
  "penerbit": "Addison-Wesley",
  "tahun_terbit": 2018,
  "isbn": "9780134757599",
  "stok": 4,
  "category_id": 2
}
```
- **Status Code**: `201 Created`
- **Contoh Response (201 Created)**:
```json
{
  "data": {
    "id": 4,
    "judul": "Refactoring",
    "penulis": "Martin Fowler",
    "penerbit": "Addison-Wesley",
    "tahun_terbit": 2018,
    "isbn": "9780134757599",
    "stok": 4,
    "sampul": null,
    "category": {
      "id": 2,
      "nama_kategori": "Teknologi"
    },
    "created_at": "2026-11-22T00:55:00.000000Z",
    "updated_at": "2026-11-22T00:55:00.000000Z"
  }
}
```
- **Contoh Gagal Validasi (422 Unprocessable Content)**:
```json
{
  "message": "Judul buku wajib diisi. (and 5 more errors)",
  "errors": {
    "judul": ["Judul buku wajib diisi."],
    "penulis": ["Nama penulis wajib diisi."],
    "penerbit": ["Nama penerbit wajib diisi."],
    "tahun_terbit": ["Tahun terbit wajib diisi."],
    "stok": ["Stok wajib diisi."],
    "category_id": ["Kategori wajib dipilih."]
  }
}
```

---

### 4. `PUT /api/books/{id}`
- **Request Body (JSON)**:
```json
{
  "judul": "Laskar Pelangi Edisi Spesial",
  "penulis": "Andrea Hirata",
  "penerbit": "Bentang Pustaka",
  "tahun_terbit": 2005,
  "isbn": "9789793062792",
  "stok": 10,
  "category_id": 1
}
```
- **Status Code**: `200 OK`
- **Contoh Response**:
```json
{
  "data": {
    "id": 1,
    "judul": "Laskar Pelangi Edisi Spesial",
    "penulis": "Andrea Hirata",
    "penerbit": "Bentang Pustaka",
    "tahun_terbit": 2005,
    "isbn": "9789793062792",
    "stok": 10,
    "sampul": null,
    "category": {
      "id": 1,
      "nama_kategori": "Fiksi"
    },
    "created_at": "2026-11-22T00:17:38.000000Z",
    "updated_at": "2026-11-22T00:55:00.000000Z"
  }
}
```

---

### 5. `DELETE /api/books/{id}`
- **Status Code**: `200 OK`
- **Contoh Response**:
```json
{
  "message": "Buku berhasil dihapus."
}
```

---

### 6. `GET /api/members`
- **Status Code**: `200 OK`
- **Contoh Response**:
```json
{
  "data": [
    {
      "id": 1,
      "nama": "Siti Aminah",
      "nim": "2310501001",
      "email": "siti.aminah@pens.ac.id",
      "nomor_telepon": "081234567890",
      "alamat": "Jl. Sukolilo No. 12, Surabaya",
      "status": "aktif",
      "created_at": "2026-11-22T00:17:38.000000Z",
      "updated_at": "2026-11-22T00:17:38.000000Z"
    }
  ],
  "links": {
    "first": "http://127.0.0.1:8000/api/members?page=1",
    "last": "http://127.0.0.1:8000/api/members?page=1",
    "prev": null,
    "next": null
  },
  "meta": {
    "current_page": 1,
    "from": 1,
    "last_page": 1,
    "per_page": 10,
    "total": 3
  }
}
```

---

### 7. `GET /api/members/{id}`
- **Status Code**: `200 OK`
- **Contoh Response**:
```json
{
  "data": {
    "id": 1,
    "nama": "Siti Aminah",
    "nim": "2310501001",
    "email": "siti.aminah@pens.ac.id",
    "nomor_telepon": "081234567890",
    "alamat": "Jl. Sukolilo No. 12, Surabaya",
    "status": "aktif",
    "created_at": "2026-11-22T00:17:38.000000Z",
    "updated_at": "2026-11-22T00:17:38.000000Z"
  }
}
```

---

### 8. `GET /api/loans`
- **Status Code**: `200 OK`
- **Contoh Response**:
```json
{
  "data": [
    {
      "id": 1,
      "member": {
        "id": 1,
        "nama": "Siti Aminah"
      },
      "petugas": {
        "id": 1,
        "name": "Admin Perpustakaan"
      },
      "tanggal_pinjam": "2026-11-22",
      "tanggal_kembali": "2026-11-29",
      "tanggal_dikembalikan": null,
      "status": "dipinjam",
      "books": [
        {
          "id": 1,
          "judul": "Laskar Pelangi"
        },
        {
          "id": 3,
          "judul": "Clean Code"
        }
      ]
    }
  ],
  "links": {
    "first": "http://127.0.0.1:8000/api/loans?page=1",
    "last": "http://127.0.0.1:8000/api/loans?page=1",
    "prev": null,
    "next": null
  },
  "meta": {
    "current_page": 1,
    "from": 1,
    "last_page": 1,
    "per_page": 10,
    "total": 1
  }
}
```

---

### 9. `POST /api/loans`
- **Request Body (JSON)**:
```json
{
  "member_id": 1,
  "user_id": 1,
  "tanggal_pinjam": "2026-11-22",
  "tanggal_kembali": "2026-11-29",
  "book_ids": [1, 2]
}
```
- **Status Code**: `201 Created`
- **Contoh Response**:
```json
{
  "data": {
    "id": 2,
    "member": {
      "id": 1,
      "nama": "Siti Aminah"
    },
    "petugas": {
      "id": 1,
      "name": "Admin Perpustakaan"
    },
    "tanggal_pinjam": "2026-11-22",
    "tanggal_kembali": "2026-11-29",
    "tanggal_dikembalikan": null,
    "status": "dipinjam",
    "books": [
      {
        "id": 1,
        "judul": "Laskar Pelangi"
      },
      {
        "id": 2,
        "judul": "Bumi Manusia"
      }
    ]
  }
}
```

---

### 10. `PUT /api/loans/{id}/kembalikan`
- **Status Code**: `200 OK`
- **Contoh Response**:
```json
{
  "data": {
    "id": 1,
    "member": {
      "id": 1,
      "nama": "Siti Aminah"
    },
    "petugas": {
      "id": 1,
      "name": "Admin Perpustakaan"
    },
    "tanggal_pinjam": "2026-11-22",
    "tanggal_kembali": "2026-11-29",
    "tanggal_dikembalikan": "2026-11-22",
    "status": "dikembalikan",
    "books": [
      {
        "id": 1,
        "judul": "Laskar Pelangi"
      },
      {
        "id": 3,
        "judul": "Clean Code"
      }
    ]
  }
}
```

---

### 11. `GET /api/stats`
- **Status Code**: `200 OK`
- **Contoh Response**:
```json
{
  "total_buku": 3,
  "total_anggota": 3,
  "peminjaman_aktif": 1
}
```
