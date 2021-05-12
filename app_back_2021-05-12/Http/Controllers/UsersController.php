<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserAddress;
use App\Models\UserBank;
use App\Models\UserKyc;
use App\Models\Category;
use App\Models\Commodity;
use App\Models\UserRatting;
use App\Models\UserCommodity;
use App\Models\UserBusiness;
use App\Models\UserBusinessDocs;
use App\Models\UserEducation;
use App\Models\UserFollower;
use App\Models\Ebill;
use App\Models\Brand;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
// Notification
use App\Notifications\UserWelcome;
use App\Notifications\NotifyFollowingUser;
use Illuminate\Support\Facades\Notification;
use Illuminate\Notifications\DatabaseNotification;

class UsersController extends Controller
{
	private $user_next_id;
	
	public function __construct(){
		$user_last = User::latest()->first();
        $this->user_next_id = ($user_last) ? $user_last->id + 1 : 1;
	}

	public function index(Request $request){
		$perameters     = $request->all();
		// dd($perameters);
        $user_id    	= $request->input('user_id');
        $search_name    = $request->input('search_name');
        $search_unique_id    = $request->input('search_unique_id');
        $category_id    = $request->input('category_id');
        $subcategory_id = $request->input('subcategory_id');
        $commodity_id   = $request->input('commodity_id');
        $role_id        = $request->input('role_id');
        $offset         = $request->input('offset');
        $limit          = $request->input('limit');
        $column_name    = $request->input('column_name');
        $sort_by        = $request->input('sort_by');

        $users = User::with('category', 'subcategory', 'userCommodity', 'address')
                        ->where('id', '!=', $user_id)->where('status', '1')->where('role_id', $role_id)
                        ->when ((isset($search_name) && $search_name !== '' && !empty($search_name) ), function ($query) use ($perameters) {
                            $query->where('name', 'LIKE', "%{$perameters['search_name']}%");
                        })
                        ->when ((isset($search_unique_id) && $search_unique_id !== '' && !empty($search_unique_id) ), function ($query) use ($perameters) {
                            $query->where('user_code', 'LIKE', "%{$perameters['search_unique_id']}%");
                        })
                        ->when ((isset($category_id) && $category_id !== '' && !empty($category_id) ), function ($query) use ($perameters) {
                            $query->where('category_id', $perameters['category_id']);
                        })
                        ->when ((isset($subcategory_id) && $subcategory_id !== '' && !empty($subcategory_id) ), function ($query) use ($perameters) {
                            $query->where('subcategory_id', $perameters['subcategory_id']);
                        })
                        ->whereHas('userCommodity', function($query) use($perameters) {
                            // echo "<pre>"; print_r($query);die;
                            $commodity_id    = isset($perameters['commodity_id']) ? $perameters['commodity_id'] : 0;
                            if(isset($commodity_id) && !empty($commodity_id)  && $commodity_id != '' && is_numeric($commodity_id) ){
                                $query->where('commodity_id', $commodity_id);
                            }
                        })
                        ->whereHas('address', function($aquery) use($perameters) {
                            // echo "<pre>"; print_r($perameters['state_id']);die;
                            $state_id    = isset($perameters['state_id']) ? $perameters['state_id'] : 0;
                            $district_id = isset($perameters['district_id']) ? $perameters['district_id'] : 0;
                            $city_id     = isset($perameters['city_id']) ? $perameters['city_id'] : 0;
                            // if filter by state id
                            if(isset($state_id) && !empty($state_id)  && $state_id != '' && is_numeric($state_id) ){
                                $aquery->where('state_id', $perameters['state_id']);
                            }
                            // if filter by district
                            if(isset($district_id) && !empty($district_id)  && $district_id != '' && is_numeric($district_id) ){
                                $aquery->where('district', $perameters['district_id']);
                            }
                            // if filter by city
                            if(isset($city_id) && !empty($city_id)  && $city_id != '' && is_numeric($district_id) ){
                                $aquery->where('city', $perameters['city_id']);
                            }
                        })
                        ->when ((isset($perameters['assured_id']) && $perameters['assured_id'] !== '' && !empty($perameters['assured_id']) ), function ($query) use ($perameters) {
                            $query->where('assured_id', $perameters['assured_id']);
                        })
                        ->when ((isset($perameters['avg_ratting']) && $perameters['avg_ratting'] !== '' && !empty($perameters['avg_ratting']) ), function ($query) use ($perameters) {
                            $query->where('avg_ratting', $perameters['avg_ratting']);
                        })
                        ->offset($offset)
                        ->limit($limit)
                        ->orderBy($column_name, $sort_by)
                        ->get();
                        
        $total_count = User::where('id', '!=', $user_id)->where('status', '1')->where('role_id', $role_id)
        				->when ((isset($search_name) && $search_name !== '' && !empty($search_name) ), function ($query) use ($perameters) {
                            $query->where('name', 'LIKE', "%{$perameters['search_name']}%");
                        })
                        ->when ((isset($search_unique_id) && $search_unique_id !== '' && !empty($search_unique_id) ), function ($query) use ($perameters) {
                            $query->where('user_code', 'LIKE', "%{$perameters['search_unique_id']}%");
                        })
                        ->when ((isset($category_id) && $category_id !== '' && !empty($category_id) ), function ($query) use ($perameters) {
                            $query->where('category_id', $perameters['category_id']);
                        })
                        ->when ((isset($subcategory_id) && $subcategory_id !== '' && !empty($subcategory_id) ), function ($query) use ($perameters) {
                            $query->where('subcategory_id', $perameters['subcategory_id']);
                        })
                        ->whereHas('userCommodity', function($query) use($perameters) {
                            // echo "<pre>"; print_r($query);die;
                            $commodity_id    = isset($perameters['commodity_id']) ? $perameters['commodity_id'] : 0;
                            if(isset($commodity_id) && !empty($commodity_id)  && $commodity_id != '' && is_numeric($commodity_id) ){
                                $query->where('commodity_id', $commodity_id);
                            }
                        })
                        ->whereHas('address', function($aquery) use($perameters) {
                            // echo "<pre>"; print_r($perameters['state_id']);die;
                            $state_id    = isset($perameters['state_id']) ? $perameters['state_id'] : 0;
                            $district_id = isset($perameters['district_id']) ? $perameters['district_id'] : 0;
                            $city_id     = isset($perameters['city_id']) ? $perameters['city_id'] : 0;
                            // if filter by state id
                            if(isset($state_id) && !empty($state_id)  && $state_id != '' && is_numeric($state_id) ){
                                $aquery->where('state_id', $perameters['state_id']);
                            }
                            // if filter by district
                            if(isset($district_id) && !empty($district_id)  && $district_id != '' && is_numeric($district_id) ){
                                $aquery->where('district', $perameters['district_id']);
                            }
                            // if filter by city
                            if(isset($city_id) && !empty($city_id)  && $city_id != '' && is_numeric($district_id) ){
                                $aquery->where('city', $perameters['city_id']);
                            }
                        })
                        ->when ((isset($perameters['assured_id']) && $perameters['assured_id'] !== '' && !empty($perameters['assured_id']) ), function ($query) use ($perameters) {
                            $query->where('assured_id', $perameters['assured_id']);
                        })
                        ->when ((isset($perameters['avg_ratting']) && $perameters['avg_ratting'] !== '' && !empty($perameters['avg_ratting']) ), function ($query) use ($perameters) {
                            $query->where('avg_ratting', $perameters['avg_ratting']);
                        })
                        ->count();
        if($users){
        	$ebill_last = Ebill::latest()->first();
        	$next_ebill_id = ($ebill_last) ? $ebill_last->id + 1 : 1;
        	$order_id = 'AS'.date("Ymd").'-'.rand(10000, 99999).'-'.$next_ebill_id;
        	$bill_number = time();
        	// echo $ebill_last->id + 1;die;
            $data = ['status' => true, 'code' => 200, 'users' => $users, 'total_count'=>$total_count, 'order_id'=>$order_id, 'bill_number'=>$bill_number];
        }else{
            $data = ['status' => false, 'code' => 500];
        }
        return $data;
	}

