<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\StudentKrs;

class JadwalUtsController extends Controller
{
    public function index()
    {
        // Ambil data mahasiswa Ahmad Billal
        $mahasiswa = Student::with(['prodi.faculty', 'user'])->where('nim', '2410511116')->first();

        // Ambil data jadwal dari KRS (kamu bisa menyesuaikan relasinya dengan database-mu nanti)
        $jadwal_uts = StudentKrs::with(['courseClass.course'])
            ->where('student_id', $mahasiswa->id ?? 1)
            ->get();

        return view('jadwal_uts', compact('mahasiswa', 'jadwal_uts'));
    }
}