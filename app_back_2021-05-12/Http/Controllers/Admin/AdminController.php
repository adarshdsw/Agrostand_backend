<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $admin = Admin::first();
        return view('admin.admin_profile', compact('admin'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Admin $admin)
    {
        $rules  = [
            'username'      => 'required',
            'email'         => 'required',
            'mobile'         => 'required',
        ];

        if($request->input('password')){
            $rules['password']      = 'min:6|required_with:conf_password|same:conf_password';
            $rules['conf_password'] = 'min:6';
        }
        
        $request->validate($rules);

        $post = $request->all();
        $admin->username    = $post['username'];
        $admin->email       = $post['email'];
        $password           = bcrypt($request->input('password'));
        $admin->password    = $password;
        $res = $admin->save();
        if($res){
            return redirect(route('admin.profile'))->with('success', __('The Profile has been successfully updated'));
        }else{
            return redirect(route('admin.profile'))->with('fail', __('Something went wrong'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
        //
    }
    /**
     * login the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $email  = $request->input('email');
        $password = bcrypt($request->input('password'));
        // echo "<pre>";print_r($email);
        // echo "<pre>";print_r($password);die;
        $admin = Admin::where('email', $email)->first();
        if(!empty($admin)){
            $data = ['status' => true, 'code' => 200, 'message' => "You're Sucessfully logedin"];    
        }else{
            $data = ['status' => false, 'code' => 201, 'message' => 'login failed!'];
        }
        return $data;
    }

    public function categoryList(){
        $category = [];
        $data = ['status'=> true, 'code'=> 200, 
        'message'=> 'Category List', 
        'data'=> $category];
        return $data;
    }

    public function subCategorylist(){
        $category = [];
        $data = ['status'=> true, 'code'=> 200, 'message'=> 'Sub Category List', 
        'data'=> $category];
        return $data;
    }

    public function newsList(){
        $category = [];
        $data = ['status'=> true, 'code'=> 200, 'message'=> 'News List', 
        'data'=> $category];
        return $data;
    }

    public function bannerList(){

        $category = [];
        $data = ['status'=> true, 'code'=> 200, 'message'=> 'Banner List', 
        'data'=> $category];
        return $data;
    }

    public function commodityList(){
        $category = [];
        $data = ['status'=> true, 'code'=> 200, 'message'=> 'Commodity List', 
        'data'=> $category];
        return $data;
    }

    public function govtSchemelist(){
        $category = [];
        $data = ['status'=> true, 'code'=> 200, 'message'=> 'Givernment Scheme', 
        'data'=> $category];
        return $data;
    }
}