	public function languageList(Request $request){
		$languages = DB::table('languages')->get();
		if($languages){
			$responseArr['status'] = true;
			$responseArr['data'] = $languages;
			return response()->json($responseArr, Response::HTTP_OK);
		}
	}

	public function assuredList(Request $request){
		$assures = DB::table('assures')->get();
		if($assures){
			$responseArr['status'] = true;
			$responseArr['data'] = $assures;
			return response()->json($responseArr, Response::HTTP_OK);
		}
	}

	public function roleList(Request $request){
		$roles = DB::table('roles')->get();
		if($roles){
			$responseArr['status'] = true;
			$responseArr['data'] = $roles;
			return response()->json($responseArr, Response::HTTP_OK);
		}
	}

	public function unitList(Request $request){
		$units = DB::table('units')->get();
		if($units){
			$responseArr['status'] = true;
			$responseArr['data'] = $units;
			return response()->json($responseArr, Response::HTTP_OK);
		}
	}

	public function countryList(Request $request){
		$countries = DB::table('countries_new')->get();
		if($countries){
			$responseArr['status'] = true;
			$responseArr['data'] = $countries;
			return response()->json($responseArr, Response::HTTP_OK);
		}
	}

	public function categoryList(Request $request){
		$categories = Category::all();
		if($categories){
			$responseArr['status'] = true;
			$responseArr['data'] = $categories;
			return response()->json($responseArr, Response::HTTP_OK);
		}
	}

