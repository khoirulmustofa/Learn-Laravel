<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KbmMapel extends Model
{
    use HasFactory;

    protected $table = 'kbm_mapel';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = true;

}
