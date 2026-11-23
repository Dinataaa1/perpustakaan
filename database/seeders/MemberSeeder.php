<?php

namespace Database\Seeders;

use App\Models\Member;
use Illuminate\Database\Seeder;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $manualMembers = [
            [
                'nim'           => '2310501001',
                'nama'          => 'Siti Aminah',
                'email'         => 'siti.aminah@pens.ac.id',
                'nomor_telepon' => '081234567890',
                'alamat'        => 'Jl. Sukolilo No. 12, Surabaya',
                'status'        => 'aktif',
            ],
            [
                'nim'           => '2310501002',
                'nama'          => 'Budi Santoso',
                'email'         => 'budi.santoso@pens.ac.id',
                'nomor_telepon' => '081298765432',
                'alamat'        => 'Jl. Gebang Timur No. 45, Surabaya',
                'status'        => 'aktif',
            ],
            [
                'nim'           => '2310501003',
                'nama'          => 'Dewi Lestari',
                'email'         => 'dewi.lestari@pens.ac.id',
                'nomor_telepon' => '081211122233',
                'alamat'        => 'Jl. Manyar Sabrangan No. 8, Surabaya',
                'status'        => 'nonaktif',
            ],
        ];

        foreach ($manualMembers as $m) {
            Member::firstOrCreate(['nim' => $m['nim']], $m);
        }

        // Generate 15 anggota acak
        Member::factory()->count(15)->create();
    }
}
