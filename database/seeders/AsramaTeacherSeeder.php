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
        $userIds = User::pluck('id')->toArray();

        foreach ($asramas as $asrama) {
            AsramaTeacher::create([
                'user_id' => fake()->unique()->randomElement($userIds),
                'asrama_id' => $asrama->id,
                'academic_year' => $academicYear, // Contoh tahun ajaran
                'semester' => $semester, // Contoh semester
            ]);
        }
    }
}
