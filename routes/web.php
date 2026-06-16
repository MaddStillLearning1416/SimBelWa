<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KrsController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\TranskripController; 
use App\Http\Controllers\JadwalUtsController;
use App\Http\Controllers\JadwalUasController;
use App\Http\Controllers\KeuanganController;
use Illuminate\Support\Facades\Route;

// ==========================================
// RUTE PUBLIK (BISA DIAKSES SIAPA SAJA)
// ==========================================
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');


// ==========================================
// AREA TERLARANG (WAJIB LOGIN SEBAGAI STUDENT)
// ==========================================
Route::middleware(['auth:student'])->group(function () {

    // 1. Route Dashboard Utama
    Route::get('/dashboard', function () {
        
        // Data Mahasiswa
        $mahasiswa = auth()->guard('student')->user();
        
        // Logika Salam
        $jam = date('H'); 
        if ($jam >= 5 && $jam < 11) { $salam = 'Selamat Pagi'; } 
        elseif ($jam >= 11 && $jam < 15) { $salam = 'Selamat Siang'; } 
        elseif ($jam >= 15 && $jam < 18) { $salam = 'Selamat Sore'; } 
        else { $salam = 'Selamat Malam'; }

        // Hitung SKS Dinamis
        $sks_semester = \App\Models\StudentKrs::where('student_id', $mahasiswa->id)
            ->join('course_classes', 'student_krs.course_class_id', '=', 'course_classes.id')
            ->join('courses', 'course_classes.course_id', '=', 'courses.id')
            ->sum('courses.sks');

        // Dapatkan Nama Hari Ini dalam Bahasa Indonesia
        $namaHariIni = \Carbon\Carbon::now()->locale('id')->isoFormat('dddd');

        // Ambil Jadwal Kelas Hari Ini 
        $kelas_hari_ini = \App\Models\StudentKrs::with(['courseClass.course', 'courseClass.lecturer'])
            ->where('student_id', $mahasiswa->id)
            ->whereHas('courseClass', function($query) use ($namaHariIni) {
                $query->where('hari', $namaHariIni);
            })->get();

        // Ambil Data Tugas dari tabel tasks
        $kelas_diambil = \App\Models\StudentKrs::where('student_id', $mahasiswa->id)->pluck('course_class_id');
        $tugas_mahasiswa = \App\Models\Task::with('courseClass.course')
            ->whereIn('course_class_id', $kelas_diambil)
            ->orderBy('tenggat_waktu', 'asc')
            ->get();

        // Kirim SEMUA variabel ke tampilan
        return view('dashboard', compact(
            'mahasiswa', 'salam', 'sks_semester', 'namaHariIni', 'kelas_hari_ini', 'tugas_mahasiswa'
        ));
        
    })->name('dashboard');

    // 2. Route Profil & KRS
    Route::get('/profil', [ProfileController::class, 'index']);
    Route::get('/krs', [KrsController::class, 'index']);

    // 3. Route Kelas
    Route::get('/kelas', [KelasController::class, 'index']);
    Route::get('/kelas/{id}', [KelasController::class, 'show']);

    // 4. Route Akademik & Ujian
    Route::get('/transkrip', [TranskripController::class, 'index']);
    Route::get('/jadwal-uts', [JadwalUtsController::class, 'index']);
    Route::get('/jadwal-uas', [JadwalUasController::class, 'index']);

    // 5. Route Keuangan
    Route::get('/keuangan', [KeuanganController::class, 'index']);

    // 6. Route Logout
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

});