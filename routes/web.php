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
    Route::get('user-by-role/{role}', [UserController::class, 'getUserByRole'])->name('users.by.role');
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

        Route::prefix('role-permission')->group(function () {

            Route::resource('permissions', PermissionController::class)
                ->except(['create']);
            Route::get('permissions-table', [PermissionController::class, 'table'])->name('permissions.table');

            Route::resource('roles', RoleController::class)
                ->except(['create']);
            Route::prefix('roles')->group(function () {
                Route::post('assign-role/{role}', [RoleController::class, 'assignRole'])->name('assign-role');
                Route::delete('revoke-role/{role}', [RoleController::class, 'revokeRole'])->name('roles.user.revoke');
            });
        });

        Route::resource('products', ProductController::class)->parameters([
            'product' => 'slug'
        ]);

        Route::get('products-table', [ProductController::class, 'productsTable'])->name('products.table');

        Route::prefix('trash')->group(function () {
            Route::get('products', [TrashController::class, 'productsTrashed'])->name('trash.products');
            Route::get('products-trashed-table', [TrashController::class, 'productsTrashedTable'])->name('trash.products.table');
            Route::put('products/{slug}', [TrashController::class, 'productsRestore'])->name('trash.products.restore');
            Route::get('units', [TrashController::class, 'unitsTrashed'])->name('trash.units');
            Route::get('units-trashed-table', [TrashController::class, 'unitsTrashedTable'])->name('trash.units.table');
            Route::put('units/{slug}', [TrashController::class, 'unitsRestore'])->name('trash.units.restore');
            Route::get('categories', [TrashController::class, 'categoriesTrashed'])->name('trash.categories');
            Route::get('categories-trashed-table', [TrashController::class, 'categoriesTrashedTable'])->name('trash.categories.table');
            Route::put('categories/{slug}', [TrashController::class, 'categoriesRestore'])->name('trash.categories.restore');
            Route::get('suppliers', [TrashController::class, 'suppliersTrashed'])->name('trash.suppliers');
            Route::get('suppliers-trashed-table', [TrashController::class, 'suppliersTrashedTable'])->name('trash.suppliers.table');
            Route::put('suppliers/{slug}', [TrashController::class, 'suppliersRestore'])->name('trash.suppliers.restore');
        });
    });
});
