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
        $cari = $request->query('cari');
        $kategoriId = $request->query('kategori_id');

        $buku = Buku::with('kategori')
            ->when($cari, function ($query, $cari) {
                $query->where(function ($q) use ($cari) {
                    $q->where('judul', 'like', "%{$cari}%")
                      ->orWhere('kode', 'like', "%{$cari}%");
                });
            })
            ->when($kategoriId, function ($query, $kategoriId) {
                $query->where('kategori_id', $kategoriId);
            })
            ->orderBy('kode')
            ->get();

        $kategoris = Kategori::orderBy('nama')->get();

        return view('buku.index', compact('buku', 'kategoris', 'cari', 'kategoriId'));
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