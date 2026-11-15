<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>{{ $buku ? 'Edit Buku' : 'Tambah Buku' }}</title>
</head>
<body>
    <h1>{{ $buku ? 'Edit Buku' : 'Tambah Buku' }}</h1>

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form method="POST" action="{{ $buku ? route('buku.update', $buku) : route('buku.store') }}">
        @csrf
        @if ($buku)
            @method('PUT')
        @endif

        <p>
            <label>Kode:<br>
                <input type="text" name="kode" value="{{ old('kode', $buku->kode ?? '') }}" {{ $buku ? 'readonly' : 'required' }}>
            </label>
        </p>

        <p>
            <label>Judul:<br>
                <input type="text" name="judul" value="{{ old('judul', $buku->judul ?? '') }}" required>
            </label>
        </p>

        <p>
            <label>Kategori:<br>
                <select name="kategori_id" required>
                    <option value="">-- Pilih Kategori --</option>
                    @foreach ($kategori as $kat)
                        <option value="{{ $kat->id }}" @selected(old('kategori_id', $buku->kategori_id ?? '') == $kat->id)>
                            {{ $kat->nama }}
                        </option>
                    @endforeach
                </select>
            </label>
        </p>

        <button type="submit">Simpan</button>
        <a href="{{ route('buku.index') }}">Batal</a>
    </form>
</body>
</html>