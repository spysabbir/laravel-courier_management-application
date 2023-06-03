<?php

namespace Database\Seeders;

use App\Models\AboutUs;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AboutUsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AboutUs::create([
            'headline' => 'On-time Delivery and Customer Satisfaction',
            'description' => 'On-time Delivery and Customer Satisfaction',
            'about_photo' => 'default_about_photo.png',
            'created_by' => 1,
            'created_at' => Carbon::now(),
        ]);
    }
}
