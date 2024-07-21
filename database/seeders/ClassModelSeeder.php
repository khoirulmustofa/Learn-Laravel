<?php

namespace Database\Seeders;

use App\Models\ClassModel;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClassModelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $classes = [
            '7 A', '7 B', '7 C', '7 D',
            '8 A', '8 B', '8 C', '8 D',
            '9 A', '9 B', '9 C', '9 D'
        ];

        foreach ($classes as $value) {
            // Debugbar::info($value);
            ClassModel::firstOrCreate([
                'name' => $value
            ]);
        }
    }
}
