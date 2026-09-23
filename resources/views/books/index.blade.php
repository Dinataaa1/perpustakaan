<!DOCTYPE html>
<html>
<head>
    <title>Daftar Buku</title>
</head>
<body>

    <h1>Daftar Buku</h1>

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <a href="{{ route('books.create') }}">Tambah Buku</a>

    <table border="1" cellpadding="8">
        <thead>
            <tr>
                <th>ID</th>
                <th>Judul</th>
                <th>Penulis</th>
                <th>Kategori</th>
                <th>Tahun</th>
                <th>Stok</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($books as $book)
                <tr>
                    <td>{{ $book['id'] }}</td>
                    <td>{{ $book['judul'] }}</td>
                    <td>{{ $book['penulis'] }}</td>
                    <td>{{ $book['kategori'] }}</td>
                    <td>{{ $book['tahun'] }}</td>
                    <td>{{ $book['stok'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>