<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\{Category, OrderProduct, Product, Sale, Supplier, User};
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $categoriesCount = Category::count();
        $productsCount = Product::count();
        $usersCount = User::count();
        $suppliersCount = Supplier::count();

        $startDayOfMonth = date('Y-m-01');
        $startDay = $startDayOfMonth;
        $currentDay = date('Y-m-d');

        $date = [];
        $orders = [];
        $sales = [];

        while ($startDayOfMonth <= $currentDay) {
            $date[] = Carbon::parse($startDayOfMonth)->format('d F Y');

            $orders[] = OrderProduct::where("created_at", "LIKE", "%$startDayOfMonth%")->sum('total');
            $sales[] = Sale::where("created_at", "LIKE", "%$startDayOfMonth%")->sum('total');

            $startDayOfMonth = Carbon::parse($startDayOfMonth)->addDays()->format('Y-m-d');
        }

        return view('dashboard.index', compact([
            'categoriesCount', 'productsCount',
            'usersCount', 'suppliersCount',
            'startDay', 'startDayOfMonth', 'currentDay',
            'date', 'orders', 'sales'
        ]));
    }
}
