<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudyProgram extends Model
{
    use HasFactory;
    protected $guarded = [];

    // Tambahkan relasi ini
    public function faculty()
    {
        return $this->belongsTo(Faculty::class);
    }
}