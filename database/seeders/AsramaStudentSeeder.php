<?php

namespace Database\Seeders;

use App\Models\Asrama;
use App\Models\AsramaStudent;
use App\Models\Student;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AsramaStudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil semua siswa dan shuffle
        $students = Student::all()->shuffle();

        // Ambil semua kelas
        $asramas = Asrama::all();

        $academicYear = "20232024";
        $semester = 1;

        // Hitung jumlah siswa per kelas
        $studentsPerAsrama = ceil($students->count() / $asramas->count());

        $asramaIndex = 0;
        foreach ($students as $student) {
            // Tentukan kelas untuk siswa
            $asrama = $asramas[$asramaIndex];

            // Tambahkan siswa ke kelas
            AsramaStudent::create([
                'asrama_id' => $asrama->id,
                'student_id' => $student->id,
                'academic_year' => $academicYear, // Contoh tahun ajaran
                'semester' => $semester, // Contoh semester
                'status' => 'active', // Contoh status
            ]);

            // Pindah ke kelas berikutnya jika jumlah siswa per kelas telah terpenuhi
            if (AsramaStudent::where('asrama_id', $asrama->id)
                ->where('academic_year', $academicYear)
                ->where('semester', $semester)
                ->count() >= $studentsPerAsrama
            ) {
                $asramaIndex++;
            }

            // Pastikan index kelas tidak melebihi jumlah kelas
            if ($asramaIndex >= $asramas->count()) {
                $asramaIndex = 0;
            }
        }
    }
}
