<?php

namespace App\Http\Controllers\Supplier;

use App\Models\Supplier;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class SupplierController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view-supplier', ['only' => ['index', 'suppliersTable']]);
        $this->middleware('permission:create-supplier', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit-supplier', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete-supplier', ['only' => ['destroy']]);
    }

    public function index()
    {
        return view('dashboard.suppliers.index');
    }

    public function create()
    {
        return view('dashboard.suppliers.create');
    }

    public function store(Request $request)
    {
        $request['slug'] = Str::slug($request['name']);
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'slug' => 'required|unique:suppliers',
            'address' => 'required',
            'phone' => 'numeric',
            'description' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect()->route('suppliers.create')->withErrors($validator)->withInput();
        }
        try {
            Supplier::create($validator->validated());
            return redirect()->route('suppliers.index');
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function show(Supplier $supplier)
    {
        //
    }

    public function edit(Supplier $supplier)
    {
        return view('dashboard.suppliers.edit', compact(['supplier']));
    }

    public function update(Request $request, Supplier $supplier)
    {
        $request['slug'] = Str::slug($request['name']);
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'slug' => 'required',
            'address' => 'required',
            'phone' => 'numeric',
            'description' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect()->route('suppliers.edit', $supplier->slug)->withErrors($validator)->withInput();
        }
        try {
            $supplier->update($validator->validated());
            return redirect()->route('suppliers.index');
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function destroy(Supplier $supplier)
    {
        if ($supplier->order_product()->exists()) {
            return response()->json([
                'status' => false,
                'message' => 'Supplier has order product, can not delete this supplier'
            ]);
        }
        $supplier->delete();

        return response()->json([
            'status' => true,
            'message' => 'Supplier deleted successfully'
        ]);
    }
    public function suppliersTable()
    {
        $suppliers = Supplier::all();
        return DataTables::of($suppliers)->addIndexColumn()->addColumn('action', function ($supplier) {
            return view('dashboard.actions.supplier', compact('supplier'));
        })
            ->rawColumns(['action'])
            ->make();
    }

    public function getSupplier()
    {
        $supplier = Supplier::all(['id', 'name']);
        return response()->json([
            'status' => 200,
            'data' => $supplier
        ]);
    }
}
