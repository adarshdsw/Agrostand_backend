<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Agromeet;
use Illuminate\Http\Request;

class AgromeetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $agromeets = Agromeet::all();
        return view('admin.agromeets.index', compact('agromeets'));
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
            return view('admin/agromeets/create' )->render();
        }
        return view('admin/agromeets/create' );
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
            'meeting_title'             => 'required',
            'meeting_title_hindi'       => 'required',
            'meeting_type'              => 'required',
            'meeting_description'       => 'required',
            'meeting_description_hindi' => 'required',
            'meeting_link'              => 'required',
            'meeting_date_time'         => 'required',
        ]);
        
        $agromeet = new Agromeet;
        
        $agromeet->meeting_title        = $request->input('meeting_title');
        $agromeet->meeting_title_hindi  = $request->input('meeting_title_hindi');
        $agromeet->meeting_type         = $request->input('meeting_type');
        $agromeet->meeting_description  = $request->input('meeting_description');
        $agromeet->meeting_description_hindi = $request->input('meeting_description_hindi');
        $agromeet->meeting_link              = $request->input('meeting_link');
        $agromeet->status                    = $request->input('status');
        $agromeet->meeting_date_time         = date("Y-m-d H:i:s", strtotime($request->input('meeting_date_time')));
        $file = $request->file('meeting_image');
        if($file){
            $filename   = $file->getClientOriginalName();
            $name       = "agromeet_banner";
            $extension  = $file->extension();
            $filenew    =  date('d-M-Y').'_'.str_replace($filename,$name,$filename).'_'.time().''.rand(). "." .$extension;
            $file->move(base_path('/public/uploads/banner'), $filenew);
            $agromeet->meeting_image   = asset('/uploads/banner/'.$filenew);
        }
        $res = $agromeet->save();

        if ($request->ajax()) {
            return response()->json([
                'success'=>'The Agromeet has been successfully added.'
            ]);
        }
        return redirect(route('admin.agromeets.index'))->with('ok', __('The Agromeet has been successfully added'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Village  $village
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Agromeet $agromeet)
    {
        if($agromeet){
            if ($request->ajax()) {
                return view('admin/$agromeets/edit', compact('agromeet'))->render();
            }
            return view('admin/agromeets/edit', compact('agromeet'));
        }else{
            return redirect(route('admin.agromeets.index'))->with('fail', __('Agromeet not found'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Suggestion  $village
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Agromeet $agromeet)
    {
        // Validation
        $request->validate([
            'meeting_title'             => 'required',
            'meeting_title_hindi'       => 'required',
            'meeting_description'       => 'required',
            'meeting_description_hindi' => 'required',
        ]);
        
        $agromeet->meeting_title        = $request->input('meeting_title');
        $agromeet->meeting_title_hindi  = $request->input('meeting_title_hindi');
        $agromeet->meeting_description  = $request->input('meeting_description');
        $agromeet->meeting_description_hindi = $request->input('meeting_description_hindi');
        $agromeet->status                    = $request->input('status');
        // $agromeet->meeting_date_time         = date("Y-m-d H:i:s", strtotime($request->input('meeting_date_time')));
        $file = $request->file('meeting_image');
        if($file){
            $filename   = $file->getClientOriginalName();
            $name       = "agromeet_banner";
            $extension  = $file->extension();
            $filenew    =  date('d-M-Y').'_'.str_replace($filename,$name,$filename).'_'.time().''.rand(). "." .$extension;
            $file->move(base_path('/public/uploads/banner'), $filenew);
            $agromeet->meeting_image   = asset('/uploads/banner/'.$filenew);
        }
        
        $res = $agromeet->save();

        if ($request->ajax()) {
            return response()->json([
                'success'=>'The Agromeet has been successfully updated.'
            ]);
        }
        return redirect(route('admin.agromeets.index'))->with('ok', __('The Agromeet has been successfully updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Suggestion  $suggestion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Agromeet $agromeet)
    {
        if($agromeet){
            $agromeet->delete ();
            return ['status' => true, 'code' => 200, 'data'=>$agromeet];
        }else{
            return ['status' => false, 'code' => 404, 'message'=>'data not found'];
        }
    }
}
