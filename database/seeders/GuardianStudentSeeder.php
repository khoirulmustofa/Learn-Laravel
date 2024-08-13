<?php

namespace Database\Seeders;

use App\Models\Guardian;
use App\Models\Student;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GuardianStudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Fetch all guardians and students
        $guardians = Guardian::all();
        $students = Student::all();

        // Attach students to guardians
        foreach ($guardians as $guardian) {
            // Randomly attach students to each guardian
            $guardian->students()->attach(
                $students->random(rand(1, 3))->pluck('id')->toArray()
            );
        }

        // Attach guardians to students
        foreach ($students as $student) {
            // Randomly attach guardians to each student
            $student->guardians()->attach(
                $guardians->random(rand(1, 3))->pluck('id')->toArray()
            );
        }
    }
}
