<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\StudentKrs;
use App\Models\Task;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $mahasiswa = Student::with(['prodi.faculty', 'user'])->where('nim', '2410511116')->first();

        Carbon::setLocale('id');
        $now = Carbon::now('Asia/Jakarta');
        $namaHariIni = $now->translatedFormat('l');
        $tanggalSekarang = $now->translatedFormat('l, d F Y | H.i.s');

        $jam = $now->hour;
        if ($jam < 11) {
            $salam = 'Selamat Pagi';
        } elseif ($jam < 15) {
            $salam = 'Selamat Siang';
        } elseif ($jam < 18) {
            $salam = 'Selamat Sore';
        } else {
            $salam = 'Selamat Malam';
        }

        $krs = StudentKrs::with(['courseClass.course', 'courseClass.lecturer'])
            ->where('student_id', $mahasiswa->id)
            ->where('status_persetujuan', 'Disetujui')
            ->get();

        $sks_semester = $krs->sum(function ($item) {
            return $item->courseClass->course->sks ?? 0;
        });

        $kelas_hari_ini = $krs->filter(function ($item) use ($namaHariIni) {
            return strtolower($item->courseClass->hari) === strtolower($namaHariIni);
        });

        // --- LOGIKA BARU: AMBIL TIMELINE TUGAS ---
        // 1. Ambil ID dari semua kelas yang diambil mahasiswa
        $kelas_diambil = $krs->pluck('course_class_id')->toArray();

        // 2. Cari tugas yang ID kelasnya ada di dalam daftar kelas mahasiswa
        // Urutkan dari tenggat waktu terdekat (Ascending), dan ambil maksimal 3 tugas saja
        $tugas_mahasiswa = Task::with('courseClass.course')
            ->whereIn('course_class_id', $kelas_diambil)
            ->orderBy('tenggat_waktu', 'asc')
            ->take(10) // Sekarang menampilkan hingga 10 tugas
            ->get();

        return view('dashboard', compact(
            'mahasiswa', 'salam', 'tanggalSekarang', 'namaHariIni', 'sks_semester', 'kelas_hari_ini', 'tugas_mahasiswa'
        ));
    }
}