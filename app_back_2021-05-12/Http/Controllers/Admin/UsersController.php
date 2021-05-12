<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;
use App\Models\Role;
use App\Models\Assured;
// Datatables
use DB;
use DataTables;

class UsersController extends Controller
{
    /**
     * Displays datatables front end view
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $assures    = Assured::where('status', '1')->get();
        $roles      = Role::where('status', '1')->get();
        $categories = Category::where('parent', 0)->where('status', '1')->get();
        return view('admin.users.index', compact('assures', 'roles', 'categories'));
    }
    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function userData(Request $request){
        $users = User::with(['category', 'role', 'assured'])->select('users.*');

        return DataTables::of($users)
                ->addColumn('user_image', function ($users) {
                    return '<img src="'.$users->user_image.'" alt="'.$users->name.'" height="50" >';
                })
                ->addColumn('status', function ($users) {
                    $checked_status = ($users->status == '1') ? "checked" : "";
                    return '<input class="update_status" type="checkbox" name="is_active" value="1" data-user_id="'.$users->id.'" '.$checked_status.'>';
                })
                ->addColumn('verify', function ($users) {
                    $checked_verification = ($users->is_verified == '1') ? "checked" : "";
                    return '<input type="checkbox" name="is_verified" id="is_verified" value="1" onchange="changeUserVerification(this)" data-user_id="'.$users->id.'" '.$checked_verification.' >';
                })
                ->addColumn('select_assured', function ($users) {
                    $select_assured_1 = ($users->assured_id == '1') ? "selected" : "";
                    $select_assured_2 = ($users->assured_id == '2') ? "selected" : "";
                    $select_assured_3 = ($users->assured_id == '3') ? "selected" : "";
                    $select_assured_4 = ($users->assured_id == '4') ? "selected" : "";
                    return '<select name="assured_id" id="assured_id" onchange="changeUserAssures(this)" data-user_id="'.$users->id.'">
                        <option '.$select_assured_1.' value="1">Bronze</option>
                        <option '.$select_assured_2.' value="2">Sliver</option>
                        <option '.$select_assured_3.' value="3">Gold</option>
                        <option '.$select_assured_4.' value="4">Platinum</option>
                    </select>';
                })
                ->addColumn('action', function ($users) {
                    $btn_html = '';
                    $btn_html = $btn_html.'<a class="btn btn-xs btn-info" href="'.route('admin.users.show', $users).'" role="button" title="View"><i class="fas fa-eye"></i></a>&nbsp;';
                    return $btn_html;
                })
                ->addColumn('total_referred', function($users){
                    $total_count = DB::table('users')->where('referral_by', $users->id)->count();
                    return '<span class="badge bg-danger">'.$total_count.'</span>';
                })
                ->filter(function ($query) use ($request) {
                    // filter for title
                    if ($request->input('name') != '') {
                        $query->where('name', 'like', "%{$request->input('name')}%");
                    }
                    // filter for mobile
                    if ($request->input('mobile') != '') {
                        $query->where('mobile', 'like', "%{$request->input('mobile')}%");
                    }
                    // filter for Category
                    if ($request->input('category_id') != '') {
                        $query->where('category_id', $request->input('category_id'));
                    }
                    // filter for Role
                    if ($request->input('role_id') != '') {
                        $query->where('role_id', $request->input('role_id'));
                    }
                    // filter for Assured
                    if ($request->input('assured_id') != '') {
                        $query->where('assured_id', $request->input('assured_id'));
                    }
                    // filter for is verfiied user
                    if ($request->input('is_verified') != '') {
                        $query->where('is_verified', $request->input('is_verified'));
                    }
                    // filter for status
                    if ($request->input('status') != '') {
                        $query->where('status', $request->input('status'));
                    }
                })
                ->rawColumns(['status', 'verify', 'action', 'user_image', 'select_assured', 'total_referred'])
                ->make(true);
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
        $user = User::find($id);
        $assures = DB::table('assures')->get();
        $roles = DB::table('roles')->get();
        $states = DB::table('state')->get();
        $state_id = ($user->address) ? $user->address->state_id : 0;
        $districts = DB::table('district')->where('state_id', $state_id)->get();
        $district_id = ($user->address) ? $user->address->district : 0;
        $cities = DB::table('city')->where('district_id', $district_id)->get();
        if(!empty($user)){
            return view('admin/users/show', compact('user','assures','roles', 'states', 'districts', 'cities'));
        }else{
            return redirect(route('admin.users.index'))->with('fail', 'User Not found');
        }
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
        if($user = User::find($user_id)){
            $user->status = ($status == '0') ? '0' : '1';
            $res = $user->save();
            if($res){
                return ['status' => true, 'code' => 200, 'data'=>$user];
            }
        }else{
            return ['status' => false, 'code' => 404, 'message'=>'data not found'];
        }
    }
    /*update user assurity*/
    public function updateAssure(Request $request){
        $user_id = $request->input('user_id');
        $assured_id = $request->input('assured_id');
        if($user = User::find($user_id)){
            $user->assured_id = $assured_id;
            $res = $user->save();
            if($res){
                return ['status' => true, 'code' => 200, 'data'=>$user];
            }
        }else{
            return ['status' => false, 'code' => 404, 'message'=>'data not found'];
        }
    }
    /*update user verification*/
    public function updateVerify(Request $request){
        $user_id = $request->input('user_id');
        $verify_value = $request->input('verify_value');
        if($user = User::find($user_id)){
            $user->is_verified = $verify_value;
            $res = $user->save();
            if($res){
                return ['status' => true, 'code' => 200, 'data'=>$user];
            }
        }else{
            return ['status' => false, 'code' => 404, 'message'=>'data not found'];
        }
    }
    /*update user status*/
    public function updateStatusNew(Request $request){
        $user_id = $request->input('user_id');
        $user_status = $request->input('user_status');
        if($user = User::find($user_id)){
            $user->status = $user_status;
            $res = $user->save();
            if($res){
                return ['status' => true, 'code' => 200, 'data'=>$user];
            }
        }else{
            return ['status' => false, 'code' => 404, 'message'=>'data not found'];
        }
    }
}
