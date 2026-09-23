<!DOCTYPE html>
<html>
<head>
    <title>Tambah Anggota</title>
</head>
<body>

    <h1>Tambah Anggota</h1>

    <form action="{{ route('members.store') }}" method="POST">
        @csrf

        <p>
            <label>Nama</label><br>
            <input type="text" name="nama">
        </p>

        <p>
            <label>NIM</label><br>
            <input type="text" name="nim">
        </p>

        <p>
            <label>Email</label><br>
            <input type="email" name="email">
        </p>

        <p>
            <label>Nomor Telepon</label><br>
            <input type="text" name="nomor_telepon">
        </p>

        <p>
            <label>Alamat</label><br>
            <textarea name="alamat"></textarea>
        </p>

        <p>
            <label>Status</label><br>
            <select name="status">
                <option value="aktif">Aktif</option>
                <option value="nonaktif">Nonaktif</option>
            </select>
        </p>

        <button type="submit">Simpan</button>
    </form>

    <br>

    <a href="{{ route('members.index') }}">Kembali</a>

</body>
</html>