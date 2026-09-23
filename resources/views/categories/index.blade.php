<!DOCTYPE html>
<html>
<head>
    <title>Daftar Kategori</title>
</head>
<body>

    <h1>Daftar Kategori</h1>

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <a href="{{ route('categories.create') }}">Tambah Kategori</a>

    <table border="1" cellpadding="8">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Kategori</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($categories as $category)
                <tr>
                    <td>{{ $category['id'] }}</td>
                    <td>{{ $category['nama'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>