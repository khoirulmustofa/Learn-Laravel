<?php

namespace Database\Seeders;

use App\Models\KbmJadwal;
use App\Models\KbmMapel;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KbmJadwalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userIds = User::limit(10)->orderBy('id')->pluck('id')->toArray();
        $kbmMapelIds = KbmMapel::limit(10)->orderBy('id')->pluck('id')->toArray();

        for ($i = 0; $i < 10; $i++) {
            KbmJadwal::firstOrCreate([
                'date' => Carbon::now()->toDateString(),
                'session' => 1,
                'kbm_mapel_id' => $kbmMapelIds[$i],
                'user_id' => $userIds[$i]
            ]);
        }
    }
}
