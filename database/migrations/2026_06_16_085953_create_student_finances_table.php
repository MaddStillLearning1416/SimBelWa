<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('student_finances', function (Blueprint $table) {
            $table->id();
            // Relasi ke mahasiswa
            $table->foreignId('student_id')->constrained('students')->cascadeOnDelete();
            
            // Detail Tagihan
            $table->string('periode'); // Contoh: '2024 Ganjil'
            $table->string('jenis_tagihan'); // Contoh: 'UKT', 'Dukbangdik'
            $table->integer('cicilan_ke')->default(1);
            $table->integer('nominal_tagihan');
            $table->integer('potongan')->default(0);
            $table->integer('sisa_tagihan')->default(0);
            $table->string('status_bayar')->default('BELUM LUNAS'); // 'LUNAS' / 'BELUM LUNAS'
            $table->date('tanggal_bayar')->nullable();
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_finances');
    }
};