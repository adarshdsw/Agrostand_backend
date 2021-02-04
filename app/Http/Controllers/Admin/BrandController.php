<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::all();
        // dd($brands);
        return view('admin.brands.index', compact('brands'));
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
            return view('admin/brands/create' )->render();
        }
        return view('admin/brands/create' );
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
            'slug' => 'required|max:255',
            'icon' => 'mimes:jpeg,jpg,png,gif|required'
        ]);
        $brand = new Brand;
        $brand->title       = $request->input('title');
        $brand->title_hindi = $request->input('title_hindi');
        $brand->slug        = $request->input('slug');
        $file               = $request->file('icon');
        if($file){
            $filename   = $file->getClientOriginalName();
            $name       = "brand";
            $extension  = $file->extension();
            $filenew    =  date('d-M-Y').'_'.str_replace($filename,$name,$filename).'_'.time().''.rand(). "." .$extension;
            $file->move(base_path('/public/uploads/brand'), $filenew);
            $brand->icon   = asset('/uploads/brand/'.$filenew);
        }
        $brand->status = $request->input('status');
        $res = $brand->save();
        
        if ($request->ajax()) {
            return response()->json([
                'success'=>'The brand has been successfully added.'
            ]);
        }
        return redirect(route('admin.brand'))->with('brand-ok', __('The brand has been successfully added'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Brand $brand)
    {
        if($brand){
            if ($request->ajax()) {
                return view('admin/brands/edit', compact('brand'))->render();
            }
            return view('admin/brands/edit', compact('brand'));
        }else{
            return redirect(route('admin.brands.index'))->with('fail', __('Brand not found'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Brand $brand)
    {
        // Validation
        $file   = $request->file('icon');
        $rules  = [
            'title'         => 'required|max:255',
            'title_hindi'   => 'required|max:255',
            'slug'          => 'required|max:255',
        ];
        if($file){
            $rules['icon'] = 'mimes:jpeg,jpg,png,gif|required';
        }
        
        $request->validate($rules);

        if($brand){
            $brand->title = $request->input('title');
            $brand->title_hindi = $request->input('title_hindi');
            $brand->slug = $request->input('slug');

            if($file){
                $filename   = $file->getClientOriginalName();
                $name       = "brand";
                $extension  = $file->extension();
                $filenew    =  date('d-M-Y').'_'.str_replace($filename,$name,$filename).'_'.time().''.rand(). "." .$extension;
                $file->move(base_path('/public/uploads/brand'), $filenew);
                $brand->icon   = asset('/uploads/brand/'.$filenew);
            }
            $brand->status = $request->input('status');
            // dd($brand);
            $res = $brand->save();
            if($res){
                if ($request->ajax()) {
                    return response()->json([
                        'success'=>'The brand has been successfully updated.'
                    ]);
                }
                return redirect(route('admin.brands.index'))->with('success', 'The Brand has been successfully updated');
            }else{
                if ($request->ajax()) {
                    return response()->json([
                        'fail'=>'something Went wrong please try again.'
                    ]);
                }
                return redirect(route('admin.brands.index'))->with('fail', 'something Went wrong please try again.');
            }
        }else{
            if ($request->ajax()) {
                return response()->json([
                    'fail'=>'Brand Not Found.'
                ]);
            }
            return redirect(route('admin.brands.index'))->with('fail', __('Brand not found'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        if($brand){
            $brand->delete ();
            return ['status' => true, 'code' => 200, 'data'=>$brand];
        }else{
            return ['status' => false, 'code' => 404, 'message'=>'data not found'];
        }
    }
}
