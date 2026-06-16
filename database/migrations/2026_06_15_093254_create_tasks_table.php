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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            // Menghubungkan tugas dengan kelas mata kuliah tertentu
            $table->foreignId('course_class_id')->constrained('course_classes')->onDelete('cascade');
            $table->string('judul');
            $table->dateTime('tenggat_waktu'); // Tanggal dan jam deadline
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
