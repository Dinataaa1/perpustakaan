<!DOCTYPE html>
<html>
<head>
    <title>Tambah Buku</title>
</head>
<body>

    <h1>Tambah Buku</h1>

    <form action="{{ route('books.store') }}" method="POST">
        @csrf

        <p>
            <label>Judul</label><br>
            <input type="text" name="judul">
        </p>

        <p>
            <label>Penulis</label><br>
            <input type="text" name="penulis">
        </p>

        <p>
            <label>Kategori</label><br>
            <select name="kategori">
                @foreach ($categories as $category)
                    <option value="{{ $category['nama'] }}">
                        {{ $category['nama'] }}
                    </option>
                @endforeach
            </select>
        </p>

        <p>
            <label>Tahun</label><br>
            <input type="number" name="tahun">
        </p>

        <p>
            <label>Stok</label><br>
            <input type="number" name="stok">
        </p>

        <button type="submit">Simpan</button>
    </form>

    <br>

    <a href="{{ route('books.index') }}">Kembali</a>

</body>
</html>