<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Anggota</title>
</head>
<body>

    <h1>Detail Anggota</h1>

    <p><strong>ID:</strong> {{ $member->id }}</p>
    <p><strong>Nama:</strong> {{ $member->nama }}</p>
    <p><strong>NIM:</strong> {{ $member->nim }}</p>
    <p><strong>Email:</strong> {{ $member->email }}</p>
    <p><strong>Nomor Telepon:</strong> {{ $member->nomor_telepon }}</p>
    <p><strong>Alamat:</strong> {{ $member->alamat }}</p>
    <p><strong>Status:</strong> {{ $member->status }}</p>

    <br>

    <a href="{{ route('members.index') }}">Kembali</a>

</body>
</html>