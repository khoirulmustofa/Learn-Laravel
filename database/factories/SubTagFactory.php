<?php

namespace Database\Factories;

use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SubTag>
 */
class SubTagFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [

            'name' => "Sub Tag " . fake()->word(),
            'tag_id' => fake()->unique()->randomElement(Tag::pluck('id')->toArray()),
        ];
    }
}
