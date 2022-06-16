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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $unit = Unit::all();
        return view('dashboard.unit.index', ['data' => $unit]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.unit.create');
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

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function show(Unit $unit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function edit(Unit $unit)
    {
        return view('dashboard.unit.edit', ['data' => $unit]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\Response
     */
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
            return $unit->created_at->format('l j, F Y h:i:s A');
        })->editColumn('updated_at', function ($unit) {
            return $unit->updated_at->format('l j, F Y h:i:s A');
        })->addColumn('action', function ($unit) {
            $urlEdit = route('unit.edit', $unit->slug);
            $urlDelete = route('unit.destroy', $unit->slug);
            return '
                    <div class="row">
                        <a href="' . $urlEdit . '" class="btn btn-primary mr-2" title="Edit unit">
                            <i class="fas fa-edit"></i>
                        </a>
                        <button class="btn btn-danger delete-item"
                                data-url="' . $urlDelete . '"
                                data-name="' . $unit->name . '">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                    ';
        })
            ->rawColumns(['action'])
            ->make();;
    }
}
