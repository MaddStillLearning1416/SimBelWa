<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class KelasDetailSeeder extends Seeder
{
    public function run()
    {
        // 1. CARI KELAS PERTAMA SECARA OTOMATIS (Sistem Pintar)
        $kelas = DB::table('course_classes')->first();

        // 2. SISTEM PENCEGAH ERROR: Jika tabel kelas masih kosong, batalkan seeder
        if (!$kelas) {
            $this->command->warn('⚠️ TABEL KELAS KOSONG! Seeder dibatalkan.');
            $this->command->info('💡 Silakan isi data awal (Mahasiswa & Kelas) terlebih dahulu menggunakan: php artisan db:seed');
            return; 
        }

        // 3. GUNAKAN ID KELAS YANG DITEMUKAN
        $id_kelas = $kelas->id; 

        // ==========================================
        // PERTEMUAN 1
        // ==========================================
        $pertemuan1 = DB::table('class_meetings')->insertGetId([
            'course_class_id' => $id_kelas,
            'pertemuan_ke' => 1,
            'judul_pertemuan' => 'Pengantar Internet of Things & Mikrokontroler',
            'metode' => 'Offline',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Materi Pertemuan 1
        DB::table('materials')->insert([
            'class_meeting_id' => $pertemuan1,
            'judul_materi' => 'Slide 1 - Konsep Dasar IoT dan Arsitektur',
            'tipe_file' => 'Dokumen PDF',
            'ukuran_file' => '2.4 MB',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Forum Pertemuan 1
        DB::table('forums')->insert([
            'class_meeting_id' => $pertemuan1,
            'topik' => 'Setup Lingkungan MicroPython untuk Raspberry Pi Pico',
            'tenggat_waktu' => Carbon::now()->addDays(3),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Kuis Pertemuan 1
        DB::table('quizzes')->insert([
            'class_meeting_id' => $pertemuan1,
            'judul_kuis' => 'Kuis 1: Pengenalan Komponen IoT',
            'durasi_menit' => 30,
            'jumlah_soal' => 20,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Tugas Pertemuan 1
        DB::table('assignments')->insert([
            'class_meeting_id' => $pertemuan1,
            'course_class_id' => $id_kelas, 
            'judul_tugas' => 'Tugas 1: Blink LED dengan Raspberry Pi Pico',
            'tenggat_waktu' => Carbon::now()->addDays(5),
            'sifat_tugas' => 'Wajib Dikerjakan',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // ==========================================
        // PERTEMUAN 2
        // ==========================================
        $pertemuan2 = DB::table('class_meetings')->insertGetId([
            'course_class_id' => $id_kelas,
            'pertemuan_ke' => 2,
            'judul_pertemuan' => 'Implementasi Sensor Navigasi & Aktuator',
            'metode' => 'Offline',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Materi Pertemuan 2
        DB::table('materials')->insert([
            'class_meeting_id' => $pertemuan2,
            'judul_materi' => 'Slide 2 - Penggunaan IMU dan Sensor Ultrasonik',
            'tipe_file' => 'Dokumen PPTX',
            'ukuran_file' => '4.1 MB',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Forum Pertemuan 2
        DB::table('forums')->insert([
            'class_meeting_id' => $pertemuan2,
            'topik' => 'Diskusi Konsep Pedestrian Dead Reckoning (PDR)',
            'tenggat_waktu' => Carbon::now()->addDays(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Tugas Pertemuan 2
        DB::table('assignments')->insert([
            'class_meeting_id' => $pertemuan2,
            'course_class_id' => $id_kelas,
            'judul_tugas' => 'Mini Project: Membaca Data Sensor Ultrasonik',
            'tenggat_waktu' => Carbon::now()->addDays(12),
            'sifat_tugas' => 'Praktikum',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        $this->command->info('✅ Data Pertemuan & Materi berhasil ditambahkan!');
    }
}