<?php

namespace Database\Seeders;

use App\Models\Asrama;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AsramaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $asramas = [
            'Asrama 1',
            'Asrama 2',
            'Asrama 3',
            'Asrama 4',
            'Asrama 5',
            'Asrama 6',
            'Asrama 7',
            'Asrama 8',
            'Asrama 9',
            'Asrama 10',
            'Asrama 11',
            'Asrama 12',
            'Asrama 13',
            'Asrama 14',
            'Asrama 15',
            'Asrama 16',
            'Asrama 17',
            'Asrama 18'
        ];

        foreach ($asramas as $value) {
            // Debugbar::info($value);
            Asrama::firstOrCreate([
                'name' => $value
            ]);
        }
    }
}
