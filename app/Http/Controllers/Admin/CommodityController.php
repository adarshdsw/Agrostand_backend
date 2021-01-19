<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Commodity;

class CommodityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];
        $commodities = Commodity::with('subcategory')->get();
        if(count($commodities)){
            $data = ['status' => true, 'code' => 200, 'data'=>$commodities];
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
        $commodity = new Commodity;
        $commodity->subcategory_id = $request->input('subcategory_id');
        $commodity->title = $request->input('title');
        $commodity->slug = $request->input('slug');
        $file = $request->file('icon');
        if($file){
            $filename   = $file->getClientOriginalName();
            $name       = "commodity";
            $extension  = $file->extension();
            $filenew    =  date('d-M-Y').'_'.str_replace($filename,$name,$filename).'_'.time().''.rand(). "." .$extension;
            $file->move(base_path('/public/uploads/icon'), $filenew);
            $commodity->icon   = asset('/uploads/icon/'.$filenew);
        }
        $commodity->status = $request->input('status');
        $res = $commodity->save();
        if($res){
            return ['status' => true, 'code' => 200, 'data'=>$commodity];
        }else{
            return ['status' => false, 'code' => 500, 'message' => "something went wrong with database."];
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $commodity = Commodity::find($id);
        if($commodity){
            $data = ['status' => true, 'code' => 200, 'data'=>$commodity];
        }else{
            $data = ['status' => false, 'code' => 404, 'message' => "data not found"];
        }
        return $data;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $commodity = Commodity::find($id);
        if($commodity){
            $commodity->subcategory_id = $request->input('subcategory_id');
            $commodity->title = $request->input('title');
            $commodity->slug = $request->input('slug');
            $file = $request->file('icon');
            if($file){
                $filename   = $file->getClientOriginalName();
                $name       = "commodity";
                $extension  = $file->extension();
                $filenew    =  date('d-M-Y').'_'.str_replace($filename,$name,$filename).'_'.time().''.rand(). "." .$extension;
                $file->move(base_path('/public/uploads/icon'), $filenew);
                $commodity->icon   = asset('/uploads/icon/'.$filenew);
            }
            $commodity->status = $request->input('status');
            $commodity->save();
            return ['status' => true, 'code' => 200, 'data'=>$commodity];
        }else{
            return ['status' => false, 'code' => 404, 'message'=>'data not found'];
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $commodity = Commodity::find($id);
        if($commodity){
            $commodity->delete ();
            return ['status' => true, 'code' => 200, 'data'=>$commodity];
        }else{
            return ['status' => false, 'code' => 404, 'message'=>'data not found'];
        }
    }
}
