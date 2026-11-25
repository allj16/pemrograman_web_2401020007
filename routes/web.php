<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\Auth\LoginController;

// Route Autentikasi (Bebas diakses tanpa login)
Route::get('/login', [LoginController::class, 'show'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.proses');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Route Terproteksi Middleware Auth (Wajib login)
Route::middleware('auth')->group(function () {
    Route::get('/', fn () => redirect()->route('buku.index'));
    Route::resource('buku', BukuController::class)->except('show');
    Route::resource('kategori', KategoriController::class);
});