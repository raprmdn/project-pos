<?php

use App\Http\Controllers\{Category\CategoryController,
    Dashboard\DashboardController,
    Dashboard\ProductController,
    Dashboard\RolePermission\PermissionController,
    Dashboard\RolePermission\RoleController,
    Dashboard\UserController,
    IndexController};
use App\Http\Controllers\Unit\UnitController;
use Illuminate\Support\Facades\Route;

Route::get('/', IndexController::class)->name('index');

Route::middleware('auth')->group(function () {
    Route::get('user-by-role/{role}', [UserController::class, 'getUserByRole'])->name('users.by.role');
    Route::get('user-table', [UserController::class, 'userTable'])->name('users.table');

    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::prefix('dashboard')->group(function () {
        Route::resource("category", CategoryController::class)->parameters([
            'category' => 'slug'
        ]);
        Route::get('categories-table', [CategoryController::class, 'getCategoriesTable']);

        Route::resource("unit", UnitController::class)->parameters([
            'unit' => 'slug'
        ]);
        Route::get('units-table', [UnitController::class, 'getUnitsTable']);

        Route::prefix('role-permission')->group(function() {

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
    });
});
