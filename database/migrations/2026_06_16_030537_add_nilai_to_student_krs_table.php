<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('student_krs', function (Blueprint $table) {
            // Cek dan paksa buat semua kolom jika PostgreSQL belum punya
            if (!Schema::hasColumn('student_krs', 'nilai_angka')) {
                $table->decimal('nilai_angka', 5, 2)->nullable();
            }
            if (!Schema::hasColumn('student_krs', 'nilai_huruf')) {
                $table->string('nilai_huruf', 2)->nullable();
            }
            if (!Schema::hasColumn('student_krs', 'kehadiran')) {
                $table->integer('kehadiran')->nullable();
            }
            if (!Schema::hasColumn('student_krs', 'nilai_partisipatif')) {
                $table->decimal('nilai_partisipatif', 5, 2)->nullable();
            }
            if (!Schema::hasColumn('student_krs', 'nilai_tugas_mandiri')) {
                $table->decimal('nilai_tugas_mandiri', 5, 2)->nullable();
            }
            if (!Schema::hasColumn('student_krs', 'nilai_tugas_kelompok')) {
                $table->decimal('nilai_tugas_kelompok', 5, 2)->nullable();
            }
            if (!Schema::hasColumn('student_krs', 'nilai_uts')) {
                $table->decimal('nilai_uts', 5, 2)->nullable();
            }
            if (!Schema::hasColumn('student_krs', 'nilai_uas')) {
                $table->decimal('nilai_uas', 5, 2)->nullable();
            }
        });
    }

    public function down()
    {
        // Tidak perlu isi down untuk fix ini
    }
};