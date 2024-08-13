<?php

namespace Database\Seeders;

use App\Models\Guardian;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class GuardianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $no = 1;
        for ($i = 0; $i < 450; $i++) {

            $user =  User::firstOrCreate([
                'name' => "Guardian $no " . fake()->name(),
                'email' => fake()->unique()->safeEmail(),
                'email_verified_at' => now(),
                'password' =>  Hash::make('password'),
                'remember_token' => Str::random(10),
            ]);

            Guardian::firstOrCreate([
                'user_id' => $user->id,
                'name' => "Guardian $no " . fake()->name(),
            ]);
            $no++;
        }

        $guardians =   Guardian::all();

        foreach ($guardians as $key => $guardian) {
        }
    }
}
