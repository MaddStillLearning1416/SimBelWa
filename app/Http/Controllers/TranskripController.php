<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TranskripController extends Controller
{
    public function index()
    {
        // 1. Ambil data mahasiswa
        $mahasiswa = \App\Models\Student::with(['prodi.faculty', 'user'])->where('nim', '2410511116')->first();

        // 2. Ambil data KRS yang sudah memiliki nilai_huruf (artinya sudah selesai/lulus)
        $transkrip_list = \App\Models\StudentKrs::with(['courseClass.course'])
            ->where('student_id', $mahasiswa->id)
            ->whereNotNull('nilai_huruf')
            ->get();

        // 3. Ambil data nilai khusus untuk semester berjalan (filter di tabel kedua)
        $nilai_semester_list = \App\Models\StudentKrs::with(['courseClass.course'])
            ->where('student_id', $mahasiswa->id)
            // Asumsi courseClass memiliki relasi ke periode semester, disederhanakan:
            ->whereNotNull('nilai_angka')
            ->get();

        // 4. Hitung Statistik Sederhana
        $statistik = [
            'kurikulum' => '511.2024', // Bisa dinamis dari prodi
            'sks_lulus' => $mahasiswa->sks_lulus ?? 0,
            'beban_sks' => 144,
            'ipk'       => $mahasiswa->ipk ?? '0.00',
            'nilai_A'   => $transkrip_list->whereIn('nilai_huruf', ['A', 'A-'])->count(),
            'nilai_B'   => $transkrip_list->whereIn('nilai_huruf', ['B+', 'B', 'B-'])->count(),
            'nilai_C'   => $transkrip_list->whereIn('nilai_huruf', ['C+', 'C'])->count(),
            'nilai_D'   => $transkrip_list->where('nilai_huruf', 'D')->count(),
            'nilai_E'   => $transkrip_list->where('nilai_huruf', 'E')->count(),
        ];

        return view('transkrip', compact('mahasiswa', 'transkrip_list', 'nilai_semester_list', 'statistik'));
    }
}