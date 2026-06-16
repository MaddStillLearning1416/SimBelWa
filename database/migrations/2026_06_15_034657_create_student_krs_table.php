<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
       Schema::create('student_krs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('students')->cascadeOnDelete();
            $table->foreignId('course_class_id')->constrained('course_classes')->cascadeOnDelete();
            
            // Status persetujuan
            $table->enum('status_persetujuan', ['Pending', 'Disetujui', 'Ditolak'])->default('Pending');
            
            // ==========================================
            // KOLOM NILAI & KEHADIRAN (TRANSKRIP)
            // ==========================================
            $table->decimal('nilai_angka', 5, 2)->nullable();
            $table->string('nilai_huruf', 2)->nullable(); 
            $table->integer('kehadiran')->nullable();
            $table->decimal('nilai_partisipatif', 5, 2)->nullable();
            $table->decimal('nilai_tugas_mandiri', 5, 2)->nullable();
            $table->decimal('nilai_tugas_kelompok', 5, 2)->nullable();
            $table->decimal('nilai_uts', 5, 2)->nullable();
            $table->decimal('nilai_uas', 5, 2)->nullable();

            // ==========================================
            // KOLOM JADWAL UTS
            // ==========================================
            $table->string('waktu_ujian')->nullable();
            $table->string('ruang_ujian')->nullable();
            $table->integer('no_duduk')->nullable();

            // ==========================================
            // KOLOM JADWAL UAS (TAMBAHAN BARU)
            // ==========================================
            $table->string('waktu_uas')->nullable();
            $table->string('ruang_uas')->nullable();
            $table->integer('no_duduk_uas')->nullable();
            
            $table->timestamps();
            
            // Mencegah mahasiswa mengambil kelas yang sama dua kali di satu semester
            $table->unique(['student_id', 'course_class_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_krs');
    }
};