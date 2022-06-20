<?php

namespace App\Http\Controllers\Dashboard;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Unit;
use App\Models\Supplier;
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
                return '<img src="' .  asset($product->product_picture) . '" alt="' . $product->name . '" class="img-thumbnail" width="100" height="100">';
            })
            ->addColumn('action', function ($product) {
                $urlRestore = route('trash.products.restore', $product->slug);
                return '
                        <div class="row">
                            <button class="btn btn-primary restore-item"
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

    public function unitsTrashed()
    {
        return view('dashboard.trashed.units.index');
    }

    public function unitsTrashedTable()
    {
        $units = Unit::onlyTrashed()->get();

        return DataTables::of($units)
            ->addIndexColumn()
            ->addColumn('action', function ($unit) {
                $urlRestore = route('trash.units.restore', $unit->slug);
                return '
                        <div class="row">
                            <button class="btn btn-primary restore-item"
                                    title="Restore unit"
                                    data-url="' . $urlRestore . '"
                                    data-name="' . $unit->name . '">
                                <i class="fas fa-undo-alt"></i>
                            </button>
                        </div>
                        ';
            })
            ->make();
    }

    public function unitsRestore($slug)
    {
        $unit = Unit::withTrashed()->where('slug', $slug)->first();
        $unit->restore();

        return response()->json([
            'status' => true,
            'message' => 'Unit restored successfully',
        ]);
    }

    public function categoriesTrashed()
    {
        return view('dashboard.trashed.categories.index');
    }

    public function categoriesTrashedTable()
    {
        $categories = Category::onlyTrashed()->get();

        return DataTables::of($categories)
            ->addIndexColumn()
            ->addColumn('action', function ($unit) {
                $urlRestore = route('trash.categories.restore', $unit->slug);
                return '
                        <div class="row">
                            <button class="btn btn-primary restore-item"
                                    title="Restore category"
                                    data-url="' . $urlRestore . '"
                                    data-name="' . $unit->name . '">
                                <i class="fas fa-undo-alt"></i>
                            </button>
                        </div>
                        ';
            })
            ->make();
    }

    public function categoriesRestore($slug)
    {
        $categories = Category::withTrashed()->where('slug', $slug)->first();
        $categories->restore();

        return response()->json([
            'status' => true,
            'message' => 'Category restored successfully',
        ]);
    }

    public function suppliersTrashed()
    {
        return view('dashboard.trashed.suppliers.index');
    }

    public function suppliersTrashedTable()
    {
        $suppliers = Supplier::onlyTrashed()->get();

        return DataTables::of($suppliers)
            ->addIndexColumn()
            ->addColumn('action', function ($supplier) {
                $urlRestore = route('trash.suppliers.restore', $supplier->slug);
                return '
                        <div class="row">
                            <button class="btn btn-primary restore-item"
                                    title="Restore supplier"
                                    data-url="' . $urlRestore . '"
                                    data-name="' . $supplier->name . '">
                                <i class="fas fa-undo-alt"></i>
                            </button>
                        </div>
                        ';
            })
            ->make();
    }

    public function suppliersRestore($slug)
    {
        $supplier = Supplier::withTrashed()->where('slug', $slug)->first();
        $supplier->restore();

        return response()->json([
            'status' => true,
            'message' => 'Supplier restored successfully',
        ]);
    }
}
