<?php

namespace App\Http\Controllers\Dashboard;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Yajra\DataTables\DataTables;

class TrashController extends Controller
{
    public function productsTrashed()
    {
        return view('dashboard.trashed.products.index');
    }

    public function productsTrashedTable()
    {
        $products = Product::with('category:id,name', 'unit:id,name')->onlyTrashed()->get();

        return DataTables::of($products)
            ->addIndexColumn()
            ->editColumn('price', function ($product) {
                return 'Rp. ' . Helper::rupiahFormat($product->price) . ',-';
            })
            ->editColumn('category', function ($product) {
                return $product->category->name;
            })
            ->editColumn('unit', function ($product) {
                return $product->unit->name;
            })
            ->editColumn('product_picture', function ($product) {
                return '<img src="' .  asset($product->product_picture) . '" alt="'.$product->name.'" class="img-thumbnail" width="100" height="100">';
            })
            ->addColumn('action', function ($product) {
                $urlRestore = route('trash.products.restore', $product->slug);
                return '
                        <div class="row">
                            <button class="btn btn-primary btn-xs restore-item"
                                    title="Restore product"
                                    data-url="' . $urlRestore . '"
                                    data-name="' . $product->name . '">
                                <i class="fas fa-undo-alt"></i>
                            </button>
                        </div>
                        ';
            })
            ->rawColumns(['action', 'product_picture'])
            ->make();
    }

    public function productsRestore($slug)
    {
        $product = Product::withTrashed()->where('slug', $slug)->first();
        $product->restore();

        return response()->json([
            'status' => true,
            'message' => 'Product restored successfully',
        ]);
    }
}
