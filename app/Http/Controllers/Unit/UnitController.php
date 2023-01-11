<?php

namespace App\Http\Controllers\Unit;

use App\Models\Unit;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class UnitController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view-unit', ['only' => ['index', 'unitsTable']]);
        $this->middleware('permission:create-unit', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit-unit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete-unit', ['only' => ['destroy']]);
    }

    public function index()
    {
        $unit = Unit::all();
        return view('dashboard.unit.index', ['data' => $unit]);
    }

    public function create()
    {
        return view('dashboard.unit.create');
    }

    public function store(Request $request)
    {
        $request['slug'] = Str::slug($request['name']);
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'slug' => 'unique:units'
        ]);
        if ($validator->fails()) {
            return redirect()->route('unit.create')->withErrors($validator)->withInput();
        }
        $validated = $validator->validated();
        try {
            Unit::create($validated);
            return redirect()->route('unit.index');
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function show(Unit $unit)
    {
        //
    }

    public function edit(Unit $unit)
    {
        return view('dashboard.unit.edit', ['data' => $unit]);
    }

    public function update(Request $request, Unit $unit)
    {
        $request['slug'] = Str::slug($request['name']);
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'slug' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect()->route('unit.edit', ['slug' => $unit->slug])->withErrors($validator)->withInput();
        }
        $validated = $validator->validated();
        try {
            $unit->update($validated);
            return redirect()->route('unit.index');
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function destroy(Unit $unit)
    {
        if ($unit->product()->exists()) {
            return response()->json([
                'status' => false,
                'message' => 'Unit has related to product, can not delete this unit'
            ]);
        }
        $unit->delete();

        return response()->json([
            'status' => true,
            'message' => 'Unit deleted successfully'
        ]);
    }

    public function unitsTable()
    {
        $units = Unit::all();
        return DataTables::of($units)->addIndexColumn()->editColumn('created_at', function ($unit) {
            return $unit->created_at->format('d F Y, H:i');
        })->addColumn('action', function ($unit) {
            return view('dashboard.actions.unit', compact('unit'));
        })->rawColumns(['action'])->make();
    }
}
