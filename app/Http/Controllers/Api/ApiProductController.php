<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductCollection;
use App\Models\Product;

class ApiProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category:id,name', 'unit:id,name')->latest()->paginate(15);

        return response()->json([
            'success' => true,
            'message' => 'Products retrieved successfully',
            'data' => new ProductCollection($products),
        ]);
    }
}
