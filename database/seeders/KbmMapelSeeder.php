<?php

namespace Database\Seeders;

use App\Models\KbmMapel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KbmMapelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $mapels = [
            "Pendidikan Agama",
            "Pendidikan Pancasila dan Kewarganegaraan",
            "Bahasa Indonesia",
            "Bahasa Inggris",
            "Matematika",
            "Ilmu Pengetahuan Alam",
            "Ilmu Pengetahuan Sosial",
            "Seni Budaya",
            "Pendidikan Jasmani, Olahraga dan Kesehatan",
            "Teknologi Informasi dan Komunikasi"
        ];

        foreach ($mapels as $value) {
            KbmMapel::firstOrCreate([
                'name' => $value
            ]);
        }
    }
}
