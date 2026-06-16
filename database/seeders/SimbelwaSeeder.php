<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Faculty;
use App\Models\StudyProgram;
use App\Models\AcademicPeriod;
use App\Models\Lecturer;
use App\Models\Student;
use App\Models\Course;
use App\Models\CourseClass;
use App\Models\StudentKrs;
use Illuminate\Support\Facades\Hash;

class SimbelwaSeeder extends Seeder
{
    public function run(): void
    {
        // ---------------------------------------------------------
        // 1. DATA FAKULTAS & PROGRAM STUDI
        // ---------------------------------------------------------
        $fik = Faculty::create(['nama_fakultas' => 'Fakultas Ilmu Komputer']);
        
        $informatika = StudyProgram::create(['faculty_id' => $fik->id, 'nama_prodi' => 'S1 Informatika', 'jenjang' => 'S1']);

        // ---------------------------------------------------------
        // 2. DATA PERIODE AKADEMIK
        // ---------------------------------------------------------
        $genap25 = AcademicPeriod::create(['tahun_akademik' => '2025/2026', 'semester' => 'Genap', 'is_active' => true]);

        // ---------------------------------------------------------
        // 3. DATA AKUN (USERS) & PROFIL DOSEN
        // ---------------------------------------------------------
        $userDosen1 = User::create(['name' => 'Dr. Indra Permana Solihin', 'email' => 'indra@upnvj.ac.id', 'password' => Hash::make('password123')]);
        $dosen1 = Lecturer::create(['user_id' => $userDosen1->id, 'nidn' => '0415088001', 'nama_lengkap' => 'Dr. Indra Permana Solihin', 'gelar' => 'M.Kom']);

        $userDosen2 = User::create(['name' => 'Ichsan Mardani', 'email' => 'ichsan@upnvj.ac.id', 'password' => Hash::make('password123')]);
        $dosen2 = Lecturer::create(['user_id' => $userDosen2->id, 'nidn' => '0415088002', 'nama_lengkap' => 'Ichsan Mardani', 'gelar' => 'S.Kom., MSc.']);

        $userDosen3 = User::create(['name' => 'Henki Bayu Seta', 'email' => 'henki@upnvj.ac.id', 'password' => Hash::make('password123')]);
        $dosen3 = Lecturer::create(['user_id' => $userDosen3->id, 'nidn' => '0415088003', 'nama_lengkap' => 'Henki Bayu Seta', 'gelar' => 'S.Kom., MTI.']);

        // ---------------------------------------------------------
        // 4. DATA AKUN (USERS) & PROFIL MAHASISWA
        // ---------------------------------------------------------
        // ---------------------------------------------------------
        // 4. DATA AKUN (USERS) & PROFIL MAHASISWA
        // ---------------------------------------------------------
        $userMhs1 = User::create(['name' => 'Ahmad Billal', 'email' => 'ahmadbillal@student.upnvj.ac.id', 'password' => Hash::make('password123')]);
        $mhs1 = Student::create([
            'user_id' => $userMhs1->id, 
            'study_program_id' => $informatika->id, 
            'nim' => '2410511116', 
            'nama_lengkap' => 'Ahmad Billal', 
            'tahun_masuk' => 2024, 
            'status' => 'Aktif', 
            'tempat_lahir' => 'Jakarta',              // Data Baru
            'tanggal_lahir' => '2006-05-14',          // Data Baru
            'semester_aktif' => 'Genap 2025/2026',    // Data Baru
            'ipk' => 3.94,                            // Data Baru
            'sks_lulus' => 64,                        // Data Baru
            'telepon' => '081234567890', 
            'alamat' => 'Jakarta Timur',
            'password' => bcrypt('password123')
        ]);

        // ... (Biarkan data mahasiswa lainnya seperti Ananda Naufal dan Muhammad Khalif seperti sebelumnya)

        $userMhs2 = User::create(['name' => 'Ananda Naufal', 'email' => 'naufal@student.upnvj.ac.id', 'password' => Hash::make('password123')]);
        $mhs2 = Student::create([
            'user_id' => $userMhs2->id, 'study_program_id' => $informatika->id, 'nim' => '2410511117', 
            'nama_lengkap' => 'Ananda Naufal', 'tahun_masuk' => 2024, 'status' => 'Aktif', 'telepon' => '081298765432', 'alamat' => 'Jakarta Selatan',
            'password' => bcrypt('password123') // <--- TAMBAHKAN INI UNTUK ANANDA
        ]);

        $userMhs3 = User::create(['name' => 'Muhammad Khalif', 'email' => 'khalif@student.upnvj.ac.id', 'password' => Hash::make('password123')]);
        $mhs3 = Student::create([
            'user_id' => $userMhs3->id, 'study_program_id' => $informatika->id, 'nim' => '2410511118', 
            'nama_lengkap' => 'Muhammad Khalif', 'tahun_masuk' => 2024, 'status' => 'Aktif', 'telepon' => '081255556666', 'alamat' => 'Depok',
            'password' => bcrypt('password123') // <--- TAMBAHKAN INI UNTUK ANANDA
        ]);

        // ---------------------------------------------------------
        // 5. DATA MATA KULIAH
        // ---------------------------------------------------------
        $mk_iot = Course::create(['study_program_id' => $informatika->id, 'kode_mk' => 'INF124404', 'nama_mk' => 'Internet Of Thing', 'sks' => 2, 'kurikulum' => '511.2024']);
        $mk_kdj = Course::create(['study_program_id' => $informatika->id, 'kode_mk' => 'INF124401', 'nama_mk' => 'Keamanan Data dan Jaringan', 'sks' => 2, 'kurikulum' => '511.2024']);
        $mk_techno = Course::create(['study_program_id' => $informatika->id, 'kode_mk' => 'INF124410', 'nama_mk' => 'Technopreneurship', 'sks' => 2, 'kurikulum' => '511.2024']);
        $mk_kripto = Course::create(['study_program_id' => $informatika->id, 'kode_mk' => 'INF124411', 'nama_mk' => 'Kriptografi', 'sks' => 3, 'kurikulum' => '511.2024']);

        // ---------------------------------------------------------
        // 6. DATA KELAS YANG DIBUKA (SEMESTER GENAP)
        // ---------------------------------------------------------
        $kelas_iot_c = CourseClass::create([
            'course_id' => $mk_iot->id, 'academic_period_id' => $genap25->id, 'lecturer_id' => $dosen1->id,
            'nama_kelas' => 'C', 'hari' => 'Rabu', 'jam_mulai' => '09:40:00', 'jam_selesai' => '11:20:00', 'ruangan' => 'FIKLAB-402'
        ]);
        
        $kelas_kdj_c = CourseClass::create([
            'course_id' => $mk_kdj->id, 'academic_period_id' => $genap25->id, 'lecturer_id' => $dosen3->id,
            'nama_kelas' => 'C', 'hari' => 'Kamis', 'jam_mulai' => '13:00:00', 'jam_selesai' => '14:40:00', 'ruangan' => 'FIKLAB-304'
        ]);

        $kelas_techno_c = CourseClass::create([
            'course_id' => $mk_techno->id, 'academic_period_id' => $genap25->id, 'lecturer_id' => $dosen2->id,
            'nama_kelas' => 'C', 'hari' => 'Jumat', 'jam_mulai' => '09:40:00', 'jam_selesai' => '11:20:00', 'ruangan' => 'Virtual Class Room FIK 1'
        ]);

        $kelas_kripto_b = CourseClass::create([
            'course_id' => $mk_kripto->id, 'academic_period_id' => $genap25->id, 'lecturer_id' => $dosen2->id,
            'nama_kelas' => 'B', 'hari' => 'Senin', 'jam_mulai' => '15:30:00', 'jam_selesai' => '18:00:00', 'ruangan' => 'FIKLAB-304'
        ]);

        // ---------------------------------------------------------
        // 7. DATA KRS MAHASISWA
        // ---------------------------------------------------------
        $semua_mahasiswa = [$mhs1, $mhs2, $mhs3];
        
        foreach ($semua_mahasiswa as $mhs) {
            StudentKrs::create(['student_id' => $mhs->id, 'course_class_id' => $kelas_iot_c->id, 'status_persetujuan' => 'Disetujui']);
            StudentKrs::create(['student_id' => $mhs->id, 'course_class_id' => $kelas_kdj_c->id, 'status_persetujuan' => 'Disetujui']);

            if ($mhs->id == $mhs1->id || $mhs->id == $mhs2->id) {
                StudentKrs::create(['student_id' => $mhs->id, 'course_class_id' => $kelas_techno_c->id, 'status_persetujuan' => 'Disetujui']);
                StudentKrs::create(['student_id' => $mhs->id, 'course_class_id' => $kelas_kripto_b->id, 'status_persetujuan' => 'Disetujui']);
            }
        }
    }
}