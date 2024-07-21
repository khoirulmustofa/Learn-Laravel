<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Affiliation;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Seeder;
use PHPUnit\Framework\MockObject\StubInternal;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UserSeeder::class);
        $this->call(ProfileSeeder::class);
        $this->call(PostSeeder::class);
        $this->call(TagSeeder::class);
        $this->call(PostTagSeeder::class);
        $this->call(ClassModelSeeder::class);
        $this->call(StudentSeeder::class);
        $this->call(StudentClassSeeder::class);
        $this->call(AsramaSeeder::class);
        $this->call(AsramaStudentSeeder::class);
        $this->call(AsramaTeacherSeeder::class);
        $this->call(KbmMapelSeeder::class);
        $this->call(KbmJadwalSeeder::class);
    }
}

