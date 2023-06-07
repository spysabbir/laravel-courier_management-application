<?php

namespace Database\Seeders;

use App\Models\SmsSetting;
use Carbon\Carbon;
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
            'api_key' => 'api_key',
            'sender_id' => 'sender_id',
            'created_by' => 1,
            'created_at' => Carbon::now(),
        ]);
    }
}
