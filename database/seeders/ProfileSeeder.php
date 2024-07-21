<?php

namespace Database\Seeders;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $userIds = User::limit(100)->orderBy('id')->pluck('id')->toArray();
        for ($i = 0; $i < 100; $i++) {
            Profile::firstOrCreate([
                'user_id' => $userIds[$i],
                'website_url' => fake()->url(),
                'github_url'  => fake()->url(),
                'twitter_url' => fake()->url(),
            ]);
        }
    }
}
