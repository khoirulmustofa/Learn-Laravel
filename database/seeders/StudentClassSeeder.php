<?php

namespace Database\Seeders;

use App\Models\ClassModel;
use App\Models\ClassStudent;
use App\Models\Student;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudentClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil semua siswa dan shuffle
        $students = Student::all()->shuffle();

        // Ambil semua kelas
        $classes = ClassModel::all();

        $academicYear = "20232024";
        $semester = 1;

        // Hitung jumlah siswa per kelas
        $studentsPerClass = ceil($students->count() / $classes->count());

        $classIndex = 0;
        foreach ($students as $student) {
            // Tentukan kelas untuk siswa
            $class = $classes[$classIndex];

            // Tambahkan siswa ke kelas
            ClassStudent::create([
                'class_id' => $class->id,
                'student_id' => $student->id,
                'academic_year' => $academicYear, // Contoh tahun ajaran
                'semester' => $semester, // Contoh semester
                'status' => 'active', // Contoh status
            ]);

            // Pindah ke kelas berikutnya jika jumlah siswa per kelas telah terpenuhi
            if (ClassStudent::where('class_id', $class->id)
                ->where('academic_year', $academicYear)
                ->where('semester', $semester)
                ->count() >= $studentsPerClass
            ) {
                $classIndex++;
            }

            // Pastikan index kelas tidak melebihi jumlah kelas
            if ($classIndex >= $classes->count()) {
                $classIndex = 0;
            }
        }
    }
}
