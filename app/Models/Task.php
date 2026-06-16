<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $guarded = [];

    // Relasi balik ke kelas mata kuliah
    public function courseClass()
    {
        return $this->belongsTo(CourseClass::class, 'course_class_id');
    }
}