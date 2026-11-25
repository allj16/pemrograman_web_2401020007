<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Daftar Buku</title>
</head>
<body>
    <h1>Daftar Buku</h1>
    <p>Masuk sebagai {{ auth()->user()->name }}</p>
<form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit">Keluar</button>
</form>
    <p>Praktikum Pemrograman Web</p>

    @if (session('sukses'))
        <p><strong>{{ session('sukses') }}</strong></p>
    @endif

    <!-- 1. TAMBAHKAN LINK KELOLA KATEGORI DI SINI -->
    <p>
        <a href="{{ route('buku.create') }}">+ Tambah Buku</a> |
        <a href="{{ route('kategori.index') }}">Kelola Kategori</a>
    </p>

    <form method="GET" action="{{ route('buku.index') }}">
        <label>Cari judul <input type="text" name="cari" value="{{ $cari }}"></label>
        
        <!-- 2. TAMBAHKAN FILTER KATEGORI & TOMBOL RESET DI SINI -->
        <label>Kategori
            <select name="kategori_id">
                <option value="">-- Semua Kategori --</option>
                @foreach ($kategoris as $kat)
                    <option value="{{ $kat->id }}" {{ ($kategoriId ?? '') == $kat->id ? 'selected' : '' }}>
                        {{ $kat->nama }}
                    </option>
                @endforeach
            </select>
        </label>

        <button type="submit">Cari</button>
        <a href="{{ route('buku.index') }}">Reset</a>
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