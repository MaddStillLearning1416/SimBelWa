<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KrsController extends Controller
{
    // Logika harus dibungkus di dalam public function
    public function index()
    {
        // Ambil data mahasiswa (sesuaikan NIM atau Auth dengan logikamu)
        $mahasiswa = \App\Models\Student::with(['prodi.faculty', 'user'])->where('nim', '2410511116')->first();

        // Ambil daftar mata kuliah yang disetujui
        $krs_list = \App\Models\StudentKrs::with(['courseClass.course', 'courseClass.lecturer'])
            ->where('student_id', $mahasiswa->id)
            ->where('status_persetujuan', 'Disetujui')
            ->get();

        return view('krs', compact('mahasiswa', 'krs_list'));
    }
}