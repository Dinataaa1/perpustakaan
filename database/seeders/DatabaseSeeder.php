<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Category;
use App\Models\Loan;
use App\Models\Member;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $petugas = User::firstOrCreate(
            ['email' => 'petugas@perpus.ac.id'],
            [
                'name' => 'Ahmad Petugas',
                'password' => bcrypt('password'),
                'role' => 'petugas',
            ]
        );

        $fiksi = Category::firstOrCreate(
            ['nama_kategori' => 'Fiksi'],
            ['deskripsi' => 'Buku cerita rekaan seperti novel dan kumpulan cerpen.']
        );

        $teknologi = Category::firstOrCreate(
            ['nama_kategori' => 'Teknologi'],
            ['deskripsi' => 'Buku seputar teknologi, pemrograman, dan ilmu komputer.']
        );

        $sejarah = Category::firstOrCreate(
            ['nama_kategori' => 'Sejarah'],
            ['deskripsi' => 'Buku bertema sejarah dan biografi tokoh.']
        );

        $buku1 = Book::firstOrCreate(
            ['isbn' => '9789793062792'],
            [
                'judul' => 'Laskar Pelangi',
                'penulis' => 'Andrea Hirata',
                'penerbit' => 'Bentang Pustaka',
                'tahun_terbit' => 2005,
                'stok' => 5,
                'category_id' => $fiksi->id,
            ]
        );

        $buku2 = Book::firstOrCreate(
            ['isbn' => '9789794330746'],
            [
                'judul' => 'Bumi Manusia',
                'penulis' => 'Pramoedya Ananta Toer',
                'penerbit' => 'Hasta Mitra',
                'tahun_terbit' => 1980,
                'stok' => 3,
                'category_id' => $fiksi->id,
            ]
        );

        $buku3 = Book::firstOrCreate(
            ['isbn' => '9780132350884'],
            [
                'judul' => 'Clean Code',
                'penulis' => 'Robert C. Martin',
                'penerbit' => 'Prentice Hall',
                'tahun_terbit' => 2008,
                'stok' => 7,
                'category_id' => $teknologi->id,
            ]
        );

        $member1 = Member::firstOrCreate(
            ['nim' => '2310501001'],
            [
                'nama' => 'Siti Aminah',
                'email' => 'siti.aminah@pens.ac.id',
                'nomor_telepon' => '081234567890',
                'alamat' => 'Jl. Sukolilo No. 12, Surabaya',
                'status' => 'aktif',
            ]
        );

        $member2 = Member::firstOrCreate(
            ['nim' => '2310501002'],
            [
                'nama' => 'Budi Santoso',
                'email' => 'budi.santoso@pens.ac.id',
                'nomor_telepon' => '081298765432',
                'alamat' => 'Jl. Gebang Timur No. 45, Surabaya',
                'status' => 'aktif',
            ]
        );

        $member3 = Member::firstOrCreate(
            ['nim' => '2310501003'],
            [
                'nama' => 'Dewi Lestari',
                'email' => 'dewi.lestari@pens.ac.id',
                'nomor_telepon' => '081211122233',
                'alamat' => 'Jl. Manyar Sabrangan No. 8, Surabaya',
                'status' => 'nonaktif',
            ]
        );

        // Contoh transaksi peminjaman aktif untuk demo /loans
        if (Loan::count() === 0) {
            $loan = Loan::create([
                'member_id' => $member1->id,
                'user_id' => $petugas->id,
                'tanggal_pinjam' => now()->toDateString(),
                'tanggal_kembali' => now()->addDays(7)->toDateString(),
                'status' => 'dipinjam',
            ]);
            $loan->loanItems()->create(['book_id' => $buku1->id]);
            $loan->loanItems()->create(['book_id' => $buku3->id]);
        }
    }
}
