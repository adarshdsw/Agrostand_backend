<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminBank;
use Illuminate\Http\Request;

class AdminBankController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admin_bank = AdminBank::first();
        return view('admin.admin_bank_info', compact('admin_bank'));
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
    public function edit(AdminBank $admin_bank)
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
    public function update(Request $request, AdminBank $admin_bank)
    {
        $post = $request->all();

        $rules  = [
            'account_owner'  => 'required',
            'bank_name'      => 'required',
            'term_condition'   => 'required',
            'account_number' => 'required',
            'ifsc_code'      => 'required',
        ];
        
        $request->validate($rules);

        $admin_bank->account_owner          = $post['account_owner'];
        $admin_bank->account_owner_hindi    = $post['account_owner_hindi'];
        $admin_bank->bank_name              = $post['bank_name'];
        $admin_bank->bank_name_hindi        = $post['bank_name_hindi'];
        $admin_bank->term_condition         = $post['term_condition'];
        $admin_bank->term_condition_hindi   = $post['term_condition_hindi'];
        $admin_bank->account_number         = $post['account_number'];
        $admin_bank->ifsc_code              = $post['ifsc_code'];

        $res = $admin_bank->save();
        if($res){
            return redirect(route('admin.bank'))->with('success', __('The Admin Bank has been successfully updated'));
        }else{
            return redirect(route('admin.bank'))->with('fail', __('Something went wrong'));
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
