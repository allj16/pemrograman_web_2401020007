<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Daftar Buku</title>
</head>
<body>
    <h1>Daftar Buku</h1>
    <p>Praktikum Pemrograman Web</p>

    @if (session('sukses'))
        <p><strong>{{ session('sukses') }}</strong></p>
    @endif

    <p><a href="{{ route('buku.create') }}">+ Tambah Buku</a></p>

    <form method="GET" action="{{ route('buku.index') }}">
        <label>Cari judul <input type="text" name="cari" value="{{ $cari }}"></label>
        <button type="submit">Cari</button>
    </form>
    <br>

    <table border="1" cellpadding="6" cellspacing="0">
        <thead>
            <tr>
                <th>Kode</th>
                <th>Judul</th>
                <th>Kategori</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($buku as $item)
                <tr>
                    <td>{{ $item->kode }}</td>
                    <td>{{ $item->judul }}</td>
                    <td>{{ $item->kategori->nama ?? '-' }}</td>
                    <td>
                        <a href="{{ route('buku.show', $item) }}">Lihat</a> |
                        <a href="{{ route('buku.edit', $item) }}">Edit</a> |
                        <form action="{{ route('buku.destroy', $item) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Yakin hapus buku ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">Data buku belum tersedia.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>