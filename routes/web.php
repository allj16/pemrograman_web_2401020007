<?php

use Illuminate\Support\Facades\Route;

Route::get('/latihan-php', function () {
    // 1. Nama disesuaikan dengan nama kamu
    $nama = 'Alfa Julyana'; 

    // 2. Menggunakan LIMA nilai integer (Uji Data 1: Menghasilkan Lulus)
    $nilai = [80, 85, 75, 90, 88]; 

    // Fungsi hitung rata-rata dengan perulangan foreach
    $hitungRataRata = function (array $data): float {
        $total = 0;
        foreach ($data as $angka) {
            $total += $angka;
        }
        return $total / count($data);
    };

    $rataRata = $hitungRataRata($nilai);

    // Percabangan status kelulusan (minimal 75)
    if ($rataRata >= 75) {
        $status = 'Lulus';
    } else {
        $status = 'Perlu Perbaikan';
    }

    return view('latihan-php', compact(
        'nama', 'nilai', 'rataRata', 'status'
    ));
});