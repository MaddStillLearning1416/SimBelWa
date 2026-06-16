<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;
use App\Models\StudentKrs;

class JadwalUasSeeder extends Seeder
{
    public function run()
    {
        // Cari data mahasiswa
        $mahasiswa = Student::where('nim', '2410511116')->first();

        if ($mahasiswa) {
            $krs_list = StudentKrs::where('student_id', $mahasiswa->id)->get();

            // Variasi jadwal ruangan dan waktu untuk UAS
            $jadwal_uas = [
                ['waktu' => 'Rabu - 08:00-09:40', 'ruang' => 'FIKLAB-402'],
                ['waktu' => 'Kamis - 10:00-11:40', 'ruang' => 'FIKLAB-304'],
                ['waktu' => 'Jumat - 13:00-15:30', 'ruang' => 'FIK-301'],
                ['waktu' => 'Senin - 13:00-15:30', 'ruang' => 'FIKLAB-304'],
                ['waktu' => 'Selasa - 13:00-15:30', 'ruang' => 'FIK-202'],
                ['waktu' => 'Selasa - 08:00-09:40', 'ruang' => 'FIKLAB-403'],
            ];

            foreach ($krs_list as $index => $krs) {
                // Update tabel student_krs khusus untuk kolom UAS
                $krs->update([
                    'waktu_uas'    => $jadwal_uas[$index % count($jadwal_uas)]['waktu'],
                    'ruang_uas'    => $jadwal_uas[$index % count($jadwal_uas)]['ruang'],
                    'no_duduk_uas' => rand(10, 40), 
                ]);
            }
            
            $this->command->info('✅ Jadwal UAS berhasil ditambahkan!');
        } else {
            $this->command->error('Mahasiswa tidak ditemukan!');
        }
    }
}