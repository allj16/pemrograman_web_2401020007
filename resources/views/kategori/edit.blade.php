<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Edit Kategori</title>
</head>
<body>
    <h1>Edit Kategori</h1>
    <p><a href="{{ route('kategori.index') }}">Kembali ke Daftar Kategori</a></p>

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li style="color: red;">{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form method="POST" action="{{ route('kategori.update', $kategori) }}">
        @csrf
        @method('PUT')
        <p>
            <label>Nama Kategori:<br>
                <input type="text" name="nama" value="{{ old('nama', $kategori->nama) }}" required>
            </label>
        </p>
        <button type="submit">Perbarui</button>
        <a href="{{ route('kategori.index') }}">Batal</a>
    </form>
</body>
</html>