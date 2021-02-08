<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Models\Users;

class UsersController extends Controller
{
    /**
     * Displays datatables front end view
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $data = [];
        $users = Users::all();
        /*if(count($users)){
            $data = ['status' => true, 'code' => 200, 'data'=>$users];
        }else{
            $data = ['status' => false, 'code' => 404, 'message' => "data not found"];
        }
        return $data;*/
        return view('admin.users.index', compact('users'));
    }
    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function userData(Request $request){
        // dd($request->all());
        return Datatables::of(User::all())->make(true);
        // dd($res);
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    /*update user status*/
    public function updateStatus(Request $request){
        $user_id = $request->input('user_id');
        $status = $request->input('status');
        if($user = Users::find($user_id)){
            $user->status = ($status == '0') ? '0' : '1';
            $res = $user->save();
            if($res){
                return ['status' => true, 'code' => 200, 'data'=>$user];
            }
        }else{
            return ['status' => false, 'code' => 404, 'message'=>'data not found'];
        }
    }
}
