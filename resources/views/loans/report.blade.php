{{-- File: resources/views/loans/report.blade.php --}}
@extends('layouts.app')

@section('title', 'Laporan Peminjaman – Perpustakaan Digital Kampus')

@section('content')
    <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 12px;">
        <h2>Laporan Peminjaman</h2>
        <a href="{{ route('loans.index') }}" class="btn">Kembali ke Peminjaman</a>
    </div>

    @if ($apiError)
        <div style="background: #fee2e2; color: #991b1b; padding: 12px 16px; border-radius: 4px; margin: 16px 0;">
            ⚠️ Tidak dapat menghubungi server API (<code>{{ config('services.internal_api.base_url') }}</code>). Pastikan server API aktif.
        </div>
    @endif

    {{-- Filter Form --}}
    <form method="GET" action="{{ route('loans.report') }}" style="margin: 20px 0; display: flex; gap: 12px; align-items: flex-end; flex-wrap: wrap;">
        <div style="flex: 1; min-width: 200px;">
            <label for="status" style="margin-top: 0;">Filter Berdasarkan Status:</label>
            <select name="status" id="status" onchange="this.form.submit()">
                <option value="">-- Semua Status --</option>
                <option value="dipinjam" {{ $status === 'dipinjam' ? 'selected' : '' }}>Sedang Dipinjam</option>
                <option value="dikembalikan" {{ $status === 'dikembalikan' ? 'selected' : '' }}>Dikembalikan</option>
                <option value="terlambat" {{ $status === 'terlambat' ? 'selected' : '' }}>Terlambat</option>
            </select>
        </div>
        <div>
            <button type="submit" class="btn">Filter</button>
            @if ($status)
                <a href="{{ route('loans.report') }}" class="btn" style="background: #6b7280;">Reset</a>
            @endif
        </div>
    </form>

    <p style="color: #6b7280; font-size: 14px;">
        Menampilkan <strong>{{ count($loans) }}</strong> data transaksi
        @if ($status)
            dengan status <strong>{{ ucfirst($status) }}</strong>
        @endif
        (Data diambil dari <code>GET /api/loans</code>).
    </p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Peminjam</th>
                <th>Petugas</th>
                <th>Buku yang Dipinjam</th>
                <th>Tgl Pinjam</th>
                <th>Batas Kembali</th>
                <th>Tgl Dikembalikan</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($loans as $index => $loan)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>
                        <strong>{{ $loan['member']['nama'] ?? '-' }}</strong><br>
                        <small style="color: #6b7280;">NIM: {{ $loan['member']['nim'] ?? '-' }}</small>
                    </td>
                    <td>{{ $loan['petugas']['nama'] ?? '-' }}</td>
                    <td>
                        @if (!empty($loan['buku']))
                            <ul style="margin: 0; padding-left: 18px;">
                                @foreach ($loan['buku'] as $buku)
                                    <li>{{ $buku['judul'] ?? '-' }}</li>
                                @endforeach
                            </ul>
                        @else
                            -
                        @endif
                    </td>
                    <td>{{ $loan['tanggal_pinjam'] ?? '-' }}</td>
                    <td>{{ $loan['tanggal_kembali'] ?? '-' }}</td>
                    <td>{{ $loan['tanggal_dikembalikan'] ?? '-' }}</td>
                    <td>
                        @php
                            $badgeClass = match($loan['status'] ?? '') {
                                'dipinjam' => 'badge-warning',
                                'dikembalikan' => 'badge-success',
                                'terlambat' => 'badge-danger',
                                default => ''
                            };
                        @endphp
                        <span class="badge {{ $badgeClass }}">{{ ucfirst($loan['status'] ?? '-') }}</span>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" style="text-align: center; color: #6b7280; padding: 24px;">
                        Tidak ada data peminjaman yang ditemukan.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
