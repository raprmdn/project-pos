<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UnitTableSeeder extends Seeder
{
    public function run()
    {
        collect([
            [
                'name' => 'Kg',
                'slug' => 'kg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Ml',
                'slug' => 'ml',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Pcs',
                'slug' => 'pcs',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Pack',
                'slug' => 'pack',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Lain-lain',
                'slug' => 'lain-lain',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ])->each(function ($unit) {
            DB::table('units')->insert($unit);
        });
    }
}
