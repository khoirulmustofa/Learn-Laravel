<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AsramaStudent extends Model
{
    use HasFactory;
    protected $table = 'asrama_student';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = true;
}
