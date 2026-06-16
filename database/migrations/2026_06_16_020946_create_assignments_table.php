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
        Schema::create('assignments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('class_meeting_id')->constrained('class_meetings')->onDelete('cascade');
            // Jika ada relasi langsung ke kelas untuk "Tugas Mendatang" di dashboard
            $table->foreignId('course_class_id')->nullable()->constrained('course_classes')->onDelete('cascade');
            $table->string('judul_tugas');
            $table->dateTime('tenggat_waktu');
            $table->string('sifat_tugas')->default('Wajib Dikerjakan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assignments');
    }
};
