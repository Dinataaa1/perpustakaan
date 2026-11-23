<?php

namespace App\Http\Controllers;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_buku'       => 0,
            'total_anggota'    => 0,
            'sedang_dipinjam'  => 0,
            'dikembalikan'     => 0,
        ];

        try {
            $baseUrl  = config('services.internal_api.base_url');
            $response = Http::timeout(5)->get("{$baseUrl}/api/stats");

            if ($response->successful()) {
                $data = $response->json('data', []);
                $stats = [
                    'total_buku'      => $data['total_buku']      ?? 0,
                    'total_anggota'   => $data['total_anggota']   ?? 0,
                    'sedang_dipinjam' => $data['sedang_dipinjam']  ?? 0,
                    'dikembalikan'    => $data['dikembalikan']     ?? 0,
                ];
            }
        } catch (ConnectionException $e) {
            // Server API tidak aktif, tampilkan angka 0
        }

        return view('dashboard', compact('stats'));
    }
}
