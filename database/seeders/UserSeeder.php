<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $no = 1;
        for ($i = 0; $i < 100; $i++) {
            User::firstOrCreate([
                'name' => "User $no " . fake()->name(),
                'email' => fake()->unique()->safeEmail(),
                'email_verified_at' => now(),
                'password' =>  Hash::make('password'),
                'remember_token' => Str::random(10),
            ]);

            $no++;
        }
    }
}
