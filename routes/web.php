<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KrsController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\TranskripController; // <-- TAMBAHKAN INI
use App\Http\Controllers\JadwalController; // <-- TAMBAHKAN INI
use App\Http\Controllers\JadwalUtsController;
use App\Http\Controllers\JadwalUasController;
use App\Http\Controllers\KeuanganController;

// Route untuk menampilkan halaman login
Route::get('/login', function () {
    return view('login');
})->name('login');

// Route untuk memproses login (bisa kamu sesuaikan dengan controller-mu nanti)
Route::post('/login', [App\Http\Controllers\AuthController::class, 'login'])->name('login.post');
Route::get('/keuangan', [KeuanganController::class, 'index']);
// ... route lainnya ...
Route::get('/jadwal-uas', [JadwalUasController::class, 'index']);

// Route untuk halaman daftar kelas (yang sudah kita buat)
Route::get('/kelas', [KelasController::class, 'index']);

// Route BARU untuk halaman detail kelas (gambar kedua)
// Tanda {id} berarti parameter yang dinamis (berubah-ubah sesuai kelas yang diklik)
Route::get('/kelas/{id}', [KelasController::class, 'show']);
// Route untuk halaman KRS
Route::get('/krs', [KrsController::class, 'index']);
// Route untuk Dashboard    

// Route Dashboard (Dilindungi oleh middleware 'auth')
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard');
// URL '/profil' akan memanggil ProfileController
Route::get('/profil', [ProfileController::class, 'index']);
Route::get('/transkrip', [TranskripController::class, 'index']);
// ... route lainnya ...
Route::get('/jadwal-uts', [JadwalUtsController::class, 'index']);