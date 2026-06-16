<?php

namespace App\Models;

// WAJIB PAKAI INI:
use Illuminate\Foundation\Auth\User as Authenticatable; 
use Illuminate\Database\Eloquent\Factories\HasFactory;

// WAJIB EXTENDS Authenticatable (BUKAN Model)
class Student extends Authenticatable 
{
    use HasFactory;
    
    // ... isi lainnya
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