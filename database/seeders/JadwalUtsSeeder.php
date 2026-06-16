<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;
use App\Models\StudentKrs;

class JadwalUtsSeeder extends Seeder
{
    public function run()
    {
        // Cari data mahasiswa
        $mahasiswa = Student::where('nim', '2410511116')->first();

        if ($mahasiswa) {
            $krs_list = StudentKrs::where('student_id', $mahasiswa->id)->get();

            // Variasi jadwal ruangan dan waktu
            $jadwal = [
                ['waktu' => 'Rabu - 09:40-11:20', 'ruang' => 'FIKLAB-402'],
                ['waktu' => 'Kamis - 13:00-14:40', 'ruang' => 'FIKLAB-304'],
                ['waktu' => 'Jumat - 13:00-16:00', 'ruang' => 'FIK-301'],
                ['waktu' => 'Senin - 15:30-18:00', 'ruang' => 'FIKLAB-304'],
                ['waktu' => 'Selasa - 15:30-18:00', 'ruang' => 'FIK-202'],
                ['waktu' => 'Selasa - 09:40-11:20', 'ruang' => 'FIKLAB-403'],
            ];

            foreach ($krs_list as $index => $krs) {
                // Update tabel student_krs dengan jadwal UTS
                $krs->update([
                    'waktu_ujian' => $jadwal[$index % count($jadwal)]['waktu'],
                    'ruang_ujian' => $jadwal[$index % count($jadwal)]['ruang'],
                    'no_duduk'    => rand(10, 40), // Nomor duduk acak antara 10 sampai 40
                ]);
            }
            
            $this->command->info('✅ Jadwal UTS berhasil ditambahkan!');
        } else {
            $this->command->error('Mahasiswa tidak ditemukan!');
        }
    }
}