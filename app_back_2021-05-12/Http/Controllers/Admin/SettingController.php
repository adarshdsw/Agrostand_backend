<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\AdminBank;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $settings = Setting::first();
        return view('admin.settings.index', compact('settings'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $settings = Setting::first();
        if($settings){
            $data = ['status' => true, 'code' => 200, 'data'=>$settings];
        }else{
            $data = ['status' => false, 'code' => 404, 'message' => __('messages.response.error_404') ];
        }
        return $data;
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function bank()
    {
        $admin_bank = AdminBank::first();
        if($admin_bank){
            $data = ['status' => true, 'code' => 200, 'data'=>$admin_bank];
        }else{
            $data = ['status' => false, 'code' => 404, 'message' => __('messages.response.error_404') ];
        }
        return $data;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function edit(Setting $setting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Setting $setting)
    {
        $rules  = [
            'contact_person'   => 'required',
            'contact_email'    => 'required',
            'contact_number'   => 'required',
            'company_address'  => 'required',
            'company_address_hindi' => 'required',
            'terms_conditions'      => 'required',
            'terms_conditions_hindi' => 'required',
            'privacy_policy'        => 'required',
            'privacy_policy_hindi'  => 'required',
            'about_us'              => 'required',
            'about_us_hindi'        => 'required',
        ];
        
        $request->validate($rules);

        $post = $request->all();
        $setting->contact_person    = $post['contact_person'];
        $setting->contact_email     = $post['contact_email'];
        $setting->contact_number    = $post['contact_number'];
        $setting->company_address   = $post['company_address'];
        $setting->company_address_hindi   = $post['company_address_hindi'];
        $setting->terms_conditions        = $post['terms_conditions'];
        $setting->terms_conditions_hindi  = $post['terms_conditions_hindi'];
        $setting->privacy_policy          = $post['privacy_policy'];
        $setting->privacy_policy_hindi    = $post['privacy_policy_hindi'];
        $setting->about_us                = $post['about_us'];
        $setting->about_us_hindi          = $post['about_us_hindi'];
        $res = $setting->save();
        if($res){
            return redirect(route('admin.settings'))->with('success', __('The Setting has been successfully updated'));
        }else{
            return redirect(route('admin.settings'))->with('fail', __('Something went wrong'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Setting $setting)
    {
        //
    }
}