	public function brandList(Request $request){
		$category_id = $request->input('category_id');
		$brands = DB::table('brands')->where('category_id', $category_id)->get();
		if($brands){
			$responseArr['status'] = true;
			$responseArr['data'] = $brands;
			return response()->json($responseArr, Response::HTTP_OK);
		}
	}

	public function brandStore(Request $request){
		$post = $request->all();
		$brand = new Brand;
		$brand->category_id = $post['category_id'];
		$brand->title 	= $post['brand_title'];
		$brand->slug 	= '';
		$brand->status  = '1';
		$res = $brand->save();
		if($res){
			return ['status' => true, 'code' => 200, 'data'=>$brand, 'message'=>__('messages.response.success_brand_store')];
		}else{
			return ['status' => false, 'code' => 404, 'message'=>__('messages.response.failed_brand_store')];
		}
	}

	public function subCategoryList(Request $request){
		$category_id = $request->input('category_id');
		$sub_categories = Category::where('parent', $category_id)->get();
		if($sub_categories){
			$responseArr['status'] = true;
			$responseArr['data'] = $sub_categories;
			return response()->json($responseArr, Response::HTTP_OK);
		}
	}

	public function commodityList(Request $request){
		$subcategory_id = $request->input('subcategory_id');
		$commodities = Commodity::where('subcategory_id', $subcategory_id)->get();
		if($commodities){
			$responseArr['status'] = true;
			$responseArr['data'] = $commodities;
			return response()->json($responseArr, Response::HTTP_OK);
		}
	}

	public function stateList(Request $request){
		// $country_id = $request->input('country_id');
		$states = DB::table('state')->get();
		if($states){
			$responseArr['status'] = true;
			$responseArr['data'] = $states;
			return response()->json($responseArr, Response::HTTP_OK);
		}
	}

	public function districtList(Request $request){
		$state_id = $request->input('state_id');
		$district = DB::table('district')->where('state_id', $state_id)->get();
		if($district){
			$responseArr['status'] = true;
			$responseArr['data'] = $district;
			return response()->json($responseArr, Response::HTTP_OK);
		}else{
			$responseArr['status'] = false;
			return response()->json($responseArr, Response::HTTP_NOT_FOUND);
		}
	}

