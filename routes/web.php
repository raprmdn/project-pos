<?php

use App\Http\Controllers\{
    Category\CategoryController,
    Dashboard\DashboardController,
    Dashboard\ProductController,
    Dashboard\RolePermission\PermissionController,
    Dashboard\RolePermission\RoleController,
    Dashboard\TrashController,
    Dashboard\UserController,
    IndexController,
};
use App\Http\Controllers\Supplier\SupplierController;
use App\Http\Controllers\Unit\UnitController;
use Illuminate\Support\Facades\Route;

Route::get('/', IndexController::class)->name('index');
Route::get('/symlink', function () {
    Artisan::call('storage:link');
    echo "ok";
});

Route::middleware('auth')->group(function () {
    Route::get('user-table', [UserController::class, 'userTable'])->name('users.table');
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::prefix('dashboard')->group(function () {
        Route::resource("categories", CategoryController::class, ['names' => 'category'])->parameters([
            'category' => 'slug'
        ]);
        Route::get('categories-table', [CategoryController::class, 'categoriesTable'])->name('categories.table');

        Route::resource("units", UnitController::class, ['names' => 'unit'])->parameters([
            'unit' => 'slug'
        ]);
        Route::get('units-table', [UnitController::class, 'unitsTable'])->name('units.table');

        Route::resource("suppliers", SupplierController::class)->parameters([
            'supplier' => 'slug'
        ]);
        Route::get("suppliers-table", [SupplierController::class, 'suppliersTable'])->name('suppliers.table');

        Route::resource('products', ProductController::class)->parameters([
            'product' => 'slug'
        ]);
        Route::get('products-table', [ProductController::class, 'productsTable'])->name('products.table');

        Route::prefix('role-permission')->group(function () {
            Route::group(['middleware' => 'permission:view-permissions'], function () {
                Route::resource('permissions', PermissionController::class)
                    ->except(['create']);
                Route::get('permissions-table', [PermissionController::class, 'table'])->name('permissions.table');
            });

            Route::group(['middleware' => 'permission:view-role'], function () {
                Route::resource('roles', RoleController::class)
                    ->except(['create']);
                Route::prefix('roles')->group(function () {
                    Route::get('users-table/{role}', [RoleController::class, 'usersTable'])->name('roles.users.table');
                    Route::post('assign-role/{role}', [RoleController::class, 'assignRole'])->name('assign-role');
                    Route::delete('revoke-role/{role}', [RoleController::class, 'revokeRole'])->name('roles.user.revoke');
                });
            });
        });

        Route::prefix('trash')->group(function () {
            Route::get('products', [TrashController::class, 'productsTrashed'])->name('trash.products')
                ->middleware(['permission:view-products-trash']);
            Route::get('products-trashed-table', [TrashController::class, 'productsTrashedTable'])->name('trash.products.table');
            Route::put('products/{slug}', [TrashController::class, 'productsRestore'])->name('trash.products.restore')
                ->middleware(['permission:restore-product']);
            Route::get('units', [TrashController::class, 'unitsTrashed'])->name('trash.units')
                ->middleware(['permission:view-units-trash']);
            Route::get('units-trashed-table', [TrashController::class, 'unitsTrashedTable'])->name('trash.units.table');
            Route::put('units/{slug}', [TrashController::class, 'unitsRestore'])->name('trash.units.restore')
                ->middleware(['permission:restore-unit']);
            Route::get('categories', [TrashController::class, 'categoriesTrashed'])->name('trash.categories')
                ->middleware(['permission:view-categories-trash']);
            Route::get('categories-trashed-table', [TrashController::class, 'categoriesTrashedTable'])->name('trash.categories.table');
            Route::put('categories/{slug}', [TrashController::class, 'categoriesRestore'])->name('trash.categories.restore')
                ->middleware(['permission:restore-category']);
            Route::get('suppliers', [TrashController::class, 'suppliersTrashed'])->name('trash.suppliers')
                ->middleware(['permission:view-suppliers-trash']);
            Route::get('suppliers-trashed-table', [TrashController::class, 'suppliersTrashedTable'])->name('trash.suppliers.table');
            Route::put('suppliers/{slug}', [TrashController::class, 'suppliersRestore'])->name('trash.suppliers.restore')
                ->middleware(['permission:restore-supplier']);
        });

        Route::get('users', [UserController::class, 'index'])->name('users.index')
            ->middleware(['permission:view-users']);
        Route::get('users-table', [UserController::class, 'userTableWithRoles'])->name('users.index.table');
    });
});
