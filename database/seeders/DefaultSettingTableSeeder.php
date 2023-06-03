<?php

namespace Database\Seeders;

use App\Models\DefaultSetting;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DefaultSettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DefaultSetting::create([
            'app_name' => 'Laravel',
            'app_url' => 'http://127.0.0.1:8000',
            'time_zone' => 'UTC',
            'favicon' => 'default_favicon.png',
            'logo_photo' => 'default_logo_photo.png',
            'created_by' => 1,
            'created_at' => Carbon::now(),
        ]);
    }
}
