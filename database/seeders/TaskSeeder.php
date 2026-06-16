<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Task;
use Carbon\Carbon;

class TaskSeeder extends Seeder
{
    public function run()
    {
        // Menghapus data tugas lama agar tidak dobel saat di-seed ulang
        Task::truncate();

        // Daftar banyak tugas
        $daftar_tugas = [
            ['course_class_id' => 1, 'judul' => 'Latihan Pertemuan 1 - Konsep Dasar', 'tenggat_waktu' => '2026-06-16 23:59:00'],
            ['course_class_id' => 2, 'judul' => 'Tugas Mandiri: Analisis Jaringan', 'tenggat_waktu' => '2026-06-17 15:00:00'],
            ['course_class_id' => 3, 'judul' => 'Kuis 1 - Pemrograman Web', 'tenggat_waktu' => '2026-06-18 10:00:00'],
            ['course_class_id' => 1, 'judul' => 'Tugas Praktikum Modul 1 & 2', 'tenggat_waktu' => '2026-06-19 23:59:00'],
            ['course_class_id' => 2, 'judul' => 'Makalah Keamanan Siber', 'tenggat_waktu' => '2026-06-20 08:00:00'],
            ['course_class_id' => 3, 'judul' => 'Presentasi Proposal Projek', 'tenggat_waktu' => '2026-06-21 13:00:00'],
            ['course_class_id' => 1, 'judul' => 'Review Jurnal Internasional', 'tenggat_waktu' => '2026-06-22 23:59:00'],
            ['course_class_id' => 2, 'judul' => 'Latihan Pertemuan 3', 'tenggat_waktu' => '2026-06-24 23:59:00'],
        ];

        // Masukkan semua tugas ke database menggunakan looping
        foreach ($daftar_tugas as $tugas) {
            Task::create([
                'course_class_id' => $tugas['course_class_id'],
                'judul' => $tugas['judul'],
                'tenggat_waktu' => Carbon::parse($tugas['tenggat_waktu'])
            ]);
        }
    }
}