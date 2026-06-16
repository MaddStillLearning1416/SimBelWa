<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('student_krs', function (Blueprint $table) {
            if (!Schema::hasColumn('student_krs', 'waktu_uas')) {
                $table->string('waktu_uas')->nullable();
            }
            if (!Schema::hasColumn('student_krs', 'ruang_uas')) {
                $table->string('ruang_uas')->nullable();
            }
            if (!Schema::hasColumn('student_krs', 'no_duduk_uas')) {
                $table->integer('no_duduk_uas')->nullable();
            }
        });
    }

    public function down()
    {
        Schema::table('student_krs', function (Blueprint $table) {
            $table->dropColumn(['waktu_uas', 'ruang_uas', 'no_duduk_uas']);
        });
    }
};