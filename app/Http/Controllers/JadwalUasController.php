<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\StudentKrs;

class JadwalUasController extends Controller
{
    public function index()
    {
        // Ambil data mahasiswa
        $mahasiswa = Student::with(['prodi.faculty', 'user'])->where('nim', '2410511116')->first();

        // Ambil data jadwal dari KRS
        $jadwal_uas = StudentKrs::with(['courseClass.course'])
            ->where('student_id', $mahasiswa->id ?? 1)
            ->get();

        return view('jadwal_uas', compact('mahasiswa', 'jadwal_uas'));
    }
}