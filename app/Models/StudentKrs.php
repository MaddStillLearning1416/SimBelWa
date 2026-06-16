<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentKrs extends Model
{
    use HasFactory;
    protected $guarded = [];

    // Relasi dari KRS ke Kelas yang diambil
    public function courseClass()
    {
        return $this->belongsTo(CourseClass::class, 'course_class_id');
    }
}   