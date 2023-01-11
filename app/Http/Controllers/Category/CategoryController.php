<?php

namespace App\Http\Controllers\Category;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view-category', ['only' => ['index', 'categoriesTable']]);
        $this->middleware('permission:create-category', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit-category', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete-category', ['only' => ['destroy']]);
    }

    public function index()
    {
        $category = Category::all();
        return view('dashboard.category.index', ['data' => $category]);
    }

    public function create()
    {
        return view('dashboard.category.create');
    }

    public function store(Request $request)
    {
        $request['slug'] = Str::slug($request['name']);
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'slug' => 'unique:categories'
        ]);
        if ($validator->fails()) {
            return redirect()->route('category.create')->withErrors($validator)->withInput();
        }
        $validated = $validator->validated();
        try {
            Category::create($validated);
            return redirect()->route('category.index');
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function show(Category $category)
    {
        //
    }


    public function edit(Category $category)
    {
        return view('dashboard.category.edit', ['data' => $category]);
    }

    public function update(Request $request, Category $category)
    {
        $request['slug'] = Str::slug($request['name']);
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'slug' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect()->route('category.edit', ['slug' => $category->slug])->withErrors($validator)->withInput();
        }
        $validated = $validator->validated();
        try {
            $category->update($validated);
            return redirect()->route('category.index');
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function destroy(Category $category)
    {
        if ($category->product()->exists()) {
            return response()->json([
                'status' => false,
                'message' => 'Category has related to product, can not delete this category'
            ]);
        }
        $category->delete();

        return response()->json([
            'status' => true,
            'message' => 'Category deleted successfully'
        ]);
    }

    public function categoriesTable()
    {
        $categories = Category::all();
        return DataTables::of($categories)->addIndexColumn()->editColumn('created_at', function ($category) {
            return $category->created_at->format('l j, F Y h:i:s A');
        })->editColumn('updated_at', function ($category) {
            return $category->updated_at->format('l j, F Y h:i:s A');
        })->addColumn('action', function ($category) {
            return view('dashboard.actions.category', compact('category'));
        })
            ->rawColumns(['action'])
            ->make();
    }
}
