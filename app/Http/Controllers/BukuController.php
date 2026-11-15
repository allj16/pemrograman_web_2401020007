<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BukuController extends Controller
{
    public function index(Request $request): View
    {
        $cari = trim((string) $request->query('cari', ''));

        $buku = Buku::with('kategori')
            ->when($cari !== '', function ($query) use ($cari) {
                $query->where('judul', 'like', "%{$cari}%");
            })
            ->get();

        return view('buku.index', compact('buku', 'cari'));
    }

    public function create(): View
    {
        $kategori = Kategori::orderBy('nama')->get();

        return view('buku.form', [
            'buku' => null,
            'kategori' => $kategori,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'kode' => 'required|string|max:20|unique:bukus,kode',
            'judul' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategoris,id',
        ]);

        Buku::create($validated);

        return redirect()->route('buku.index')->with('sukses', 'Buku berhasil ditambahkan.');
    }

    public function show(Buku $buku): View
    {
        $buku->load('kategori');

        return view('buku.show', compact('buku'));
    }

    public function edit(Buku $buku): View
    {
        $kategori = Kategori::orderBy('nama')->get();

        return view('buku.form', compact('buku', 'kategori'));
    }

    public function update(Request $request, Buku $buku): RedirectResponse
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategoris,id',
        ]);

        $buku->update($validated);

        return redirect()->route('buku.index')->with('sukses', 'Perubahan buku tersimpan.');
    }

    public function destroy(Buku $buku): RedirectResponse
    {
        $buku->delete();

        return redirect()->route('buku.index')->with('sukses', 'Buku berhasil dihapus.');
    }
}