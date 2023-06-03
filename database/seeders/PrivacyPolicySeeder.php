<?php

namespace Database\Seeders;

use App\Models\PrivacyPolicy;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PrivacyPolicySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PrivacyPolicy::create([
            'headline' => 'On-time Delivery and Customer Satisfaction',
            'description' => 'On-time Delivery and Customer Satisfaction',
            'created_by' => 1,
            'created_at' => Carbon::now(),
        ]);
    }
}
