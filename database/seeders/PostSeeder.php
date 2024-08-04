<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 500; $i++) {
            Post::firstOrCreate([
                'user_id' => fake()->randomElement(User::pluck('id')->toArray()),
                'title' => "Title " . fake()->sentence(),
                'body' => "Body " . fake()->paragraph(2)
            ]);
        }
    }
}
