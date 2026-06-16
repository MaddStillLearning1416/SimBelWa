<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\StudentFinance;

class KeuanganController extends Controller
{
    public function index()
    {
        $mahasiswa = Student::with(['prodi.faculty', 'user'])->where('nim', '2410511116')->first();
        
        // Ambil data tagihan keuangan
        $keuangan = StudentFinance::where('student_id', $mahasiswa->id ?? 1)->get();
        
        // Hitung total sisa tagihan untuk ringkasan di bawah tabel
        $total_sisa = $keuangan->sum('sisa_tagihan');

        return view('keuangan', compact('mahasiswa', 'keuangan', 'total_sisa'));
    }
}