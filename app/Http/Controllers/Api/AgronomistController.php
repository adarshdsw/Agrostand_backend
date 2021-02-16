<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Agronomist;
use App\Models\AgronomistLeadImage;
use Illuminate\Http\Request;

class AgronomistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $post = $request->all();
        // echo "<pre>"; print_r($post);die;
        $agronomist = new Agronomist();
        $agronomist->user_id        = $post['user_id'];
        $agronomist->category_id    = $post['category_id'];
        $agronomist->subcategory_id = $post['subcategory_id'];
        $agronomist->commodity_id   = $post['commodity_id'];
        $agronomist->plant_variety  = $post['plant_variety'];
        $agronomist->description_problem  = ($post['description_problem']) ? $post['description_problem'] : '';
        $agronomist->date_of_plantation = ($post['date_of_plantation']) ? $post['date_of_plantation'] : '';
        $agronomist->report             = ($post['report']) ? $post['report'] : '';
        $agronomist->specification      = ($post['specification']) ? $post['specification'] : '';
        $report = $request->file('upload_report');
        if($report){
            $filename   = $report->getClientOriginalName();
            $name       = "plant_report";
            $extension  = $report->extension();
            $filenew    =  date('d-M-Y').'_'.str_replace($filename, $name, $filename).'_'.time().''.rand(). "." .$extension;
            $report->move(base_path('/public/uploads/agronomist'), $filenew);
            $agronomist->upload_report = asset('/uploads/agronomist/'.$filenew);
        }
        $media_type      = $post['media_type'];
        // echo "<pre>"; print_r($agronomist);die;
        $res = $agronomist->save();
        // dd($res);

        if($res){
            $files = $request->file('plant_images');
            if($files){
                $img_extra = [];
                foreach($files as $file){
                    $row = [];
                    $filename   = $file->getClientOriginalName();
                    $name       = "plant_img";
                    $extension  = $file->extension();
                    $filenew    =  date('d-M-Y').'_'.str_replace($filename, $name, $filename).'_'.time().''.rand(). "." .$extension;
                    $file->move(base_path('/public/uploads/agronomist'), $filenew);
                    $row['agronimist_lead_id'] = $agronomist->id;
                    $row['img_value']   = $filename;
                    $row['img_path'] = asset('/uploads/agronomit/'.$filenew);
                    $row['media_type'] = $media_type;
                    $img_extra[] = $row;
                }
                AgronomistLeadImage::insert($img_extra);
            }
            
            $data = ['status' => true, 'code' => 200, 'data'=>$agronomist];
        }else{
            $data = ['status' => false, 'code' => 500, 'message' => "Something went wrong"];
        }
        return $data;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Agronomist  $agronomist
     * @return \Illuminate\Http\Response
     */
    public function show(Agronomist $agronomist)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Agronomist  $agronomist
     * @return \Illuminate\Http\Response
     */
    public function edit(Agronomist $agronomist)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Agronomist  $agronomist
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Agronomist $agronomist)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Agronomist  $agronomist
     * @return \Illuminate\Http\Response
     */
    public function destroy(Agronomist $agronomist)
    {
        //
    }
}
