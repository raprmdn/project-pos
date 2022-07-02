<?php

namespace App\Http\Controllers\Dashboard;

use App\Exports\ProductExport;
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
use PDF;
use Maatwebsite\Excel\Facades\Excel;

class ProductController extends Controller
{
    use ImageTrait;

    public function __construct()
    {
        $this->middleware('permission:view-product', ['only' => ['index', 'productsTable']]);
        $this->middleware('permission:create-product', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit-product', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete-product', ['only' => ['destroy']]);
    }

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
        $request->merge(['price' => str_replace('.', '', $request->price)]);
        $request['slug'] = Str::slug($request->product_name) . '-' . Str::random(4);
        if ($request->hasFile('product_image')) {
            $picture = $request->file('product_image');
            $request['image'] = $this->assignPicture('products/image', $picture, $request['slug']);
        } else {
            $request['image'] = null;
        }

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
            if ($product->picture) {
                Storage::delete($product->picture);
            }
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
        if ($product->sale_details()->exists()) {
            return response()->json([
                'status' => false,
                'message' => 'Product has related to sale, can not delete this product'
            ]);
        }
        $product->delete();

        return response()->json([
            'status' => true,
            'message' => 'Product deleted successfully'
        ]);
    }
    public function generatePDF()
    {
        $data = Product::with(['unit', 'category'])->latest()->get();
        $pdf = PDF::loadView('dashboard.products.mypdf', compact('data'));

        return $pdf->download(date('d-m-y-H:i:s') . '_product.pdf');
    }

    public function generateExcel()
    {
        return Excel::download(new ProductExport, date('d-m-y-H:i:s') . '_data_product.xlsx');
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
                return $product->category->name ?? '';
            })
            ->editColumn('unit', function ($product) {
                return $product->unit->name ?? '';
            })
            ->editColumn('product_picture', function ($product) {
                if ($product->picture) {
                    return '<img src="' .  asset($product->product_picture) . '" alt="' . $product->name . '" class="img-thumbnail" width="100" height="100">';
                } else {
                    return "Image not available";
                }
            })
            ->addColumn('action', function ($product) {
                return view('dashboard.actions.product', compact('product'));
            })
            ->rawColumns(['action', 'product_picture'])
            ->make();
    }

    public function selectProducts()
    {
        $products = Product::with('category:id,name')->latest()->get();

        return DataTables::of($products)
            ->addIndexColumn()
            ->editColumn('category', function ($product) {
                return $product->category->name ?? '';
            })
            ->editColumn('price', function ($product) {
                return 'Rp. ' . Helper::rupiahFormat($product->price) . ',-';
            })
            ->addColumn('action', function ($product) {
                return view('dashboard.actions.select-product', compact('product'));
            })
            ->rawColumns(['category', 'price', 'action'])
            ->make();
    }

    public function selectProductsOrder()
    {
        $products = Product::with('category:id,name')->latest()->get();

        return DataTables::of($products)
            ->addIndexColumn()
            ->editColumn('category', function ($product) {
                return $product->category->name ?? '';
            })
            ->editColumn('price', function ($product) {
                return 'Rp. ' . Helper::rupiahFormat($product->price) . ',-';
            })
            ->addColumn('action', function ($product) {
                return view('dashboard.actions.select-product-order', compact('product'));
            })
            ->rawColumns(['category', 'price', 'action'])
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
    public function getProduct()
    {
        return response()->json([
            'status' => 200,
            'data' => Product::with('category:id,name')->get()
        ]);
    }
}
