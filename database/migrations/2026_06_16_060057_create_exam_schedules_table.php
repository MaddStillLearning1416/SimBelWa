<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
    {
        Schema::create('exam_schedules', function (Blueprint $table) {
            $table->id();
            // Kolom untuk menghubungkan jadwal ke kelas tertentu
            $table->foreignId('course_class_id')->constrained('course_classes')->cascadeOnDelete();
            
            // Kolom detail jadwal ujian
            $table->string('waktu_ujian')->nullable();
            $table->string('ruang')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exam_schedules');
    }
};
