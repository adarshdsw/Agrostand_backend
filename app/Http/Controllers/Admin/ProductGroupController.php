<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductGroup;
use Illuminate\Http\Request;

class ProductGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pgroups = ProductGroup::all();
        // dd($pgroups);
        return view('admin.pgroups.index', compact('pgroups'));
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
            return view('admin/pgroups/create' )->render();
        }
        return view('admin/pgroups/create' );
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
        ]);
        $pgroup = new ProductGroup;
        $pgroup->title       = $request->input('title');
        $pgroup->title_hindi = $request->input('title_hindi');
        $pgroup->status      = $request->input('status');
        $res = $pgroup->save();
        if ($request->ajax()) {
            return response()->json([
                'success'=>'The Product Group has been successfully added.'
            ]);
        }
        return redirect(route('admin.pgroups'))->with('Product Group-ok', __('The Product Group has been successfully added'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductGroup  $pgroup
     * @return \Illuminate\Http\Response
     */
    public function show(ProductGroup $pgroup)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductGroup  $pgroup
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, ProductGroup $pgroup)
    {
        if($pgroup){
            if ($request->ajax()) {
                return view('admin/pgroups/edit', compact('pgroup'))->render();
            }
            return view('admin/pgroups/edit', compact('pgroup'));
        }else{
            return redirect(route('admin.pgroups.index'))->with('fail', __('Product Group not found'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductGroup  $pgroup
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductGroup $pgroup)
    {
        // Validation
        $rules  = [
            'title'         => 'required|max:255',
            'title_hindi'   => 'required|max:255',
        ];

        $request->validate($rules);

        if($pgroup){
            $pgroup->title        = $request->input('title');
            $pgroup->title_hindi  = $request->input('title_hindi');
            $pgroup->status       = $request->input('status');
            // dd($pgroup);
            $res = $pgroup->save();
            if($res){
                if ($request->ajax()) {
                    return response()->json([
                        'success'=>'The Product Group has been successfully updated.'
                    ]);
                }
                return redirect(route('admin.pgroups.index'))->with('success', 'The ProductGroup has been successfully updated');
            }else{
                if ($request->ajax()) {
                    return response()->json([
                        'fail'=>'something Went wrong please try again.'
                    ]);
                }
                return redirect(route('admin.pgroups.index'))->with('fail', 'something Went wrong please try again.');
            }
        }else{
            if ($request->ajax()) {
                return response()->json([
                    'fail'=>'ProductGroup Not Found.'
                ]);
            }
            return redirect(route('admin.pgroups.index'))->with('fail', __('ProductGroup not found'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductGroup  $pgroup
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductGroup $pgroup)
    {
        if($pgroup){
            $pgroup->delete ();
            return ['status' => true, 'code' => 200, 'data'=>$pgroup];
        }else{
            return ['status' => false, 'code' => 404, 'message'=>'data not found'];
        }
    }
}
