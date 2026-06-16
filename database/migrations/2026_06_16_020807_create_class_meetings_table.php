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
        Schema::create('class_meetings', function (Blueprint $table) {
            $table->id();
            // Sesuaikan nama tabel referensi ('course_classes') dengan yang ada di database kamu
            $table->foreignId('course_class_id')->constrained('course_classes')->onDelete('cascade');
            $table->integer('pertemuan_ke');
            $table->string('judul_pertemuan');
            $table->string('metode')->default('Offline');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('class_meetings');
    }
};
