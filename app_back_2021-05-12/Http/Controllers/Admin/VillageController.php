<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\State;
use App\Models\District;
use App\Models\City;
use App\Models\Village;
use Illuminate\Http\Request;

class VillageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $villages = Village::all();
        return view('admin.villages.index', compact('villages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $states = State::all();
        // if request is send by ajax
        if ($request->ajax()) {
            return view('admin/villages/create', compact('states') )->render();
        }
        return view('admin/villages/create', compact('states') );
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
            'state_id'      => 'required',
            'district_id'   => 'required',
            'city_id'       => 'required',
            'village_name'  => 'required',
        ]);
        $village = new Village;
        $village->state_id      = $request->input('state_id');
        $village->district_id   = $request->input('district_id');
        $village->city_id       = $request->input('city_id');
        $village->village_name  = $request->input('village_name');
        $village->village_name_hindi  = $request->input('village_name_hindi');
        $res = $village->save();
        if ($request->ajax()) {
            return response()->json([
                'success'=>'The Village has been successfully added.'
            ]);
        }
        return redirect(route('admin.villages.index'))->with('ok', __('The Village has been successfully added'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Village  $village
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Village $village)
    {
        $states     = State::all();
        $districts  = District::where('state_id', $village->state_id)->get();
        $cities     = City::where('district_id', $village->district_id)->get();
        if($village){
            if ($request->ajax()) {
                return view('admin/villages/edit', compact('village', 'states', 'districts', 'cities'))->render();
            }
            return view('admin/villages/edit', compact('village', 'states', 'districts', 'cities'));
        }else{
            return redirect(route('admin.villages.index'))->with('fail', __('Suggestion not found'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Suggestion  $village
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Village $village)
    {
        // Validation
        $rules  = [
            'state_id'      => 'required',
            'district_id'   => 'required',
            'city_id'       => 'required',
            'village_name'  => 'required',
        ];

        $request->validate($rules);
        if($village){
            $village->state_id          = $request->input('state_id');
            $village->district_id       = $request->input('district_id');
            $village->city_id           = $request->input('city_id');
            $village->village_name      = $request->input('village_name');
            $village->village_name_hindi = $request->input('village_name_hindi');
            // dd($suggestion);
            $res = $village->save();
            if($res){
                if ($request->ajax()) {
                    return response()->json([
                        'success'=>'The Village has been successfully updated.'
                    ]);
                }
                return redirect(route('admin.villages.index'))->with('success', 'The Village has been successfully updated');
            }else{
                if ($request->ajax()) {
                    return response()->json([
                        'fail'=>'something Went wrong please try again.'
                    ]);
                }
                return redirect(route('admin.villages.index'))->with('fail', 'something Went wrong please try again.');
            }
        }else{
            if ($request->ajax()) {
                return response()->json([
                    'fail'=>'village Not Found.'
                ]);
            }
            return redirect(route('admin.villages.index'))->with('fail', __('Village not found'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Suggestion  $suggestion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Village $village)
    {
        if($village){
            $village->delete ();
            return ['status' => true, 'code' => 200, 'data'=>$village];
        }else{
            return ['status' => false, 'code' => 404, 'message'=>'data not found'];
        }
    }

    public function getStateDistricts(Request $request){
        $state_id = $request->input('state_id');
        $districts = District::where('state_id', $state_id)->get();
        $districts_html = '';
        $districts_html = '<option value="">--select district--</option>';
        if($districts){
            foreach ($districts as $district) {
                $districts_html = $districts_html."<option value='".$district->district_id."'>".$district->district_name."</option>";
            }
        }
        return $districts_html;
    }

    public function getDistrictCities(Request $request){
        $district_id = $request->input('district_id');
        $cities = City::where('district_id', $district_id)->get();
        $cities_html = '';
        $cities_html = '<option value="">--select city--</option>';
        if($cities){
            foreach ($cities as $city) {
                $cities_html = $cities_html."<option value='".$city->city_id."'>".$city->city_name."</option>";
            }
        }
        return $cities_html;
    }

    public function villagesList(Request $request){
        $post = $request->all();
        $villages = Village::where('state_id', $post['state_id'])
                        ->where('district_id', $post['district_id'])
                        ->where('city_id', $post['city_id'])
                        ->get();
        if($villages){
            $data = ['status' => true, 'code' => 200, 'villages' => $villages];
        }else{
            $data = ['status' => false, 'code' => 404, 'msg' => 'village not found'];
        }
        return $data;
    }
}
