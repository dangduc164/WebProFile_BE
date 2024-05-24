<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $defaults = [
            [
                'active' => '0',
                'email' => 'admin@admin-cv.com',
                'full_name' => 'Nguyễn Đăng Đức',
                'password' => bcrypt('DangDuc164'),
                'gender' => 'male',
                'type' => 'admin',
                'address' => 'Ha Noi',
                'work_experience' => '2',
                'position_application' => 'Fulltask develop',
                'phone_number' => '0987654321',
                'day' => '16',
                'month' => '04',
                'year' => '2001',
                'remember_token' => '1234567890',
                'email_verified_at' => '2022-04-16 00:00:00',
                'birthday_inder' => '16042001',
            ]
        ];

        foreach($defaults as $d){
            User::create($d);
        }
    }
}
