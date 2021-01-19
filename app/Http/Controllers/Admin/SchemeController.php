<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Scheme;
use App\Models\SchemeImage;
use Illuminate\Http\Request;

class SchemeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];
        $schmes = Scheme::all();
        if(count($schmes)){
            $data = ['status' => true, 'code' => 200, 'data'=>$schmes];
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
        $scheme = new Scheme;
        $scheme->title        = $request->input('title');
        $scheme->description  = $request->input('description');
        $scheme->scheme_date  = $request->input('scheme_date');
        $file = $request->file('feature_img');
        if($file){
            $filename   = $file->getClientOriginalName();
            $name       = "scheme";
            $extension  = $file->extension();
            $filenew    =  date('d-M-Y').'_'.str_replace($filename,$name,$filename).'_'.time().''.rand(). "." .$extension;
            $file->move(base_path('/public/uploads/scheme'), $filenew);
            $scheme->feature_img   = asset('/uploads/scheme/'.$filenew);
        }
        $scheme->status = $request->input('status');
        $scheme_id = $scheme->save();

        if($scheme_id){
            $files = $request->file('scheme_images');
            if($files){
                $img_extra = [];
                foreach($files as $file){
                    $row = [];
                    $filename   = $file->getClientOriginalName();
                    $name       = "scheme_ext";
                    $extension  = $file->extension();
                    $filenew    =  date('d-M-Y').'_'.str_replace($filename, $name, $filename).'_'.time().''.rand(). "." .$extension;
                    $file->move(base_path('/public/uploads/scheme'), $filenew);
                    $row['scheme_id'] = $scheme->id;
                    $row['title']   = $filename;
                    $row['scheme_img'] = asset('/uploads/scheme/'.$filenew);
                    $img_extra[] = $row;
                }
                SchemeImage::insert($img_extra);
            }
            return ['status' => true, 'code' => 200, 'data'=>$scheme];
        }else{
            return ['status' => false, 'code' => 500, 'message' => "something went wrong with database."];
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Scheme  $scheme
     * @return \Illuminate\Http\Response
     */
    public function show(Scheme $scheme)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Scheme  $scheme
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $scheme = Scheme::find($id);
        if($scheme){
            $data = ['status' => true, 'code' => 200, 'data'=>$scheme];
        }else{
            $data = ['status' => false, 'code' => 404, 'message' => "data not found"];
        }
        return $data;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Scheme  $scheme
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $scheme = Scheme::find($id);
        if($scheme){
            $scheme->title = $request->input('title');
            $scheme->description  = $request->input('description');
            $scheme->scheme_date    = $request->input('scheme_date');
            $file = $request->file('feature_img');
            if($file){
                $filename   = $file->getClientOriginalName();
                $name       = "scheme";
                $extension  = $file->extension();
                $filenew    =  date('d-M-Y').'_'.str_replace($filename, $name, $filename).'_'.time().''.rand(). "." .$extension;
                $file->move(base_path('/public/uploads/scheme'), $filenew);
                $scheme->feature_img   = asset('/uploads/scheme/'.$filenew);
            }
            $scheme->status = $request->input('status');
            $res = $scheme->save();
            if($res){
                $files = $request->file('scheme_images');
                if($files){
                    $img_extra = [];
                    foreach($files as $file){
                        $row = [];
                        $filename   = $file->getClientOriginalName();
                        $name       = "scheme_ext";
                        $extension  = $file->extension();
                        $filenew    =  date('d-M-Y').'_'.str_replace($filename, $name, $filename).'_'.time().''.rand(). "." .$extension;
                        $file->move(base_path('/public/uploads/scheme'), $filenew);
                        $row['scheme_id'] = $scheme->id;
                        $row['title']   = $filename;
                        $row['scheme_img'] = asset('/uploads/scheme/'.$filenew);
                        $img_extra[] = $row;
                    }
                    SchemeImage::insert($img_extra);
                }
                return ['status' => true, 'code' => 200, 'data'=>$scheme];
            }else{
                return ['status' => false, 'code' => 500, 'message'=>'something went wrong with database.'];
            }
        }else{
            return ['status' => false, 'code' => 404, 'message'=>'data not found'];
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Scheme  $scheme
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $scheme = Scheme::find($id);
        if($scheme){
            $scheme->delete ();
            return ['status' => true, 'code' => 200, 'data'=>$scheme];
        }else{
            return ['status' => false, 'code' => 404, 'message'=>'data not found'];
        }
    }
}
