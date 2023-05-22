<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            DefaultSettingTableSeeder::class,
            MailSettingTableSeeder::class,
            SmsSettingTableSeeder::class,
            UserTableSeeder::class,
            AboutUsSeeder::class,
            PrivacyPolicySeeder::class,
            TermsOfServiceSeeder::class,
        ]);
    }
}
