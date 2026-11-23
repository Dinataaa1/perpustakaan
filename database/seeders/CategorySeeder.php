<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'nama_kategori' => 'Fiksi',
                'deskripsi'     => 'Karya sastra berupa cerita rekaan seperti novel, roman, dan kumpulan cerpen.',
            ],
            [
                'nama_kategori' => 'Teknologi',
                'deskripsi'     => 'Buku seputar teknologi informasi, pemrograman, rekayasa perangkat lunak, dan kecerdasan buatan.',
            ],
            [
                'nama_kategori' => 'Sains',
                'deskripsi'     => 'Buku-buku ilmu pengetahuan alam seperti fisika, biologi, kimia, dan matematika.',
            ],
            [
                'nama_kategori' => 'Sejarah',
                'deskripsi'     => 'Catatan dan peristiwa bersejarah nasional maupun dunia, serta biografi tokoh penting.',
            ],
            [
                'nama_kategori' => 'Bisnis & Ekonomi',
                'deskripsi'     => 'Buku manajemen, strategi bisnis, finansial pribadi, akuntansi, dan kewirausahaan.',
            ],
            [
                'nama_kategori' => 'Pengembangan Diri',
                'deskripsi'     => 'Panduan motivasi, produktivitas, psikologi populer, dan pengembangan potensi diri.',
            ],
        ];

        foreach ($categories as $cat) {
            Category::firstOrCreate(
                ['nama_kategori' => $cat['nama_kategori']],
                ['deskripsi' => $cat['deskripsi']]
            );
        }
    }
}
