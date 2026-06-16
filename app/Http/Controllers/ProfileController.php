<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Carbon\Carbon; // Pastikan Carbon dipanggil untuk memformat tanggal

class ProfileController extends Controller
{
    public function index()
    {
        // 1. Ambil data mahasiswa beserta relasinya
        $mahasiswa = Student::with(['prodi.faculty', 'user'])->where('nim', '2410511116')->first();

        // 2. Format Tempat dan Tanggal Lahir
        $ttl = null;
        if ($mahasiswa->tempat_lahir && $mahasiswa->tanggal_lahir) {
            // Mengubah format "2006-05-14" menjadi "14 Mei 2006"
            $tanggal_format = Carbon::parse($mahasiswa->tanggal_lahir)->locale('id')->translatedFormat('d F Y');
            $ttl = $mahasiswa->tempat_lahir . ', ' . $tanggal_format;
        }

        // 3. Kirim data $mahasiswa dan $ttl ke file profil.blade.php
        return view('profil', compact('mahasiswa', 'ttl'));
    }
}