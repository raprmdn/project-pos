<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder
{
    public function run()
    {
        collect([
            [
                'name' => 'Qoidurrahman Haqiqi',
                'email' => 'kiki@email.com',
                'password' => bcrypt('123123123'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Muhammad Nabil Islam',
                'email' => 'nabil@email.com',
                'password' => bcrypt('123123123'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Rafi Putra Ramadhan',
                'email' => 'rafi@email.com',
                'password' => bcrypt('123123123'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Muhammad Yusuf Hijrah',
                'email' => 'yusuf@email.com',
                'password' => bcrypt('123123123'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ])->each(function ($user) {
            DB::table('users')->insert($user);
        });
    }
}
