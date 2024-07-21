<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 400; $i++) {
            Student::create(
                [
                    'name' => fake()->unique()->name(),
                    'email' => fake()->unique()->safeEmail(),
                    'phone_number' => fake()->phoneNumber(),
                    'date_of_birth' => fake()->date(),
                    'address' => fake()->address(),
                    'gender' => fake()->randomElement(['male', 'female']),
                ]
            );
        }
    }
}
