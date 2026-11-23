<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Loan;
use App\Models\Member;
use App\Models\User;
use Illuminate\Database\Seeder;

class LoanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $petugas1 = User::where('email', 'petugas1@pens.ac.id')->first() ?? User::first();
        $petugas2 = User::where('email', 'petugas2@pens.ac.id')->first() ?? User::first();
        $members  = Member::where('status', 'aktif')->get();
        $books    = Book::all();

        if ($members->isEmpty() || $books->isEmpty()) {
            return;
        }

        // 1. Peminjaman aktif (dipinjam)
        for ($i = 0; $i < 4; $i++) {
            $member = $members->random();
            $petugas = ($i % 2 === 0) ? $petugas1 : $petugas2;

            $loan = Loan::create([
                'member_id'       => $member->id,
                'user_id'         => $petugas->id,
                'tanggal_pinjam'  => now()->subDays(rand(1, 4))->toDateString(),
                'tanggal_kembali' => now()->addDays(rand(3, 7))->toDateString(),
                'status'          => 'dipinjam',
            ]);

            $selectedBooks = $books->random(rand(1, 2));
            foreach ($selectedBooks as $book) {
                $loan->loanItems()->create(['book_id' => $book->id]);
            }
        }

        // 2. Peminjaman sudah dikembalikan
        for ($i = 0; $i < 6; $i++) {
            $member = $members->random();
            $petugas = ($i % 2 === 0) ? $petugas2 : $petugas1;
            $pinjamDate = now()->subDays(rand(10, 25));

            $loan = Loan::create([
                'member_id'            => $member->id,
                'user_id'              => $petugas->id,
                'tanggal_pinjam'       => $pinjamDate->toDateString(),
                'tanggal_kembali'      => (clone $pinjamDate)->addDays(7)->toDateString(),
                'tanggal_dikembalikan' => (clone $pinjamDate)->addDays(rand(4, 7))->toDateString(),
                'status'               => 'dikembalikan',
            ]);

            $selectedBooks = $books->random(rand(1, 3));
            foreach ($selectedBooks as $book) {
                $loan->loanItems()->create(['book_id' => $book->id]);
            }
        }

        // 3. Peminjaman terlambat
        for ($i = 0; $i < 2; $i++) {
            $member = $members->random();
            $petugas = $petugas1;
            $pinjamDate = now()->subDays(rand(15, 20));

            $loan = Loan::create([
                'member_id'       => $member->id,
                'user_id'         => $petugas->id,
                'tanggal_pinjam'  => $pinjamDate->toDateString(),
                'tanggal_kembali' => (clone $pinjamDate)->addDays(7)->toDateString(),
                'status'          => 'terlambat',
            ]);

            $selectedBooks = $books->random(1);
            foreach ($selectedBooks as $book) {
                $loan->loanItems()->create(['book_id' => $book->id]);
            }
        }
    }
}
