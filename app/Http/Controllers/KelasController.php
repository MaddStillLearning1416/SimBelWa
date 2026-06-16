<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KelasController extends Controller
{
    // Fungsi untuk halaman utama "Kelas Mahasiswa" (Gambar 1)
    public function index()
    {
        $mahasiswa = \App\Models\Student::with(['prodi.faculty', 'user'])->where('nim', '2410511116')->first();

        $kelas_list = \App\Models\StudentKrs::with(['courseClass.course', 'courseClass.lecturer'])
            ->where('student_id', $mahasiswa->id)
            ->where('status_persetujuan', 'Disetujui')
            ->get();

        return view('kelas', compact('mahasiswa', 'kelas_list'));
    }

    // Fungsi untuk halaman "Detail Kelas" (Gambar 2) yang memanggil parameter {id}
    public function show($id)
    {
        $mahasiswa = \App\Models\Student::with(['prodi.faculty', 'user'])->where('nim', '2410511116')->first();

        // 1. Ambil detail kelas beserta relasi pertemuan dan isinya
        // PENTING: Sesuaikan nama relasi 'meetings', 'materials', 'assignments' dengan yang ada di Model Anda!
        $detail_kelas = \App\Models\CourseClass::with([
            'course', 
            'lecturer',
            'meetings.materials',   // Relasi ke tabel materi
            'meetings.forums',      // Relasi ke tabel forum
            'meetings.quizzes',     // Relasi ke tabel kuis
            'meetings.assignments'  // Relasi ke tabel tugas
        ])->findOrFail($id);

        // 2. Ambil tugas mendatang (deadline belum lewat) khusus untuk kelas ini
        // (Asumsi Anda memiliki model Assignment yang berelasi dengan CourseClass)
        $tugas_mendatang = \App\Models\Assignment::where('course_class_id', $id)
            ->where('tenggat_waktu', '>=', now())
            ->orderBy('tenggat_waktu', 'asc')
            ->take(3) // Ambil 3 tugas terdekat
            ->get();

        return view('kelas_detail', compact('mahasiswa', 'detail_kelas', 'tugas_mendatang'));
    }
}