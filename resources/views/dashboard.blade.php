{{-- File: resources/views/dashboard.blade.php --}}
@extends('layouts.app')

@section('title', 'Dashboard – Perpustakaan Digital Kampus')

@section('content')
    <h2>Dashboard</h2>
    <p>Selamat datang, <strong>{{ auth()->user()->name }}</strong>. Berikut ringkasan kondisi perpustakaan saat ini.</p>

    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-number">{{ $stats['total_buku'] }}</div>
            <div class="stat-label">Total Buku</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">{{ $stats['total_anggota'] }}</div>
            <div class="stat-label">Total Anggota</div>
        </div>
        <div class="stat-card stat-card--warning">
            <div class="stat-number">{{ $stats['sedang_dipinjam'] }}</div>
            <div class="stat-label">Sedang Dipinjam</div>
        </div>
        <div class="stat-card stat-card--success">
            <div class="stat-number">{{ $stats['dikembalikan'] }}</div>
            <div class="stat-label">Dikembalikan</div>
        </div>
    </div>

    <div style="margin-top: 32px;">
        <h3>Akses Cepat</h3>
        <div style="display: flex; gap: 12px; flex-wrap: wrap; margin-top: 12px;">
            <a href="{{ route('books.index') }}" class="btn">📖 Daftar Buku</a>
            <a href="{{ route('members.index') }}" class="btn">👤 Daftar Anggota</a>
            <a href="{{ route('loans.index') }}" class="btn">📋 Peminjaman</a>
            <a href="{{ route('loans.report') }}" class="btn btn-success">📊 Laporan</a>
        </div>
    </div>
@endsection
