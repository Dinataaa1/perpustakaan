{{-- File: resources/views/profile/show.blade.php --}}
@extends('layouts.app')

@section('title', 'Profil Pengguna')

@section('content')
    <h1>Profil Pengguna</h1>

    <table style="max-width: 500px; margin-bottom: 30px;">
        <tr>
            <th style="width: 160px; background: #f3f4f6;">Nama</th>
            <td>{{ $user->name }}</td>
        </tr>
        <tr>
            <th style="background: #f3f4f6;">Email</th>
            <td>{{ $user->email }}</td>
        </tr>
        <tr>
            <th style="background: #f3f4f6;">Role</th>
            <td><span class="badge {{ $user->role === 'admin' ? 'badge-danger' : 'badge-success' }}">{{ ucfirst($user->role) }}</span></td>
        </tr>
    </table>

    <h2>Ganti Password</h2>

    <form action="{{ route('profile.password') }}" method="POST" style="max-width: 500px;">
        @csrf
        @method('PUT')

        <label for="current_password">Password Lama</label>
        <input type="password" name="current_password" id="current_password">
        @error('current_password')
            <div class="error">{{ $message }}</div>
        @enderror

        <label for="password">Password Baru</label>
        <input type="password" name="password" id="password">
        @error('password')
            <div class="error">{{ $message }}</div>
        @enderror

        <label for="password_confirmation">Konfirmasi Password Baru</label>
        <input type="password" name="password_confirmation" id="password_confirmation">

        <button type="submit" class="btn" style="margin-top: 20px;">Ganti Password</button>
    </form>
@endsection
