<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'date_of_birth',
        'address',
        'gender',
    ];

    public function classes()
    {
        return $this->belongsToMany(ClassModel::class, 'class_student', 'student_id', 'class_id')
            ->withPivot('academic_year', 'semester', 'status')
            ->withTimestamps();
    }

    public function asramas()
    {
        return $this->belongsToMany(Asrama::class, 'asrama_student', 'student_id', 'asrama_id')
            ->withPivot('academic_year', 'semester', 'status')
            ->withTimestamps();
    }

    public function kbmPresensis()
    {
        return $this->hasMany(KbmPresensi::class);
    }

    public function classStudent()
    {
        return $this->hasMany(ClassStudent::class,'student_id','id');
    }

    public function guardians()
    {
        return $this->belongsToMany(Guardian::class, 'guardian_student', 'student_id', 'guardian_id');
    }
}
