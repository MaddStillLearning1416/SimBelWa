<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;
use App\Models\StudentFinance;

class KeuanganSeeder extends Seeder
{
    public function run(): void
    {
        $mahasiswa = Student::where('nim', '2410511116')->first();

        if ($mahasiswa) {
            $tagihan = [
                ['periode' => '2024 Ganjil', 'jenis' => 'Pendaftaran dan Testing Masuk', 'nominal' => 375000, 'tgl' => '2024-07-14'],
                ['periode' => '2024 Ganjil', 'jenis' => 'Dukbangdik/IPI', 'nominal' => 26500000, 'tgl' => '2024-07-16'],
                ['periode' => '2024 Ganjil', 'jenis' => 'UKT', 'nominal' => 9100000, 'tgl' => '2024-08-19'],
                ['periode' => '2024 Genap',  'jenis' => 'UKT', 'nominal' => 9100000, 'tgl' => '2025-01-18'],
                ['periode' => '2025 Ganjil', 'jenis' => 'UKT', 'nominal' => 9100000, 'tgl' => '2025-08-18'],
                ['periode' => '2025 Genap',  'jenis' => 'UKT', 'nominal' => 9100000, 'tgl' => '2026-01-19'],
            ];

            foreach ($tagihan as $item) {
                StudentFinance::create([
                    'student_id'      => $mahasiswa->id,
                    'periode'         => $item['periode'],
                    'jenis_tagihan'   => $item['jenis'],
                    'cicilan_ke'      => 1,
                    'nominal_tagihan' => $item['nominal'],
                    'potongan'        => 0,
                    'sisa_tagihan'    => 0, // 0 karena sudah lunas semua di gambar
                    'status_bayar'    => 'LUNAS',
                    'tanggal_bayar'   => $item['tgl'],
                ]);
            }
            $this->command->info('✅ Data Keuangan Mahasiswa berhasil ditambahkan!');
        }
    }
}