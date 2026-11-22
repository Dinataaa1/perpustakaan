<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Category;
use App\Models\Member;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $fiksi = Category::create([
            'nama_kategori' => 'Fiksi',
            'deskripsi' => 'Buku cerita rekaan seperti novel dan kumpulan cerpen.',
        ]);

        $teknologi = Category::create([
            'nama_kategori' => 'Teknologi',
            'deskripsi' => 'Buku seputar teknologi, pemrograman, dan ilmu komputer.',
        ]);

        $sejarah = Category::create([
            'nama_kategori' => 'Sejarah',
            'deskripsi' => 'Buku bertema sejarah dan biografi tokoh.',
        ]);

        Book::create([
            'judul' => 'Laskar Pelangi',
            'penulis' => 'Andrea Hirata',
            'penerbit' => 'Bentang Pustaka',
            'tahun_terbit' => 2005,
            'isbn' => '9789793062792',
            'stok' => 5,
            'category_id' => $fiksi->id,
        ]);

        Book::create([
            'judul' => 'Bumi Manusia',
            'penulis' => 'Pramoedya Ananta Toer',
            'penerbit' => 'Hasta Mitra',
            'tahun_terbit' => 1980,
            'isbn' => '9789794330746',
            'stok' => 3,
            'category_id' => $fiksi->id,
        ]);

        Book::create([
            'judul' => 'Clean Code',
            'penulis' => 'Robert C. Martin',
            'penerbit' => 'Prentice Hall',
            'tahun_terbit' => 2008,
            'isbn' => '9780132350884',
            'stok' => 7,
            'category_id' => $teknologi->id,
        ]);

        Member::create([
            'nama' => 'Siti Aminah',
            'nim' => '2310501001',
            'email' => 'siti.aminah@pens.ac.id',
            'nomor_telepon' => '081234567890',
            'alamat' => 'Jl. Sukolilo No. 12, Surabaya',
            'status' => 'aktif',
        ]);

        Member::create([
            'nama' => 'Budi Santoso',
            'nim' => '2310501002',
            'email' => 'budi.santoso@pens.ac.id',
            'nomor_telepon' => '081298765432',
            'alamat' => 'Jl. Gebang Timur No. 45, Surabaya',
            'status' => 'aktif',
        ]);

        Member::create([
            'nama' => 'Dewi Lestari',
            'nim' => '2310501003',
            'email' => 'dewi.lestari@pens.ac.id',
            'nomor_telepon' => '081211122233',
            'alamat' => 'Jl. Manyar Sabrangan No. 8, Surabaya',
            'status' => 'nonaktif',
        ]);
    }
}
