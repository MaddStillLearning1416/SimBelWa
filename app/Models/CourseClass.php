<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseClass extends Model
{
    use HasFactory;

    // ... (mungkin di sini ada kode relasi lain milikmu, seperti relasi ke Dosen/Course) ...

    public function course() {
        return $this->belongsTo(Course::class);
    }

    public function lecturer() {
        return $this->belongsTo(Lecturer::class);
    }

    // ==========================================
    // TAMBAHKAN INI TEPAT DI ATAS KURUNG PENUTUP
    // ==========================================
    public function meetings()
    {
        return $this->hasMany(ClassMeeting::class, 'course_class_id');
    }

    public function examSchedule()
    {
        return $this->hasOne(ExamSchedule::class, 'course_class_id');
    }

}