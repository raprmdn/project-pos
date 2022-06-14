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
    public function edit(Unit $slug)
    {
        return view('dashboard.unit.edit', ['data' => $slug]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Unit $slug)
    {
        $request['slug'] = Str::slug($request['name']);
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'slug' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect()->route('unit.edit', ['slug' => $slug->slug])->withErrors($validator)->withInput();
        }
        $validated = $validator->validated();
        try {
            $slug->update($validated);
            return redirect()->route('unit.index');
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Unit $slug)
    {
        $slug->delete();
        return redirect()->route('unit.index');
    }
    public function getUnitsTable()
    {
        $unit = Unit::all();
        DataTables::of($unit)->make();
    }
}
