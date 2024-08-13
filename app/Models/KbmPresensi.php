<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KbmPresensi extends Model
{
    use HasFactory;

    protected $table = 'kbm_presensi';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = true;

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function jadwal()
    {
        return $this->belongsTo(KbmJadwal::class);
    }

}
