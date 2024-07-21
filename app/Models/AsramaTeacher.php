<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AsramaTeacher extends Model
{
    use HasFactory;
    protected $table = 'asrama_teacher';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = true;
}
