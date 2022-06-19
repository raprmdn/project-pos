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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.suppliers.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.suppliers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit(Supplier $supplier)
    {
        return view('dashboard.suppliers.edit', compact(['supplier']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supplier $supplier)
    {
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
            $urlEdit = route('suppliers.edit', $supplier->slug);
            $urlDelete = route('suppliers.destroy', $supplier->slug);
            return '
                    <div class="row">
                        <a href="' . $urlEdit . '" class="btn btn-primary mr-2" title="Edit supplier">
                            <i class="fas fa-edit"></i>
                        </a>
                        <button class="btn btn-danger delete-item"
                                data-url="' . $urlDelete . '"
                                data-name="' . $supplier->name . '">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                    ';
        })
            ->rawColumns(['action'])
            ->make();
    }
}
