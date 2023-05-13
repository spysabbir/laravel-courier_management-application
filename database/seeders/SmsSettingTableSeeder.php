<?php

namespace Database\Seeders;

use App\Models\SmsSetting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SmsSettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SmsSetting::create([
            'api_key' => 'VjkIEblFGYFP7yH5NyOk',
            'sender_id' => '8809601004416',
            'created_by' => 1,
        ]);
    }
}
