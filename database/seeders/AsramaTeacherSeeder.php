<?php

namespace Database\Seeders;

use App\Models\Asrama;
use App\Models\AsramaTeacher;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AsramaTeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil semua kelas
        $asramas = Asrama::all();

        $academicYear = "20232024";
        $semester = 1;
        $userIds = User::limit($asramas->count())->orderBy('id')->pluck('id')->toArray();


        foreach ($asramas as $key => $value) {
            AsramaTeacher::create([
                'user_id' => $userIds[$key],
                'asrama_id' => $value->id,
                'academic_year' => $academicYear, // Contoh tahun ajaran
                'semester' => $semester, // Contoh semester
            ]);
        }
    }
}
