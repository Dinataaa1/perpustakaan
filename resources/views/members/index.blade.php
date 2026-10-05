<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Anggota</title>
</head>
<body>

    <h1>Daftar Anggota</h1>

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <form action="{{ route('members.index') }}" method="GET">
        <input
            type="text"
            name="search"
            placeholder="Cari nama anggota..."
            value="{{ request('search') }}"
        >

        <button type="submit">Cari</button>
    </form>

    <br>

    <a href="{{ route('members.create') }}">Tambah Anggota</a>

    <br><br>

    <table border="1" cellpadding="8">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>NIM</th>
                <th>Email</th>
                <th>Nomor Telepon</th>
                <th>Alamat</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($members as $member)
                <tr>
                    <td>{{ $member->id }}</td>
                    <td>{{ $member->nama }}</td>
                    <td>{{ $member->nim }}</td>
                    <td>{{ $member->email }}</td>
                    <td>{{ $member->nomor_telepon }}</td>
                    <td>{{ $member->alamat }}</td>
                    <td>{{ $member->status }}</td>
                    <td>
                        <a href="{{ route('members.show', $member->id) }}">
                            Detail
                        </a>

                        |

                        <a href="{{ route('members.edit', $member->id) }}">
                            Edit
                        </a>

                        |

                        <form
                            action="{{ route('members.destroy', $member->id) }}"
                            method="POST"
                            style="display:inline"
                        >
                            @csrf
                            @method('DELETE')

                            <button type="submit">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8">
                        Tidak ada anggota ditemukan.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <br>

    {{ $members->appends(request()->query())->links() }}

</body>
</html>