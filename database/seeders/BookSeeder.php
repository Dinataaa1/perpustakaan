<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fiksi = Category::where('nama_kategori', 'Fiksi')->first();
        $teknologi = Category::where('nama_kategori', 'Teknologi')->first();
        $sejarah = Category::where('nama_kategori', 'Sejarah')->first();
        $bisnis = Category::where('nama_kategori', 'Bisnis & Ekonomi')->first();
        $selfdev = Category::where('nama_kategori', 'Pengembangan Diri')->first();

        $manualBooks = [
            [
                'isbn'         => '9789793062792',
                'judul'        => 'Laskar Pelangi',
                'penulis'      => 'Andrea Hirata',
                'penerbit'     => 'Bentang Pustaka',
                'tahun_terbit' => 2005,
                'stok'         => 5,
                'category_id'  => $fiksi?->id,
            ],
            [
                'isbn'         => '9789794330746',
                'judul'        => 'Bumi Manusia',
                'penulis'      => 'Pramoedya Ananta Toer',
                'penerbit'     => 'Hasta Mitra',
                'tahun_terbit' => 1980,
                'stok'         => 4,
                'category_id'  => $fiksi?->id,
            ],
            [
                'isbn'         => '9780132350884',
                'judul'        => 'Clean Code',
                'penulis'      => 'Robert C. Martin',
                'penerbit'     => 'Prentice Hall',
                'tahun_terbit' => 2008,
                'stok'         => 7,
                'category_id'  => $teknologi?->id,
            ],
            [
                'isbn'         => '9780201616224',
                'judul'        => 'The Pragmatic Programmer',
                'penulis'      => 'Andrew Hunt & David Thomas',
                'penerbit'     => 'Addison-Wesley',
                'tahun_terbit' => 1999,
                'stok'         => 6,
                'category_id'  => $teknologi?->id,
            ],
            [
                'isbn'         => '9780062316097',
                'judul'        => 'Sapiens: Riwayat Singkat Umat Manusia',
                'penulis'      => 'Yuval Noah Harari',
                'penerbit'     => 'KPG',
                'tahun_terbit' => 2014,
                'stok'         => 8,
                'category_id'  => $sejarah?->id,
            ],
            [
                'isbn'         => '9780735211292',
                'judul'        => 'Atomic Habits',
                'penulis'      => 'James Clear',
                'penerbit'     => 'Gramedia Pustaka Utama',
                'tahun_terbit' => 2018,
                'stok'         => 10,
                'category_id'  => $selfdev?->id,
            ],
            [
                'isbn'         => '9780857197689',
                'judul'        => 'The Psychology of Money',
                'penulis'      => 'Morgan Housel',
                'penerbit'     => 'Harriman House',
                'tahun_terbit' => 2020,
                'stok'         => 6,
                'category_id'  => $bisnis?->id,
            ],
        ];

        foreach ($manualBooks as $b) {
            Book::firstOrCreate(['isbn' => $b['isbn']], $b);
        }

        // Generate 15 buku acak menggunakan factory
        Book::factory()->count(15)->create();
    }
}
