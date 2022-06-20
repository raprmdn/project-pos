<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Illuminate\Database\Seeder;

class SupplierTableSeeder extends Seeder
{
    public function run()
    {
        $suppliers = collect([
            [
                'name' => 'Supplier 1',
                'slug' => 'supplier-1',
                'address' => 'Jl. Raya 1',
                'phone' => '081234567891',
                'description' => 'Supplier 1 Description',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Supplier 2',
                'slug' => 'supplier-2',
                'address' => 'Jl. Raya 2',
                'phone' => '081234567892',
                'description' => 'Supplier 2 Description',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Supplier 3',
                'slug' => 'supplier-3',
                'address' => 'Jl. Raya 3',
                'phone' => '081234567893',
                'description' => 'Supplier 3 Description',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Supplier 4',
                'slug' => 'supplier-4',
                'address' => 'Jl. Raya 4',
                'phone' => '081234567894',
                'description' => 'Supplier 4 Description',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        $suppliers->each(function ($supplier) {
            Supplier::create($supplier);
        });
    }
}
