<?php

use App\Http\Controllers\{IndexController, Dashboard\DashboardController};
use Illuminate\Support\Facades\Route;

Route::get('/', IndexController::class)->name('index');
Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
