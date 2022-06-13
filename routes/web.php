<?php

use App\Http\Controllers\{IndexController, Dashboard\DashboardController, Category\CategoryController};
use Illuminate\Support\Facades\Route;

Route::get('/', IndexController::class)->name('index');

Route::middleware('auth')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource("category", CategoryController::class);
    Route::get('categories-table', CategoryController::class, 'getCategoriesTable');
});
