<?php

use App\Http\Controllers\{Category\CategoryController,
    Dashboard\DashboardController,
    Dashboard\RolePermission\PermissionController,
    Dashboard\RolePermission\RoleController,
    Dashboard\UserController,
    IndexController};
use Illuminate\Support\Facades\Route;

Route::get('/', IndexController::class)->name('index');

Route::middleware('auth')->group(function () {
    Route::get('user-by-role/{role}', [UserController::class, 'getUserByRole'])->name('users.by.role');

    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::prefix('dashboard')->group(function () {
        Route::resource("category", CategoryController::class)->parameters([
            'category' => 'slug'
        ]);
        Route::get('categories-table', [CategoryController::class, 'getCategoriesTable']);

        Route::prefix('role-permission')->group(function() {

            Route::prefix('permissions')->group(function () {
                Route::get('', [PermissionController::class, 'index'])->name('permissions.index');
                Route::post('', [PermissionController::class, 'store'])->name('permissions.store');
                Route::get('permissions-table', [PermissionController::class, 'table'])->name('permissions.table');
                Route::get('{permission}/edit', [PermissionController::class, 'edit'])->name('permissions.edit');
                Route::put('{permission}', [PermissionController::class, 'update'])->name('permissions.update');
                Route::delete('{permission}', [PermissionController::class, 'destroy'])->name('permissions.destroy');
            });

            Route::prefix('role')->group(function () {
                Route::get('', [RoleController::class, 'index'])->name('roles.index');
                Route::post('', [RoleController::class, 'store'])->name('roles.store');
                Route::get('{role}', [RoleController::class, 'show'])->name('roles.show');
                Route::get('{role}/edit', [RoleController::class, 'edit'])->name('roles.edit');
                Route::put('{role}', [RoleController::class, 'update'])->name('roles.update');
                Route::delete('{role}', [RoleController::class, 'destroy'])->name('roles.destroy');
                Route::post('assign-role/{role}', [RoleController::class, 'assignRole'])->name('assign-role');
                Route::delete('revoke-role/{role}', [RoleController::class, 'revokeRole'])->name('roles.user.revoke');
            });
        });
    });
});
