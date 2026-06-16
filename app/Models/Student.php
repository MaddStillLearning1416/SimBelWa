<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Student extends Authenticatable
{
    use HasFactory;

    protected $guarded = [];

    // 3. Tambahkan hidden untuk menyembunyikan password
    protected $hidden = [
        'password',
        'remember_token',
    ];
    public function prodi()
    {
        return $this->belongsTo(StudyProgram::class, 'study_program_id');
    }

    // Tambahkan relasi ini
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}       