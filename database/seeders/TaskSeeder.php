<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CourseClass;
use App\Models\Task;
use Carbon\Carbon;

class TaskSeeder extends Seeder
{
    public function run(): void
    {
        // Cari ID Kelas berdasarkan Nama Mata Kuliah
        $kelas_techno = CourseClass::whereHas('course', function($q){ $q->where('nama_mk', 'Technopreneurship'); })->first();
        $kelas_iot    = CourseClass::whereHas('course', function($q){ $q->where('nama_mk', 'Internet Of Thing'); })->first();
        $kelas_kdj    = CourseClass::whereHas('course', function($q){ $q->where('nama_mk', 'Keamanan Data dan Jaringan'); })->first();
        $kelas_kripto = CourseClass::whereHas('course', function($q){ $q->where('nama_mk', 'Kriptografi'); })->first();

        if ($kelas_techno && $kelas_iot && $kelas_kdj && $kelas_kripto) {
            $tugas = [
                ['course_class_id' => $kelas_techno->id, 'judul' => 'Prototyping UI/UX SmartWaste Route di Figma', 'tenggat_waktu' => Carbon::now()->addDays(1)->format('Y-m-d 23:59:00')],
                ['course_class_id' => $kelas_iot->id,    'judul' => 'NETRA-SENSE: Integrasi Sensor Ultrasonik & IMU (Hardware)', 'tenggat_waktu' => Carbon::now()->addDays(3)->format('Y-m-d 15:00:00')],
                ['course_class_id' => $kelas_kdj->id,    'judul' => 'Analisis Routing OSPF, EIGRP & Implementasi VLAN', 'tenggat_waktu' => Carbon::now()->addDays(5)->format('Y-m-d 10:00:00')],
                ['course_class_id' => $kelas_techno->id, 'judul' => 'Finalisasi Proposal Bisnis Quesilova', 'tenggat_waktu' => Carbon::now()->addDays(7)->format('Y-m-d 23:59:00')],
                ['course_class_id' => $kelas_kripto->id, 'judul' => 'Implementasi Algoritma Enkripsi di Python', 'tenggat_waktu' => Carbon::now()->addDays(10)->format('Y-m-d 12:00:00')],
            ];

            foreach ($tugas as $item) {
                Task::create($item);
            }
        }
    }
}