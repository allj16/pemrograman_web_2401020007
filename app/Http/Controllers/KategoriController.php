<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        $kategoris = Kategori::withCount('bukus')->orderBy('nama')->get();
        return view('kategori.index', compact('kategoris'));
    }

    public function create()
    {
        return view('kategori.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:100|unique:kategoris,nama',
        ], [
            'nama.required' => 'Nama kategori wajib diisi.',
            'nama.unique'   => 'Nama kategori sudah terdaftar.',
        ]);

        Kategori::create($validated);

        return redirect()->route('kategori.index')
            ->with('sukses', 'Kategori berhasil ditambahkan.');
    }

    public function show(Kategori $kategori)
    {
        $kategori->load('bukus');
        return view('kategori.show', compact('kategori'));
    }

    public function edit(Kategori $kategori)
    {
        return view('kategori.edit', compact('kategori'));
    }

    public function update(Request $request, Kategori $kategori)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:100|unique:kategoris,nama,' . $kategori->id,
        ], [
            'nama.required' => 'Nama kategori wajib diisi.',
            'nama.unique'   => 'Nama kategori sudah terdaftar.',
        ]);

        $kategori->update($validated);

        return redirect()->route('kategori.index')
            ->with('sukses', 'Kategori berhasil diperbarui.');
    }

    public function destroy(Kategori $kategori)
    {
        // Cegah penghapusan jika masih ada buku yang memakai kategori ini
        if ($kategori->bukus()->exists()) {
            return redirect()->route('kategori.index')
                ->with('gagal', 'Kategori tidak dapat dihapus karena masih memiliki data buku.');
        }

        $kategori->delete();

        return redirect()->route('kategori.index')
            ->with('sukses', 'Kategori berhasil dihapus.');
    }
}