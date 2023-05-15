<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('users')->insert([
            // Super Admin
            [
                'name' => 'Super Admin',
                'email' => 'superadmin@email.com',
                'password' => Hash::make('12345678'),
                'role' => 'Super Admin',
                'branch_id' => Null,
                'profile_photo' => 'default_profile_photo.png',
                'last_active' => Carbon::now(),
                'status' => 'Active',
                'created_at' => Carbon::now(),
            ],
            // Admin
            [
                'name' => 'Admin',
                'email' => 'admin@email.com',
                'password' => Hash::make('12345678'),
                'role' => 'Admin',
                'branch_id' => Null,
                'profile_photo' => 'default_profile_photo.png',
                'last_active' => Carbon::now(),
                'status' => 'Active',
                'created_at' => Carbon::now(),
            ],
            // Manager
            [
                'name' => 'Manager 1',
                'email' => 'manager1@email.com',
                'password' => Hash::make('12345678'),
                'role' => 'Manager',
                'branch_id' => 1,
                'profile_photo' => 'default_profile_photo.png',
                'last_active' => Carbon::now(),
                'status' => 'Active',
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'Manager 2',
                'email' => 'manager2@email.com',
                'password' => Hash::make('12345678'),
                'role' => 'Manager',
                'branch_id' => 2,
                'profile_photo' => 'default_profile_photo.png',
                'last_active' => Carbon::now(),
                'status' => 'Active',
                'created_at' => Carbon::now(),
            ],
            // Staff
            [
                'name' => 'Staff 1',
                'email' => 'staff1@email.com',
                'password' => Hash::make('12345678'),
                'role' => 'Staff',
                'branch_id' => 1,
                'profile_photo' => 'default_profile_photo.png',
                'last_active' => Carbon::now(),
                'status' => 'Active',
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'Staff 2',
                'email' => 'staff2@email.com',
                'password' => Hash::make('12345678'),
                'role' => 'Staff',
                'branch_id' => 2,
                'profile_photo' => 'default_profile_photo.png',
                'last_active' => Carbon::now(),
                'status' => 'Active',
                'created_at' => Carbon::now(),
            ],
        ]);
    }
}
