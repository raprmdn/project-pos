<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RoleAndPermissionSeeder extends Seeder
{
    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = collect([
            'view-master-menu',
            'view-transaction-menu',
            'view-reports-menu',
            'view-role-and-permissions-menu',
            'view-trash-menu',
            'view-settings-menu',
            'view-category',
            'view-unit',
            'view-product',
            'view-supplier',
            'view-purchase',
            'view-sales',
            'create-transaction',
            'view-sales-reports',
            'view-role',
            'view-permissions',
            'view-products-trash',
            'view-categories-trash',
            'view-units-trash',
            'view-suppliers-trash',
            'view-users',
            'create-users',
            'create-category',
            'edit-category',
            'delete-category',
            'create-unit',
            'edit-unit',
            'delete-unit',
            'create-supplier',
            'edit-supplier',
            'delete-supplier',
            'create-product',
            'edit-product',
            'delete-product',
            'restore-product',
            'restore-category',
            'restore-unit',
            'restore-supplier',
        ]);

        $permissions->each(function ($permission) {
            Permission::create(['name' => $permission]);
        });

        Role::create(['name' => 'administrator'])->givePermissionTo($permissions);

        Role::create(['name' => 'staff'])->givePermissionTo([
            'view-master-menu',
            'view-transaction-menu',
            'view-reports-menu',
            'view-trash-menu',
            'view-settings-menu',
            'view-category',
            'view-unit',
            'view-product',
            'view-supplier',
            'view-purchase',
            'view-sales',
            'create-transaction',
            'view-sales-reports',
            'view-products-trash',
            'view-categories-trash',
            'view-units-trash',
            'view-suppliers-trash',
            'view-users',
            'create-category',
            'create-unit',
            'create-supplier',
            'create-product',
        ]);

        Role::create(['name' => 'cashier'])->givePermissionTo([
            'view-master-menu',
            'view-transaction-menu',
            'view-product',
            'view-purchase',
            'view-sales',
            'create-transaction',
        ]);

        Role::create(['name' => 'user']);
    }
}
