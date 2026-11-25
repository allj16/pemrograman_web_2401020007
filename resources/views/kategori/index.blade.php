<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Daftar Kategori</title>
</head>
<body>
    <h1>Daftar Kategori Buku</h1>
    <p>Praktikum Pemrograman Web</p>

    @if (session('sukses'))
        <p><strong>{{ session('sukses') }}</strong></p>
    @endif

    @if (session('gagal'))
        <p style="color: red;"><strong>{{ session('gagal') }}</strong></p>
    @endif

    <p>
        <a href="{{ route('kategori.create') }}">+ Tambah Kategori</a> |
        <a href="{{ route('buku.index') }}">Kembali ke Daftar Buku</a>
    </p>

    <table border="1" cellpadding="6" cellspacing="0">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Kategori</th>
                <th>Jumlah Buku</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($kategoris as $index => $kategori)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $kategori->nama }}</td>
                    <td>{{ $kategori->bukus_count }} buku</td>
                    <td>
                        <a href="{{ route('kategori.edit', $kategori) }}">Edit</a> |
                        <form action="{{ route('kategori.destroy', $kategori) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Yakin hapus kategori ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">Data kategori belum tersedia.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>