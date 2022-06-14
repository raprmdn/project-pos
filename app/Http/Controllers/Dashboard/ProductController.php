<?php

namespace App\Http\Controllers\Dashboard;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\Unit;
use App\Traits\ImageTrait;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class ProductController extends Controller
{
    use ImageTrait;

    public function index()
    {
        return view('dashboard.products.index');
    }

    public function create()
    {
        $product = new Product();
        $categories = Category::latest()->get();
        $units = Unit::latest()->get();

        return view('dashboard.products.create', compact(['product', 'categories', 'units']));
    }

    public function store(ProductRequest $request)
    {
        $picture = $request->file('product_image');
        $request['slug'] = Str::slug($request->product_name) . '-' . Str::random(4);
        $request['image'] = $this->assignPicture('products/image', $picture, $request['slug']);
        $request['barcode'] = rand(100000000, 999999999);
        Product::create($this->_fields($request->all()));

        return redirect()->route('products.index')->with('success', 'Product created successfully');
    }

    public function edit(Product $product)
    {
        $product->load('category', 'unit');
        $categories = Category::latest()->get();
        $units = Unit::latest()->get();

        return view('dashboard.products.edit', compact(['product', 'categories', 'units']));
    }

    public function update(ProductRequest $request, Product $product)
    {
        if ($request->product_name != $product->name) {
            $request['slug'] = Str::slug($request->product_name) . '-' . Str::random(4);
        } else {
            $request['slug'] = $product->slug;
        }

        if ($request->hasFile('product_image')) {
            Storage::delete($product->picture);
            $picture = $request->file('product_image');
            $request['image'] = $this->assignPicture('products/image', $picture, $request['slug']);
        } else {
            $request['image'] = $product->picture;
        }

        $request['barcode'] = $product->barcode;
        $product->update($this->_fields($request->all()));

        return redirect()->route('products.index')->with('success', 'Product updated successfully');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return response()->json([
            'status' => true,
            'message' => 'Product deleted successfully'
        ]);
    }

    public function productsTable()
    {
        $products = Product::with('category:id,name', 'unit:id,name')->latest()->get();

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
                $urlEdit = route('products.edit', $product->slug);
                $urlDelete = route('products.destroy', $product->slug);
                return '
                        <div class="row">
                            <a href="' . $urlEdit . '" class="btn btn-primary btn-xs mr-2" title="Edit product">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button class="btn btn-danger btn-xs delete-item"
                                    data-url="' . $urlDelete . '"
                                    data-name="' . $product->name . '">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                        ';
            })
            ->rawColumns(['action', 'product_picture'])
            ->make();
    }

    private function _fields($attributes)
    {
        return [
            'name' => $attributes['product_name'],
            'barcode' => $attributes['barcode'],
            'slug' => $attributes['slug'],
            'unit_id' => $attributes['unit'],
            'category_id' => $attributes['category'],
            'stock' => $attributes['stock'],
            'price' => $attributes['price'],
            'description' => $attributes['description'],
            'picture' => $attributes['image'],
        ];
    }
}
