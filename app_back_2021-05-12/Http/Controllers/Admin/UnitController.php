<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $units = Unit::all();
        // dd($units);
        return view('admin.units.index', compact('units'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // if request is send by ajax
        if ($request->ajax()) {
            return view('admin/units/create' )->render();
        }
        return view('admin/units/create' );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'title_hindi' => 'required|max:255',
            'value' => 'required|max:255',
        ]);
        $unit = new Unit;
        $unit->title       = $request->input('title');
        $unit->title_hindi = $request->input('title_hindi');
        $unit->value       = $request->input('value');
        $unit->status      = $request->input('status');
        $res = $unit->save();
        if ($request->ajax()) {
            return response()->json([
                'success'=>'The Unit has been successfully added.'
            ]);
        }
        return redirect(route('admin.units'))->with('Unit-ok', __('The Unit has been successfully added'));
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
    public function edit(Request $request, Unit $unit)
    {
        if($unit){
            if ($request->ajax()) {
                return view('admin/units/edit', compact('unit'))->render();
            }
            return view('admin/units/edit', compact('unit'));
        }else{
            return redirect(route('admin.units.index'))->with('fail', __('Unit not found'));
        }
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
        // Validation
        $rules  = [
            'title'         => 'required|max:255',
            'title_hindi'   => 'required|max:255',
            'value'          => 'required|max:255',
        ];

        $request->validate($rules);

        if($unit){
            $unit->title        = $request->input('title');
            $unit->title_hindi  = $request->input('title_hindi');
            $unit->value        = $request->input('value');
            $unit->status       = $request->input('status');
            // dd($unit);
            $res = $unit->save();
            if($res){
                if ($request->ajax()) {
                    return response()->json([
                        'success'=>'The unit has been successfully updated.'
                    ]);
                }
                return redirect(route('admin.units.index'))->with('success', 'The Unit has been successfully updated');
            }else{
                if ($request->ajax()) {
                    return response()->json([
                        'fail'=>'something Went wrong please try again.'
                    ]);
                }
                return redirect(route('admin.units.index'))->with('fail', 'something Went wrong please try again.');
            }
        }else{
            if ($request->ajax()) {
                return response()->json([
                    'fail'=>'Unit Not Found.'
                ]);
            }
            return redirect(route('admin.units.index'))->with('fail', __('Unit not found'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Unit $unit)
    {
        if($unit){
            $unit->delete ();
            return ['status' => true, 'code' => 200, 'data'=>$unit];
        }else{
            return ['status' => false, 'code' => 404, 'message'=>'data not found'];
        }
    }
}
