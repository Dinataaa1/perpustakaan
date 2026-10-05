<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Anggota</title>
</head>
<body>

    <h1>Edit Anggota</h1>

    <form action="{{ route('members.update', $member->id) }}" method="POST">
        @csrf
        @method('PUT')

        <p>
            <label>Nama</label><br>
            <input
                type="text"
                name="nama"
                value="{{ old('nama', $member->nama) }}"
            >
        </p>

        <p>
            <label>NIM</label><br>
            <input
                type="text"
                name="nim"
                value="{{ old('nim', $member->nim) }}"
            >
        </p>

        <p>
            <label>Email</label><br>
            <input
                type="email"
                name="email"
                value="{{ old('email', $member->email) }}"
            >
        </p>

        <p>
            <label>Nomor Telepon</label><br>
            <input
                type="text"
                name="nomor_telepon"
                value="{{ old('nomor_telepon', $member->nomor_telepon) }}"
            >
        </p>

        <p>
            <label>Alamat</label><br>
            <textarea name="alamat">{{ old('alamat', $member->alamat) }}</textarea>
        </p>

        <p>
            <label>Status</label><br>
            <select name="status">
                <option value="aktif"
                    {{ old('status', $member->status) == 'aktif' ? 'selected' : '' }}>
                    Aktif
                </option>

                <option value="nonaktif"
                    {{ old('status', $member->status) == 'nonaktif' ? 'selected' : '' }}>
                    Nonaktif
                </option>
            </select>
        </p>

        <button type="submit">Simpan Perubahan</button>
    </form>

    <br>

    <a href="{{ route('members.index') }}">Kembali</a>

</body>
</html>