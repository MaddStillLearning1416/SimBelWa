<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassMeeting extends Model
{
    use HasFactory;
    protected $guarded = [];

    // Relasi ke tabel isinya
    public function materials() { return $this->hasMany(Material::class); }
    public function forums() { return $this->hasMany(Forum::class); }
    public function quizzes() { return $this->hasMany(Quiz::class); }
    public function assignments() { return $this->hasMany(Assignment::class); }
}