<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryTableSeeder extends Seeder
{
    public function run()
    {
        collect([
            [
                'name' => 'Makanan',
                'slug' => 'makanan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Minuman',
                'slug' => 'minuman',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Elektronik',
                'slug' => 'elektronik',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Snack',
                'slug' => 'snack',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ])->each(function ($category) {
            DB::table('categories')->insert($category);
        });
    }
}
