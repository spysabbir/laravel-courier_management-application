<?php

namespace Database\Seeders;

use App\Models\TermsOfService;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TermsOfServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TermsOfService::create([
            'headline' => 'On-time Delivery and Customer Satisfaction',
            'description' => 'On-time Delivery and Customer Satisfaction',
            'created_by' => 1,
            'created_at' => Carbon::now(),
        ]);
    }
}
