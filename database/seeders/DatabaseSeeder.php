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
                'password' => bcrypt('DangDuc164'),
                'type' => 'admin',
                'remember_token' => '1234567890',
                'email_verified_at' => '2022-04-16 00:00:00',
            ]
        ];

        foreach($defaults as $d){
            User::create($d);
        }
    }
}
