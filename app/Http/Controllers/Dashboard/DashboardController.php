<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\{Category, Product, Supplier, User};

class DashboardController extends Controller
{
    public function index()
    {
        $categoriesCount = Category::count();
        $productsCount = Product::count();
        $usersCount = User::count();
        $suppliersCount = Supplier::count();

        return view('dashboard.index', compact('categoriesCount', 'productsCount', 'usersCount', 'suppliersCount'));
    }
}
