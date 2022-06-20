<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    public function run()
    {
        $users = collect([
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
        ]);

        $users->each(function ($user) {
            User::create($user)->syncRoles('administrator');
        });

        User::create([
            'name' => 'User Staff',
            'email' => 'staff@email.com',
            'password' => bcrypt('123123123'),
            'created_at' => now(),
            'updated_at' => now(),
        ])->syncRoles('staff');

        User::create([
            'name' => 'User Cashier',
            'email' => 'cashier@email.com',
            'password' => bcrypt('123123123'),
            'created_at' => now(),
            'updated_at' => now(),
        ])->syncRoles('cashier');

        User::create([
            'name' => 'User',
            'email' => 'user@email.com',
            'password' => bcrypt('123123123'),
            'created_at' => now(),
            'updated_at' => now(),
        ])->syncRoles('user');
    }
}
