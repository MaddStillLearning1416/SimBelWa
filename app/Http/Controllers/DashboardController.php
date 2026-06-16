<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\StudentKrs;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // 1. PASTIKAN IMPORT AUTH
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // 2. Ambil data user yang sedang login saat ini
        $user = Auth::user();

        // 3. Cari data mahasiswa secara dinamis berdasarkan user yang login
        // Hubungkan berdasarkan user_id (atau berdasarkan 'nim' jika kolom itu ada di tabel users Anda)
        $mahasiswa = Student::with(['prodi.faculty', 'user'])
            ->where('user_id', $user->id) 
            ->first();

        // Antisipasi jika data mahasiswa tidak ditemukan di database
        if (!$mahasiswa) {
            Auth::logout();
            return redirect()->route('login')->withErrors(['nim' => 'Profil akademik Anda tidak ditemukan.']);
        }

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

        // --- LOGIKA TIMELINE TUGAS ---
        $kelas_diambil = $krs->pluck('course_class_id')->toArray();

        $tugas_mahasiswa = Task::with('courseClass.course')
            ->whereIn('course_class_id', $kelas_diambil)
            ->orderBy('tenggat_waktu', 'asc')
            ->take(10) 
            ->get();

        return view('dashboard', compact(
            'mahasiswa', 'salam', 'tanggalSekarang', 'namaHariIni', 'sks_semester', 'kelas_hari_ini', 'tugas_mahasiswa'
        ));
    }
}