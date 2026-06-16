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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            
            // Ubah menjadi nullable agar lebih fleksibel saat insert data
            $table->foreignId('user_id')->nullable()->constrained('users')->cascadeOnDelete();
            
            $table->foreignId('study_program_id')->constrained('study_programs');
            $table->string('nim', 20)->unique();
            $table->string('nama_lengkap');
            $table->year('tahun_masuk');
            $table->enum('status', ['Aktif', 'Cuti', 'Lulus', 'Keluar'])->default('Aktif');
            
            // Kolom Tambahan Baru
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->string('semester_aktif')->nullable();
            $table->decimal('ipk', 4, 2)->nullable();
            $table->integer('sks_lulus')->nullable();
            
            // Kolom Kontak
            $table->string('telepon')->nullable();
            $table->text('alamat')->nullable();
            
            // ==========================================
            // KOLOM WAJIB UNTUK CUSTOM AUTH (LOGIN)
            // ==========================================
            $table->string('password');
            $table->rememberToken();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};