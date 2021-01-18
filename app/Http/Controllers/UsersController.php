<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    /**
     * send a otp to the user mobile.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendOTP(Request $request)
    {
        $post = $request->all();
        $validator = Validator::make($request->all(), [
            'user_mobile' => 'required|integer|digits:10',
        ]);

        if ($validator->fails()) {
            $responseArr['status'] = false;
            $responseArr['message'] = $validator->errors();;
            $responseArr['token'] = '';
            return response()->json($responseArr, Response::HTTP_BAD_REQUEST);
        }

        $data['user_mobile'] = $post['user_mobile'];
        $data['otp_code'] = 123456;
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');
        $user_otp_id = DB::table('user_otp')->insertGetId($data);
        if($user_otp_id){
            $responseArr['status'] = true;
            $responseArr['message'] = 'Sucessfully';
            $responseArr['data'] = ['user_otp_id'=>$user_otp_id];
            $responseArr['token'] = '';
            return response()->json($responseArr, Response::HTTP_CREATED);
        }else{
            $responseArr['status'] = false;
            $responseArr['message'] = Response::HTTP_INTERNAL_SERVER_ERROR;
            $responseArr['token'] = '';
            return response()->json($responseArr, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }   
    /**
     * Verify auser mobile number otp.
     *
     * @return \Illuminate\Http\Response
     */
    public function verifyOTP(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_otp_id' => 'required|integer',
            'otp_code' => 'required|integer',
        ]);

        if ($validator->fails()) {
            $responseArr['status'] = false;
            $responseArr['message'] = $validator->errors();;
            $responseArr['token'] = '';
            return response()->json($responseArr, Response::HTTP_BAD_REQUEST);
        }

        $post = $request->all();
        $user_otp = DB::table('user_otp')->where('user_otp_id', $post['user_otp_id'])->where('otp_code', $post['otp_code'])->where('is_verify', 0)->first();
        if(!empty($user_otp)){
            // $this->common_model->updateData('tbl_user_otp', ['user_otp_id'=>$user_otp_res->user_otp_id], ['is_verify'=>1]);
            $affected = DB::table('user_otp')
                ->where('user_otp_id', $user_otp->user_otp_id)
                ->update(['is_verify' => 1, 'updated_at'=>date('Y-m-d H:i:s')]);
            if($affected){
                $responseArr['status'] = true;
                $responseArr['message'] = 'Sucessfully';
                $responseArr['token'] = '';
                return response()->json($responseArr, Response::HTTP_OK);
            }
        }else{
            $responseArr['status'] = false;
            $responseArr['message'] = Response::HTTP_NOT_FOUND;
            $responseArr['token'] = '';
            return response()->json($responseArr, Response::HTTP_NOT_FOUND);
        }
    }
    /**
     * Rewgister a user of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function registerUser(Request $request)
    {
        $post = $request->all();
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'mobile' => 'required|integer|digits:10',
            'pincode' => 'required',
            'country_id' => 'required',
            'state_id' => 'required',
            'city' => 'required',
            'address' => 'required',

        ]);
        if ($validator->fails()) {
            $responseArr['status'] = false;
            $responseArr['message'] = $validator->errors();;
            $responseArr['token'] = '';
            return response()->json($responseArr, Response::HTTP_BAD_REQUEST);
        }
        $user = User::where('mobile', $post['mobile'])->first();
        if(!empty($user)){
            $responseArr['status'] = false;
            $responseArr['message'] = 'mobile number already exists';
            $responseArr['token'] = '';
            return response()->json($responseArr, Response::HTTP_FOUND);
        }else{
            $user = User::create($post);
            $responseArr['status'] = true;
            $responseArr['message'] = 'Sucessfully';
            $responseArr['data'] = $user;
            return response()->json($responseArr, Response::HTTP_OK);
        }
    }     
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        return $request->All();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        if(isset($_POST) && count($_POST) > 0){

            if(isset($_POST['contact']) && (!empty($_POST['contact']))){
                $users = new User();
                $uData = $users->where('mobile',$_POST['contact'])->first();
                if(!empty($uData)){
                    // $users->otp = '123456';
                    $updated = $users->where('mobile',$_POST['contact'])->update(['otp'=>'123456']);
                    // dd($users);
                    if($updated){
                        $data = ['status' => true, 'code' => 200, 'message' => "Please Verify Otp", 'otp' => '1234'];    
                    }else{
                        $data = ['status' => false, 'code' => 201, 'message' => "Something Goes Wrong Please Try Again"];
                    }
                }else{
                    $users->mobile = $_POST['contact'];
                    $users->otp = '123456';
                    $saved = $users->save();
                    if($saved){
                        $data = ['status' => true, 'code' => 200, 'message' => "You're Sucessfully Registered", 'otp' => '1234'];    
                    }else{
                        $data = ['status' => false, 'code' => 201, 'message' => "Something Goes Wrong Please Try Again"];
                    }
                }
                return $data;
            }else{
                $data = ['status' => false, 'code' => 201, 'message' => 'Please Enter Contact Number'];
                return $data;
            }
        }else{
            $data = ['status' => false, 'code' => 201, 'message' => 'Please Enter Contact Number'];
                return $data;
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function otpVerify(Request $request)
    {
        if(isset($_POST) && count($_POST) > 0){

            if(isset($_POST['otp']) && (!empty($_POST['otp']))){
                if((!isset($_POST['contact'])) && (empty($_POST['contact']))){
                    $data = ['status' => false, 'code' => 201, 'message' => 'Please Enter Contact Number'];
                }else{
                    $users = new User();
                    $uData = $users->where('mobile',$_POST['contact'])->get();
                    if(isset($uData) && (count($uData) > 0)){
                        // $users->otp = '123456';
                        $updated = $users->where('mobile',$_POST['contact'])->update(['otp'=>'123456']);
                        if($updated){
                            $data = ['status' => true, 'code' => 200, 'message' => "Please Verify Otp", 'otp' => '1234'];    
                        }else{
                            $data = ['status' => false, 'code' => 201, 'message' => "Something Goes Wrong Please Try Again"];
                        }
                    }else{
                        $users->mobile = $_POST['contact'];
                        $saved = $users->save();
                        if($saved){
                            $data = ['status' => true, 'code' => 200, 'message' => "You're Sucessfully Registered", 'otp' => '1234'];    
                        }else{
                            $data = ['status' => false, 'code' => 201, 'message' => "Something Goes Wrong Please Try Again"];
                        }
                    }  
                }
                
                return $data;
            }else{
                $data = ['status' => false, 'code' => 201, 'message' => 'Please Enter Otp'];
                return $data;
            }
        }else{
            $data = ['status' => false, 'code' => 201, 'message' => 'Please Enter Detail'];
                return $data;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Users  $users
     * @return \Illuminate\Http\Response
     */
    public function show(Users $users)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Users  $users
     * @return \Illuminate\Http\Response
     */
    public function edit(Users $users)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Users  $users
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Users $users)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Users  $users
     * @return \Illuminate\Http\Response
     */
    public function destroy(Users $users)
    {
        //
    }
}
