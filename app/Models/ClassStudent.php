<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassStudent extends Model
{
    use HasFactory;
    protected $table = 'class_student';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = true;

    public function students()
    {
        return $this->belongsTo(Student::class, 'student_id', 'id');
    }
}
