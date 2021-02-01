<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];
        $banners = Banner::all();
        if(count($banners)){
            $data = ['status' => true, 'code' => 200, 'data'=>$banners];
        }else{
            $data = ['status' => false, 'code' => 404, 'message' => "data not found"];
        }
        return $data;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $banner = new Banner;
        $banner->title = $request->input('title');
        $banner->description = $request->input('description');
        $banner->title_hindi = $request->input('title_hindi');
        $banner->description_hindi = $request->input('description_hindi');
        $file = $request->file('feature_img');
        if($file){
            $filename   = $file->getClientOriginalName();
            $name       = "banner";
            $extension  = $file->extension();
            $filenew    =  date('d-M-Y').'_'.str_replace($filename,$name,$filename).'_'.time().''.rand(). "." .$extension;
            $file->move(base_path('/public/uploads/banner'), $filenew);
            $banner->feature_img   = asset('/uploads/banner/'.$filenew);
        }
        $banner->status = $request->input('status');
        $res = $banner->save();
        if($res){
            return ['status' => true, 'code' => 200, 'data'=>$banner];
        }else{
            return ['status' => false, 'code' => 500, 'message' => "something went wrong with database."];
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function show(Banner $banner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $banner = Banner::find($id);
        if($banner){
            $data = ['status' => true, 'code' => 200, 'data'=>$banner];
        }else{
            $data = ['status' => false, 'code' => 404, 'message' => "data not found"];
        }
        return $data;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $banner = Banner::find($id);
        if($banner){
            $banner->title = $request->input('title');
            $banner->description = $request->input('description');
            $banner->title_hindi = $request->input('title_hindi');
            $banner->description_hindi = $request->input('description_hindi');
            $file = $request->file('feature_img');
            if($file){
                $filename   = $file->getClientOriginalName();
                $name       = "banner";
                $extension  = $file->extension();
                $filenew    =  date('d-M-Y').'_'.str_replace($filename, $name, $filename).'_'.time().''.rand(). "." .$extension;
                $file->move(base_path('/public/uploads/banner'), $filenew);
                $banner->feature_img   = asset('/uploads/banner/'.$filenew);
            }
            $banner->status = $request->input('status');
            $banner->save();
            return ['status' => true, 'code' => 200, 'data'=>$banner];
        }else{
            return ['status' => false, 'code' => 404, 'message'=>'data not found'];
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $banner = Banner::find($id);
        if($banner){
            $banner->delete ();
            return ['status' => true, 'code' => 200, 'data'=>$banner];
        }else{
            return ['status' => false, 'code' => 404, 'message'=>'data not found'];
        }
    }
}
