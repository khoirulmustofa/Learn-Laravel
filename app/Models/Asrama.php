<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asrama extends Model
{
    use HasFactory;
    protected $table = 'asrama';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = true;

    public function students()
    {
        return $this->belongsToMany(Student::class, 'asrama_student', 'asrama_id', 'student_id')
            ->withPivot('academic_year', 'semester', 'status')
            ->withTimestamps();
    }

    public function teachers()
    {
        return $this->belongsToMany(User::class, 'asrama_teacher', 'asrama_id', 'user_id')
            ->withPivot('academic_year', 'semester')
            ->withTimestamps();
    }
}
   
