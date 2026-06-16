<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;
use App\Models\StudentKrs;

class TranskripSeeder extends Seeder
{
    public function run()
    {
        $mahasiswa = Student::where('nim', '2410511116')->first();

        if ($mahasiswa) {
            $krs_list = StudentKrs::where('student_id', $mahasiswa->id)->get();

            foreach ($krs_list as $krs) {
                // 1. Buat nilai rincian secara acak terlebih dahulu
                $partisipatif   = rand(85, 98);
                $tugas_mandiri  = rand(80, 95);
                $tugas_kelompok = rand(82, 96);
                $uts            = rand(78, 95);
                $uas            = rand(80, 98);

                // 2. Hitung NA (Nilai Akhir) berdasarkan Bobot Persentase
                // Asumsi: Partisipatif 10%, T.Mandiri 20%, T.Kelompok 20%, UTS 25%, UAS 25%
                $na = ($partisipatif * 0.10) + ($tugas_mandiri * 0.20) + ($tugas_kelompok * 0.20) + ($uts * 0.25) + ($uas * 0.25);

                // 3. Konversi NA ke Nilai Huruf secara otomatis
                $huruf = 'E';
                if ($na >= 85) {
                    $huruf = 'A';
                } elseif ($na >= 80) {
                    $huruf = 'A-';
                } elseif ($na >= 75) {
                    $huruf = 'B+';
                } elseif ($na >= 70) {
                    $huruf = 'B';
                } elseif ($na >= 65) {
                    $huruf = 'B-';
                } elseif ($na >= 60) {
                    $huruf = 'C+';
                } elseif ($na >= 55) {
                    $huruf = 'C';
                } elseif ($na >= 40) {
                    $huruf = 'D';
                }

                // 4. Simpan semuanya ke dalam database
                $krs->update([
                    'kehadiran'            => rand(12, 14),
                    'nilai_partisipatif'   => $partisipatif,
                    'nilai_tugas_mandiri'  => $tugas_mandiri,
                    'nilai_tugas_kelompok' => $tugas_kelompok,
                    'nilai_uts'            => $uts,
                    'nilai_uas'            => $uas,
                    'nilai_angka'          => $na,
                    'nilai_huruf'          => $huruf,
                ]);
            }
            
            $this->command->info('✅ Data Transkrip dengan Rumus Perhitungan Bobot berhasil ditambahkan!');
        } else {
            $this->command->error('Mahasiswa tidak ditemukan!');
        }
    }
}