	public function cityList(Request $request){
		$district_id = $request->input('district_id');
		$cities = DB::table('city')->where('district_id', $district_id)->get();
		if($cities){
			$responseArr['status'] = true;
			$responseArr['data'] = $cities;
			return response()->json($responseArr, Response::HTTP_OK);
		}else{
			$responseArr['status'] = false;
			return response()->json($responseArr, Response::HTTP_NOT_FOUND);
		}
	}
	/**
	 * select language
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function selectLanguage(Request $request){
		$post = $request->all();
		$validator = Validator::make($request->all(), [
			'language_id' => 'required|integer|digits:10',
		]);

		if ($validator->fails()) {
			$responseArr['status'] = false;
			$responseArr['message'] = $validator->errors();;
			$responseArr['token'] = '';
			return response()->json($responseArr, Response::HTTP_OK);
		}

		$data['language_id'] = $post['language_id'];
		$data['device_id']   = isset($post['device_id']) ? $post['device_id'] : '';
		$data['created_at'] = date('Y-m-d H:i:s');
		$data['updated_at'] = date('Y-m-d H:i:s');
		$user_id = DB::table('users')->insertGetId($data);
		if($user_id){
			$responseArr['status'] = true;
			$responseArr['message'] = 'Sucessfully';
			$responseArr['data'] = ['user_otp_id'=>$user_otp_id];
			$responseArr['token'] = '';
			return response()->json($responseArr, Response::HTTP_OK);
		}else{
			$responseArr['status'] = false;
			$responseArr['message'] = Response::HTTP_OK;
			$responseArr['token'] = '';
			return response()->json($responseArr, Response::HTTP_OK);
		}
	}
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
		$message = json_decode(json_encode($validator->errors()));
		
		if ($validator->fails()) {
			$responseArr['status'] = false;
			$responseArr['message'] = __('messages.response.error_500');
			$responseArr['token'] = '';
			return response()->json($responseArr, Response::HTTP_OK);
		}

		// send test sms 
		// echo send_sms(); die;

		$data['user_mobile'] = $post['user_mobile'];
		$data['otp_code'] = 123456;
		$data['created_at'] = date('Y-m-d H:i:s');
		$data['updated_at'] = date('Y-m-d H:i:s');
		$user_otp_id = DB::table('user_otp')->insertGetId($data);
		if($user_otp_id){
			
			$responseArr['status'] = true;
			$responseArr['message'] = __('messages.response.send_otp');
			$responseArr['data'] = ['user_otp_id'=>$user_otp_id];
			$responseArr['token'] = '';
			return response()->json($responseArr, Response::HTTP_OK);
		}else{
			$responseArr['status'] = false;
			$responseArr['message'] = __('messages.response.send_otp_fail');
			$responseArr['token'] = '';
			return response()->json($responseArr, Response::HTTP_OK);
		}
	}
	/**
	 * resend a otp to the user mobile.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function resendOTP(Request $request)
	{
		// echo  "X-localization - ".$request->header('X-localization');die;
		$post = $request->all();
		$validator = Validator::make($request->all(), [
			'user_otp_id' => 'required|integer',
		]);

		if ($validator->fails()) {
			$responseArr['status'] = false;
			$responseArr['message'] = __('messages.response.error_500');
			$responseArr['token'] = '';
			return response()->json($responseArr, Response::HTTP_OK);
		}

		$user_otp = DB::table('user_otp')->where('user_otp_id', $post['user_otp_id'])->where('is_verify', 0)->first();

		if($user_otp){
			$data['otp_code']   = '123456';
			$data['updated_at'] = date('Y-m-d H:i:s');
			$res = DB::table('user_otp')->where('user_otp_id', $post['user_otp_id'])->where('is_verify', 0)->update($data);
			$responseArr['status'] = true;
			$responseArr['message'] = __('messages.response.send_otp');
			$responseArr['data'] = ['user_otp_id'=>$user_otp->user_otp_id];
			$responseArr['token'] = '';
			return response()->json($responseArr, Response::HTTP_OK);
		}else{
			$responseArr['status'] = false;
			$responseArr['message'] = __('messages.response.send_otp_fail');
			$responseArr['token'] = '';
			return response()->json($responseArr, Response::HTTP_OK);
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
			$responseArr['message'] = __('messages.response.error_500');
			$responseArr['token'] = '';
			return response()->json($responseArr, Response::HTTP_OK);
		}

		$post = $request->all();
		$device_id = ($post['device_id']) ? $post['device_id'] : '';

		$user_otp = DB::table('user_otp')->where('user_otp_id', $post['user_otp_id'])->where('is_verify', 0)->first();
		
		if(!empty($user_otp)){
			if($user_otp->otp_code == $post['otp_code']){
				// $this->common_model->updateData('tbl_user_otp', ['user_otp_id'=>$user_otp_res->user_otp_id], ['is_verify'=>1]);
				$affected = DB::table('user_otp')
					->where('user_otp_id', $user_otp->user_otp_id)
					->update(['is_verify' => 1, 'updated_at'=>date('Y-m-d H:i:s')]);
				
				if($affected)
				{
					$is_user_blocked = User::where('mobile', $user_otp->user_mobile)->where('role_id', $request->input('role_id'))->where('status', '0')->first();
					if($is_user_blocked){
						$responseArr['status'] = false;
						$responseArr['message'] = __('messages.response.user_blocked');
						$responseArr['data'] = '';
						return response()->json($responseArr, Response::HTTP_OK);
					}
					
					$user = User::where('mobile', $user_otp->user_mobile)->where('role_id', $request->input('role_id'))->first();
					if(empty($user)){
						// $user_data['mobile'] = $user_otp->user_mobile;
						// $user_data['language_id'] = 1;
						// $user = User::create($user_data);
						$responseArr['status'] = true;
						$responseArr['message'] = __('messages.response.verify_otp');
						$responseArr['is_new'] = true;
						$responseArr['data'] = '';
						// $result = ['status' => true, 'code' => 201, 'message' => 'Sucessfully', 'data' => $user, 'is_new' => true];
						return response()->json($responseArr, Response::HTTP_OK);
					}else{
						$user->device_id = $device_id;
						$user->save();

						$responseArr['status'] = true;
						$responseArr['message'] = __('messages.response.verify_otp');
						$responseArr['is_new'] = false;
						$responseArr['data'] = $user;
						return response()->json($responseArr, Response::HTTP_OK);
					}
				}else{
					$responseArr['status'] = false;
					$responseArr['message'] = __('messages.response.error_500');
					return response()->json($responseArr, Response::HTTP_OK);
				}
			}else{
				$responseArr['status'] = false;
				$responseArr['message'] = __('messages.response.failed_verify_otp');
				return response()->json($responseArr, Response::HTTP_OK);
			}
		}else{
			$responseArr['status'] = false;
			$responseArr['message'] = __('messages.response.error_404');
			return response()->json($responseArr, Response::HTTP_OK);
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
		// dd($post);
		$validator = Validator::make($request->all(), [
			'name' => 'required',
			'mobile' => 'required|integer|digits:10',
			'pincode' => 'required',
			'country_id' => 'required',
			'state_id' => 'required',
			'city' => 'required',
		]);

		if ($validator->fails()) {
			$responseArr['status'] = false;
			$responseArr['message'] = __('messages.response.error_500');
			return response()->json($responseArr, Response::HTTP_OK);
		}
		
		$user_unique_code = $this->generate_app_code($this->user_next_id);

		$user = User::where('email', $post['email'])->first();
		if(!empty($user)){
			$responseArr['status'] = false;
			$responseArr['message'] = __('messages.response.email_exist');
			return response()->json($responseArr, Response::HTTP_OK);
		}
		if($post['referral_code'] != ''){
			$referral_user = User::where('user_code', $post['referral_code'])->first();
			if(!empty($referral_user)){
				$responseArr['status'] = false;
				$responseArr['message'] = __('messages.response.referral_not_exist');
				return response()->json($responseArr, Response::HTTP_OK);
			}
		}

		$user = User::where('mobile', $post['mobile'])->first();
		
		if(empty($user)){
			$user_data['name'] 		= $post['name'];
			$user_data['mobile'] 	= $post['mobile'];
			$user_data['email'] 	= $post['email'];
			$user_data['device_id'] = $post['device_id'];
			$user_data['role_id'] 	= $post['role_id'];
			$user_data['category_id'] 	 = $post['category_id'];
			$user_data['subcategory_id'] = $post['subcategory_id'];
			$user_data['user_gender'] 	 = $post['user_gender'];
			$user_data['status'] 		 = '0';
			$user_data['assured_id'] = 1;
			$user_data['is_new'] = '0';
			$user_data['user_code'] = $user_unique_code;
			$user_data['referral_by'] = isset($referral_user) ? $referral_user : 0;
			$user = User::create($user_data);
			
			if(!empty($user)){
				$user_address['user_id'] = $user->id;
				$user_address['address'] = ($post['address']) ? $post['address'] : '';
				$user_address['land_area'] = '';
				$user_address['country_id'] = $post['country_id'];
				$user_address['state_id']   = $post['state_id'];
				$user_address['city']       = $post['city'];
				$user_address['district']   = $post['district'];
				$user_address['village_town'] = $post['village_town'];
				$user_address['house_number'] = $post['house_number'];
				// $user_address['pincode'] 	= $post['pincode'];
				$user_address['latitude']   = $post['latitude'];
				$user_address['longitude']  = $post['longitude'];
				$user_address = UserAddress::create($user_address);

				$commodities_arr = explode(',', $post['commodities_id']);
				if(!empty($commodities_arr)){
					$commodity_data = [];
	                foreach($commodities_arr as $commodity){
	                    $row = [];
	                    $row['user_id']   	= $user->id;
	                    $row['commodity_id'] = $commodity;
	                    $row['created_at']	= date('Y-m-d H:i:s');
						$row['updated_at']	= date('Y-m-d H:i:s');
	                    $commodity_data[]	= $row;
	                }
	                UserCommodity::insert($commodity_data);
				}
				
				// Notification::send($user, new UserWelcome());

				$responseArr['status'] = true;
				$responseArr['message'] = __('messages.response.success_user_registration');
				$responseArr['data'] = ['user' => $user, 'user_address' => $user_address];
				return response()->json($responseArr, Response::HTTP_OK);
			}else{
				$responseArr['status'] = false;
				$responseArr['message'] = __('messages.response.failed_user_registration');
				return response()->json($responseArr, Response::HTTP_OK);
			}
		}else{
			$responseArr['status'] = false;
			$responseArr['message'] = __('messages.response.mobile_exist');;
			return response()->json($responseArr, Response::HTTP_OK);
		}
		// User::where('id', $user->id)->update($user_data);        
	}     
	
	public function getUserProfile(Request $request){
		$user_id = $request->input('user_id');
		$user = User::with('address', 'kyc', 'bank', 'userCommodity', 'business', 'education')->where('id', $user_id)->where('status', '1')->get();
		if($user){
			$responseArr['status'] = true;
			$responseArr['message'] = __('messages.response.success_200');
			$responseArr['data'] = ["user" => $user];
			return response()->json($responseArr, Response::HTTP_OK);
		}else{
			$responseArr['status'] = false;
			$responseArr['message'] = __('messages.response.error_404');
			return response()->json($responseArr, Response::HTTP_OK);
		}
	}

	public function updateUserProfile(Request $request){
		$post = $request->all();
		$update_part = $request->input('update_part');
		$user_id = $request->input('user_id');

		switch ($update_part) {
			
			case "personal":
				$user = User::find($user_id);
				$user->name 		= $post['name'];
				$user->email 		= $post['email'];
				$user->category_id 	= $post['category_id'];
				$user->subcategory_id = $post['subcategory_id'];
				$user->language_id 	= $post['language_id'];
				
				$file       = $request->file('user_image');
				if($file){
	                $filename   = $file->getClientOriginalName();
	                $name       = "user_img";
	                $extension  = $file->extension();
	                $filenew    =  date('d-M-Y').'_'.str_replace($filename,$name,$filename).'_'.time().''.rand(). "." .$extension;
	                $file->move(base_path('/public/uploads/user_image'), $filenew);
	                $user->user_image   = asset('/uploads/user_image/'.$filenew);
				}
				$user->user_code = $this->generate_app_code($this->user_next_id);
				// echo "<pre>";print_r($user);die;
				$res = $user->save();
				
				if($res){
					$commodities_arr = explode(',', $post['commodities_id']);
					if(!empty($commodities_arr)){
						// delete all old commodities and insert new commodities
						UserCommodity::where('user_id', $user->id)->delete();
						$commodity_data = [];
		                foreach($commodities_arr as $commodity){
		                    $row = [];
		                    $row['user_id']   	= $user->id;
		                    $row['commodity_id'] = $commodity;
		                    $row['created_at']	= date('Y-m-d H:i:s');
							$row['updated_at']	= date('Y-m-d H:i:s');
		                    $commodity_data[]	= $row;
		                }
		                UserCommodity::insert($commodity_data);
					}
				}

				$responseArr['status'] = true;
				$responseArr['message'] = __('messages.response.success_profile_update');
				$responseArr['data'] = ["user" => $user];
				return response()->json($responseArr, Response::HTTP_OK);
			
			case "address":
				$user_address = UserAddress::where('user_id', $user_id)->first();
				$user_address->address 		= $post['address'];
				$user_address->land_area 	= $post['land_area'];
				if($file = $request->file('land_proof_img')){
	                $filename   = $file->getClientOriginalName();
	                $name       = "land_proof";
	                $extension  = $file->extension();
	                $filenew    =  date('d-M-Y').'_'.str_replace($filename,$name,$filename).'_'.time().''.rand(). "." .$extension;
	                $file->move(base_path('/public/uploads/user_image'), $filenew);
	                $user_address->land_proof_img   = asset('/uploads/user_image/'.$filenew);
				}
				$user_address->country_id 	= $post['country_id'];
				$user_address->state_id 	= $post['state_id'];
				$user_address->city 		= $post['city'];
				$user_address->district 	= $post['district'];
				$user_address->village_town = $post['village_town'];
				$user_address->house_number = $post['house_number'];
				$user_address->pincode 		= ($post['pincode']) ? $post['pincode'] : 0;
				$user_address->latitude 	= $post['latitude'];
				$user_address->longitude 	= $post['longitude'];
				$user_address->save();
				
				$responseArr['status'] = true;
				$responseArr['message'] = __('messages.response.success_profile_update');
				$responseArr['data'] = ["user_address" => $user_address];
				return response()->json($responseArr, Response::HTTP_OK);
			
			case "kyc":
				$where = ['user_id'=>$user_id];
				$kyc_data['kyc_type'] = $post['kyc_type'];
				$kyc_data['card_number'] = $post['card_number'];
				if($file = $request->file('card_img')){
	                $filename   = $file->getClientOriginalName();
	                $name       = "card_img";
	                $extension  = $file->extension();
	                $filenew    =  date('d-M-Y').'_'.str_replace($filename,$name,$filename).'_'.time().''.rand(). "." .$extension;
	                $file->move(base_path('/public/uploads/user_kyc'), $filenew);
	                $kyc_data['card_img']   = asset('/uploads/user_kyc/'.$filenew);
				}
				$user_kyc = UserKyc::updateOrCreate($where, $kyc_data);
				$responseArr['status'] = true;
				$responseArr['message'] = __('messages.response.success_profile_update');;
				$responseArr['data'] = ["user_kyc" => $user_kyc];
				return response()->json($responseArr, Response::HTTP_OK);
			
			case "bank":
				$where = ['user_id'=>$user_id];
				// bank data 
				$bank_data['bank_name'] 	 = $post['bank_name'];
				$bank_data['bank_address']   = $post['bank_address'];
				$bank_data['account_number'] = $post['account_number'];
				$bank_data['account_owner']  = $post['account_owner'];
				if($file = $request->file('passbook_img')){
	                $filename   = $file->getClientOriginalName();
	                $name       = "passbook_img";
	                $extension  = $file->extension();
	                $filenew    =  date('d-M-Y').'_'.str_replace($filename,$name,$filename).'_'.time().''.rand(). "." .$extension;
	                $file->move(base_path('/public/uploads/user_bank'), $filenew);
	                $bank_data['passbook_img']   = asset('/uploads/user_bank/'.$filenew);
				}
				$user_bank = UserBank::updateOrCreate($where, $bank_data);
				$responseArr['status'] = true;
				$responseArr['message'] = __('messages.response.success_profile_update');
				$responseArr['data'] = ["user_bank" => $user_bank];
				return response()->json($responseArr, Response::HTTP_OK);

			case "business" :
				$where = ['user_id'=>$user_id];
				// dd($post);
				// business data 
				$business_data['business_name'] 	= $post['business_name'];
				$business_data['owner_name']   		= $post['owner_name'];
				$business_data['business_address'] 	= $post['business_address'];
				$business_data['gstin']  			= $post['gstin'];
				$business_data['business_contact']  = $post['business_contact'];
				$business_data['business_email']  	= $post['business_email'];
				// user business video
				if($file = $request->file('business_video_url')){
	                $filename   = $file->getClientOriginalName();
	                $name       = "business_video";
	                $extension  = $file->extension();
	                $filenew    =  date('d-M-Y').'_'.str_replace($filename,$name,$filename).'_'.time().''.rand(). "." .$extension;
	                $file->move(base_path('/public/uploads/user_image'), $filenew);
	                $business_data['business_video_url']   = asset('/uploads/user_image/'.$filenew);
				}
				// user business image
				if($file = $request->file('business_image_url')){
	                $filename   = $file->getClientOriginalName();
	                $name       = "business_img";
	                $extension  = $file->extension();
	                $filenew    =  date('d-M-Y').'_'.str_replace($filename,$name,$filename).'_'.time().''.rand(). "." .$extension;
	                $file->move(base_path('/public/uploads/user_image'), $filenew);
	                $business_data['business_image_url']   = asset('/uploads/user_image/'.$filenew);
				}
				$user_business = UserBusiness::updateOrCreate($where, $business_data);
				if($user_business){

					$files = ($request->file('business_docs')) ? $request->file('business_docs') : '';
		            if($files){
		                $img_extra = [];
		                foreach($files as $file){
		                    $row = [];
		                    $filename   = $file->getClientOriginalName();
		                    $name       = "business_doc";
		                    $extension  = $file->extension();
		                    $filenew    =  date('d-M-Y').'_'.str_replace($filename, $name, $filename).'_'.time().''.rand(). "." .$extension;
		                    $file->move(base_path('/public/uploads/user_image'), $filenew);
		                    $row['user_business_id'] = $user_business->id;
		                    $row['title']   = $filename;
		                    $row['business_doc'] = asset('/uploads/user_image/'.$filenew);
		                    $row['doc_extention']   = $extension;
		                    $row['created_at']   = date('Y-m-d H:i:s');
		                    $row['updated_at']   = date('Y-m-d H:i:s');
		                    $img_extra[] = $row;
		                }
		                // echo "<pre>";print_r($img_extra);die;
		                $new_res = UserBusinessDocs::insert($img_extra);
		            }

					$responseArr['status'] = true;
					$responseArr['message'] = __('messages.response.success_profile_update');
					$responseArr['data'] = ["user_business" => $user_business];
					return response()->json($responseArr, Response::HTTP_OK);
				}else{
					$responseArr['status'] = false;
					$responseArr['message'] = 'Something went wrong';
					return response()->json($responseArr, Response::HTTP_OK);
				}

			case "education" :
				$where = ['user_id'=>$user_id];
				// dd($post);
				// education data 
				$education_data['education_name'] 	= $post['education_name'];
				$education_data['experience']   		= $post['experience'];
				// user education degree
				if($file = $request->file('degree_image')){
	                $filename   = $file->getClientOriginalName();
	                $name       = "user_degree";
	                $extension  = $file->extension();
	                $filenew    =  date('d-M-Y').'_'.str_replace($filename,$name,$filename).'_'.time().''.rand(). "." .$extension;
	                $file->move(base_path('/public/uploads/user_image'), $filenew);
	                $education_data['degree_image']   = asset('/uploads/user_image/'.$filenew);
				}
				$user_education = UserEducation::updateOrCreate($where, $education_data);
				$responseArr['status'] = true;
				$responseArr['message'] = __('messages.response.success_profile_update');;
				$responseArr['data'] = ["user_education" => $user_education];
				return response()->json($responseArr, Response::HTTP_OK);

			default:
				echo "default!";
		}
	}

	public function provideUserRatting(Request $request){
		
		$user_ratting = new UserRatting();

		$post = $request->all();
		
		$user_ratting->user_id 	 = $post['user_id'];
		$user_ratting->ratting   = isset($post['ratting']) ? $post['ratting'] : '';
		$user_ratting->ratted_by = $post['ratted_by'];
		$res = $user_ratting->save();
		if($res){
			$user_id = $post['user_id'];
			$count = UserRatting::where('user_id', $user_id)->count();
			$sum = UserRatting::where('user_id', $user_id)->sum('ratting');
			$avg_ratting = round($sum/$count, 2);
			User::where('id', $user_id)->update(['avg_ratting'=>$avg_ratting]);
			$data = ['status' => true, 'code' => 200, 'user_ratting_id' => $user_ratting];
		}else{
			$data = ['status' => false, 'code' => 500];
		}
		return $data;
	}

	/**
	 * Store a follow and unfollow  user in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function userFollowing(Request $request){
		$post = $request->all();
		$user_follow = UserFollower::where('user_id', $post['user_id'])->where('follower_id', $post['follower_id'])->first();
		if(!$user_follow){
			$user_follow = new UserFollower();
		}
		$user_follow->user_id 		= $post['user_id'];
		$user_follow->follower_id 	= $post['follower_id'];
		$user_follow->status 		= $post['status'];
		$res = $user_follow->save();
		if($res){
			$toUser = $user_follow->user()->first();
			if(!empty($toUser)){
				$toUser->notify(new NotifyFollowingUser($user_follow));
			}
			$data = ['status' => true, 'code' => 200, 'user_follow' => $user_follow];
		}else{
			$data = ['status' => false, 'code' => 500, 'msg'=>__('messages.response.error_500')];
		}
		return $data;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function login(Request $request)
	{
		return 'login';
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
						$data = ['status' => false, 'code' => 201, 'message' => __('messages.response.error_500') ];
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
	public function updateUniqeCode(Request $request)
	{
		$user_id = $request->input('user_id');
		$user = User::find($user_id);
		if($user){
			$user_unique_code = $this->generate_app_code($user->id);
			$user->user_code = $user_unique_code;
			$user->save();
			return ['status'=>true, 'data'=>$user];
		}else{
			return ['status'=>false, 'msg'=>'failed'];
		}
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

	private function generate_app_code($application_id) { 
        $token = $this->getToken(6, $application_id);
        $code = $token . substr(strftime("%Y", time()),2);

        return $code;
    }

    private function getToken($length, $seed){    
        $token = "";
        $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $codeAlphabet.= "0123456789";

        mt_srand($seed);      // Call once. Good since $application_id is unique.

        for($i=0;$i<$length;$i++){
            $token .= $codeAlphabet[mt_rand(0,strlen($codeAlphabet)-1)];
        }
        return $token;
    }

    public function getUserNotifications(Request $request ){
    	$user = User::find($request->input('user_id'));
    	if($user){
			$notifications = $user->unreadNotifications;
			// mass update query
			// DatabaseNotification::whereIn('id', $notifications->pluck('id'))->update(['read_at' => now()]);
    		return ['status' => true, 'code' => 200, 'data' => $notifications];
    	}else{
    		return ['status' => false, 'code' => 404, 'message' => __('messages.response.error_404')];
    	}
    }
}
