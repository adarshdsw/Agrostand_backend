<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Sell;
use App\Models\SellLeadImage;
use App\Models\SellRequest;
use Illuminate\Http\Request;

// Notificarion
use App\Notifications\NotifySellLead;
use App\Notifications\NotifySellRequestToVendor;

class SellController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $perameters     = $request->all();
        // echo "<pre>"; print_r($perameters); die;
        $user_id        = $request->input('user_id');
        $category_id    = $request->input('category_id');
        $subcategory_id = $request->input('subcategory_id');
        $commodity_id   = $request->input('commodity_id');
        $offset         = $request->input('offset');
        $limit          = $request->input('limit');
        $column_name    = $request->input('column_name');
        $sort_by        = $request->input('sort_by');

        $vendors = User::with('category', 'subcategory', 'userCommodity', 'address', 'products')
                        // user should be active //user should be only business // list of user except own id
                        ->where('status', '1')->where('role_id', '!=', 1)->where('id', '!=', $user_id)
                        // filter by catagory of user
                        ->when ((isset($category_id) && $category_id !== '' && !empty($category_id) ), function ($query) use ($perameters) {
                            $query->where('category_id', $perameters['category_id']);
                        })
                        // filter by subcatagory of user
                        ->when ((isset($subcategory_id) && $subcategory_id !== '' && !empty($subcategory_id) ), function ($query) use ($perameters) {
                            $query->where('subcategory_id', $perameters['subcategory_id']);
                        })
                        // filter by commodity of user
                        ->whereHas('userCommodity', function($query) use($perameters) {
                            // if commodity not empty or null
                            $commodity_id   = isset($perameters['commodity_id']) ? $perameters['commodity_id'] : 0;
                            if(isset($commodity_id) && !empty($commodity_id)  && $commodity_id != '' && is_numeric($commodity_id) ){
                                $query->where('commodity_id', $commodity_id);
                            }
                        })
                        // filter by location of user
                        ->whereHas('address', function($query) use($perameters) {
                            $state_id    = isset($perameters['state_id']) ? $perameters['state_id'] : 0;
                            $district_id = isset($perameters['district_id']) ? $perameters['district_id'] : 0;
                            $city_id     = isset($perameters['city_id']) ? $perameters['city_id'] : 0;
                            // if filter by state id
                            if(isset($state_id) && !empty($state_id)  && $state_id != '' && is_numeric($state_id) ){
                                $query->where('state_id', $perameters['state_id']);
                            }
                            // if filter by district
                            if(isset($district_id) && !empty($district_id)  && $district_id != '' && is_numeric($district_id) ){
                                $query->where('district', $perameters['district_id']);
                            }
                            // if filter by city
                            if(isset($city_id) && !empty($city_id)  && $city_id != '' && is_numeric($district_id) ){
                                $query->where('city', $perameters['city_id']);
                            }
                        })
                        // filter by assurity like bronze, sliver, gold, platinum
                        ->when ((isset($perameters['assured_id']) && $perameters['assured_id'] !== '' && !empty($perameters['assured_id']) ), function ($query) use ($perameters) {
                            $query->where('assured_id', $perameters['assured_id']);
                        })
                        // filter by average ratting
                        ->when ((isset($perameters['avg_ratting']) && $perameters['avg_ratting'] !== '' && !empty($perameters['avg_ratting']) ), function ($query) use ($perameters) {
                            $query->where('avg_ratting', $perameters['avg_ratting']);
                        })
                        // filter by distance
                        ->when ((isset($perameters['radius']) && $perameters['radius'] !== '' && !empty($perameters['radius']) ), function ($query) use ($perameters) {
                            $coordinates['latitude']    = isset($perameters['latitude']) ? $perameters['latitude'] : '';
                            $coordinates['longitude']   = isset($perameters['longitude']) ? $perameters['longitude'] : '';
                            // if filter by user distance
                            $radius    = isset($perameters['radius']) ? $perameters['radius'] : '';
                            $query->isWithinMaxDistance($coordinates, $radius);
                        })
                        ->offset($offset)
                        ->limit($limit)
                        ->orderBy($column_name, $sort_by)
                        ->get();
        $total_count = User::with('category', 'subcategory', 'userCommodity', 'address')
                        ->where('status', '1')->where('role_id', '!=', 1)->where('id', '!=', $user_id)
                        ->when ((isset($category_id) && $category_id !== '' && !empty($category_id) ), function ($query) use ($perameters) {
                            $query->where('category_id', $perameters['category_id']);
                        })
                        ->when ((isset($subcategory_id) && $subcategory_id !== '' && !empty($subcategory_id) ), function ($query) use ($perameters) {
                            $query->where('subcategory_id', $perameters['subcategory_id']);
                        })
                        ->whereHas('userCommodity', function($query) use($perameters) {
                            $commodity_id    = isset($perameters['commodity_id']) ? $perameters['commodity_id'] : 0;
                            if(isset($commodity_id) && !empty($commodity_id)  && $commodity_id != '' && is_numeric($commodity_id) ){
                                $query->where('commodity_id', $perameters['commodity_id']);
                            }
                        })
                        ->whereHas('address', function($query) use($perameters) {
                            $state_id    = isset($perameters['state_id']) ? $perameters['state_id'] : 0;
                            $district_id = isset($perameters['district_id']) ? $perameters['district_id'] : 0;
                            $city_id     = isset($perameters['city_id']) ? $perameters['city_id'] : 0;
                            // if filter by state id
                            if(isset($state_id) && !empty($state_id)  && $state_id != '' && is_numeric($state_id) ){
                                $query->where('state_id', $perameters['state_id']);
                            }
                            // if filter by district
                            if(isset($district_id) && !empty($district_id)  && $district_id != '' && is_numeric($district_id) ){
                                $query->where('district', $perameters['district_id']);
                            }
                            // if filter by city
                            if(isset($city_id) && !empty($city_id)  && $city_id != '' && is_numeric($district_id) ){
                                $query->where('city', $perameters['city_id']);
                            }
                        })
                        ->when ((isset($perameters['assured_id']) && $perameters['assured_id'] !== '' && !empty($perameters['assured_id']) ), function ($query) use ($perameters) {
                            $query->where('assured_id', $perameters['assured_id']);
                        })
                        ->when ((isset($perameters['avg_ratting']) && $perameters['avg_ratting'] !== '' && !empty($perameters['avg_ratting']) ), function ($query) use ($perameters) {
                            $query->where('avg_ratting', $perameters['avg_ratting']);
                        })
                        ->count();
        if($vendors){
            $data = ['status' => true, 'code' => 200, 'vendors' => $vendors, 'total_count'=>$total_count];
        }else{
            $data = ['status' => false, 'code' => 500];
        }
        return $data;
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
        // dd($post);
        $sell = new Sell();
        $sell->user_id        = $post['user_id'];
        $sell->category_id    = $post['category_id'];
        $sell->subcategory_id = $post['subcategory_id'];
        $sell->commodity_id   = $post['commodity_id'];
        $sell->crop_catelog_id = ($post['crop_catelog_id']) ? $post['crop_catelog_id'] : 0;
        $sell->product_title   = ($post['product_title']) ? $post['product_title'] : '';
        $sell->product_quantity = ($post['product_quantity']) ? $post['product_quantity'] : '0';
        $sell->product_variaty  = ($post['product_variaty']) ? $post['product_variaty'] : '';
        $sell->grade           = ($post['grade']) ? $post['grade'] : '';
        $sell->unit            = ($post['unit']) ? $post['unit'] : 0;
        $sell->selling_date    = ($post['selling_date']) ? $post['selling_date'] : 0;
        $sell->sell_specification    = ($post['sell_specification']) ? $post['sell_specification'] : '';
        $sell->product_specification = ($post['product_specification']) ? $post['product_specification'] : '';
        $sell->address         = ($post['address']) ? $post['address'] : '';
        $sell->state_id        = ($post['state_id']) ? $post['state_id'] : 0;
        $sell->district_id     = ($post['district_id']) ? $post['district_id'] : 0;
        $sell->city_id         = ($post['city_id']) ? $post['city_id'] : 0;
        $sell->latitude        = ($post['latitude']) ? $post['latitude'] : '';
        $sell->longitude       = ($post['latitude']) ? $post['latitude'] : '';
        $res = $sell->save();
        // dd($res);

        if($res == 'true'){
            $files = $request->file('sell_lead_image');
            if($files){
                $img_extra = [];
                foreach($files as $file){
                    $row = [];
                    $filename   = $file->getClientOriginalName();
                    $name       = "sell_img";
                    $extension  = $file->extension();
                    $filenew    =  date('d-M-Y').'_'.str_replace($filename, $name, $filename).'_'.time().''.rand(). "." .$extension;
                    $file->move(base_path('/public/uploads/sell_img'), $filenew);
                    $row['sell_lead_id'] = $sell->id;
                    $row['title']   = $filename;
                    $row['sell_product_image'] = asset('/uploads/sell_img/'.$filenew);
                    $img_extra[] = $row;
                }
                SellLeadImage::insert($img_extra);
            }
            // list of all vendors which belongs to searched category, subcategory, commodity
            $vendors = $this->vendorList($request);
            // if vendors are not empty
            if(!empty($vendors)){
                foreach($vendors as $vendor){
                    $vendor->notify(new NotifySellLead($sell));
                }
            }
            $data = ['status' => true, 'code' => 200, 'data'=>$sell];
        }else{
            $data = ['status' => false, 'code' => 500, 'message' => "Something went wrong"];
        }
        return $data;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sell  $sell
     * @return \Illuminate\Http\Response
     */
    public function show(Sell $sell)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sell  $sell
     * @return \Illuminate\Http\Response
     */
    public function edit(Sell $sell)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sell  $sell
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sell $sell)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sell  $sell
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $selllead_id = $request->input('selllead_id');
        $selllead = Sell::find($selllead_id);
        if($selllead){
            SellLeadImage::where('sell_lead_id', $selllead->id)->delete();
            $res = $selllead->delete();
            return ['status' => true, 'code' => 200, 'message'=>__('messages.response.success_lead_delete')];
        }else{
            return ['status' => false, 'code' => 404, 'message'=>__('messages.response.error_404')];
        }
    }

    public function sellRequestVendor(Request $request){
        $perameters = $request->all();
        $sell_lead_id  = ($perameters['sell_lead_id']) ? $perameters['sell_lead_id'] : 0;
        $vendor_ids    = ($perameters['vendor_id']) ? $perameters['vendor_id'] : '';
        $vendors       = ($vendor_ids) ? explode(',', $vendor_ids) : '';
        $seller_id     = ($perameters['seller_id']) ? $perameters['seller_id'] : 0;
        $seller_type   = ($perameters['seller_type']) ? $perameters['seller_type'] : '0';
        $request_status = '0';
        if($vendors){
            $data = [];
            foreach($vendors as $vendor){
                $row = [];
                $row['sell_lead_id'] = $sell_lead_id;
                $row['vendor_id'] = $vendor;
                $row['seller_id'] = $seller_id;
                $row['seller_type'] = $seller_type;
                $row['request_status'] = $request_status;
                $row['created_at'] = date('Y-m-d H:i:s');
                $row['updated_at'] = date('Y-m-d H:i:s');
                $data[] = $row;
            }
            $res = SellRequest::insert($data);
        }
        // dd($res);
        if($res){
            $seller = User::find($seller_id);
            if(!empty($seller)){
                if($vendors){
                    $data = [];
                    foreach($vendors as $vendor){
                        $userTo = User::find($vendor);
                        if(!empty($userTo)){
                            $userTo->notify(new NotifySellRequestToVendor($seller));
                        }
                    }
                }
            }
            $data = ['status' => true, 'code' => 200, 'message'=>__('messages.response.success_sell_request')];
        }else{
            $data = ['status' => false, 'code' => 500, 'msg'=>__('messages.response.error_500')];
        }
        return $data;
    }

    public function leadList(Request $request){
        $perameters = $request->all();
        $user_id        = $request->input('user_id');
        // filter by category wise
        $category_id    = $request->input('category_id');
        $subcategory_id = $request->input('subcategory_id');
        $commodity_id   = $request->input('commodity_id');
        // filter by location wise
        $state_id       = $request->input('state_id');
        $district_id    = $request->input('district_id');
        $city_id        = $request->input('city_id');

        $offset         = $request->input('offset');
        $limit          = $request->input('limit');
        $column_name    = $request->input('column_name');
        $sort_by        = $request->input('sort_by');

        $search_str     = ($request->input('product_title')) ? trim($request->input('product_title')) : '';
        /*if($search_str){
            $search_str = str_replace(" ", "|", $search_str);
        }*/
        
        $selllead_list = Sell::with(['user', 'category', 'sellImages'])
                            ->when (($search_str !== '' && !empty($search_str) ), function ($query) use ($perameters) {
                                $query->where('product_title', 'like', '%'.$perameters['product_title'].'%');
                            })
                            ->when (($category_id !== '' && !empty($category_id) ), function ($query) use ($perameters) {
                                $query->where('category_id', $perameters['category_id']);
                            })
                            ->when (($subcategory_id !== '' && !empty($subcategory_id) ), function ($query) use ($perameters) {
                                $query->where('subcategory_id', $perameters['subcategory_id']);
                            })
                            ->when (($commodity_id !== '' && !empty($commodity_id) ), function ($query) use ($perameters) {
                                $query->where('commodity_id', $perameters['commodity_id']);
                            })
                            ->when ((isset($perameters['state_id']) && $perameters['state_id'] !== '' && !empty($perameters['state_id']) ), function ($query) use ($perameters) {
                                $query->where('state_id', $perameters['state_id']);
                            })
                            ->when ((isset($perameters['district_id']) && $perameters['district_id'] !== '' && !empty($perameters['district_id']) ), function ($query) use ($perameters) {
                                $query->where('district_id', $perameters['district_id']);
                            })
                            ->when ((isset($perameters['city_id']) && $perameters['city_id'] !== '' && !empty($perameters['city_id']) ), function ($query) use ($perameters) {
                                $query->where('city_id', $perameters['city_id']);
                            })
                            /*->when ((isset($perameters['assured_id']) && $perameters['assured_id'] !== '' && !empty($perameters['assured_id']) ), function ($query) use ($perameters) {
                                $query->whereHas('user', function($query) use ($perameters){
                                    $query->where('assured_id', $perameters['assured_id']);
                                });
                            })*/
                            ->whereHas('user', function($query) use ($perameters){
                                if( isset($perameters['assured_id']) && $perameters['assured_id'] !== '' && !empty($perameters['assured_id']) ){
                                    $query->where('assured_id', $perameters['assured_id']);
                                }
                                if( isset($perameters['avg_ratting']) && $perameters['avg_ratting'] !== '' && !empty($perameters['avg_ratting']) ){
                                    $query->where('avg_ratting', $perameters['avg_ratting']);
                                }
                                $coordinates['latitude']    = isset($perameters['latitude']) ? $perameters['latitude'] : 0;
                                $coordinates['longitude']   = isset($perameters['longitude']) ? $perameters['longitude'] : 0;
                                $radius    = isset($perameters['radius']) ? $perameters['radius'] : '';
                                // if filter by user distance
                                if(isset($radius) && !empty($radius)  && $radius != '' ){
                                    $query->isWithinMaxDistance($coordinates, $radius);
                                }
                            })
                            ->where('user_id', '!=', $user_id)
                            ->orderBy($column_name, $sort_by)
                            ->offset($offset)
                            ->limit($limit)
                            ->get();
        
        $buylead_count = Sell::with(['user'])
                            ->when (($search_str !== '' && !empty($search_str) ), function ($query) use ($perameters) {
                                $query->where('product_title', 'like', '%'.$perameters['product_title'].'%');
                            })
                            ->when (($category_id !== '' && !empty($category_id) ), function ($query) use ($perameters) {
                                $query->where('category_id', $perameters['category_id']);
                            })
                            ->when (($subcategory_id !== '' && !empty($subcategory_id) ), function ($query) use ($perameters) {
                                $query->where('subcategory_id', $perameters['subcategory_id']);
                            })
                            ->when (($commodity_id !== '' && !empty($commodity_id) ), function ($query) use ($perameters) {
                                $query->where('commodity_id', $perameters['commodity_id']);
                            })
                            ->when ((isset($perameters['state_id']) && $perameters['state_id'] !== '' && !empty($perameters['state_id']) ), function ($query) use ($perameters) {
                                $query->where('state_id', $perameters['state_id']);
                            })
                            ->when ((isset($perameters['district_id']) && $perameters['district_id'] !== '' && !empty($perameters['district_id']) ), function ($query) use ($perameters) {
                                $query->where('district_id', $perameters['district_id']);
                            })
                            ->when ((isset($perameters['city_id']) && $perameters['city_id'] !== '' && !empty($perameters['city_id']) ), function ($query) use ($perameters) {
                                $query->where('city_id', $perameters['city_id']);
                            })
                            ->whereHas('user', function($query) use ($perameters){
                                if( isset($perameters['assured_id']) && $perameters['assured_id'] !== '' && !empty($perameters['assured_id']) ){
                                    $query->where('assured_id', $perameters['assured_id']);
                                }
                                if( isset($perameters['avg_ratting']) && $perameters['avg_ratting'] !== '' && !empty($perameters['avg_ratting']) ){
                                    $query->where('avg_ratting', $perameters['avg_ratting']);
                                }
                                $coordinates['latitude']    = isset($perameters['latitude']) ? $perameters['latitude'] : 0;
                                $coordinates['longitude']   = isset($perameters['longitude']) ? $perameters['longitude'] : 0;
                                $radius    = isset($perameters['radius']) ? $perameters['radius'] : '';
                                // if filter by user distance
                                if(isset($radius) && !empty($radius)  && $radius != '' ){
                                    $query->isWithinMaxDistance($coordinates, $radius);
                                }
                            })
                            ->where('user_id', '!=', $user_id)
                            ->count();
        if(!empty($selllead_list)){
            $data = ['status' => true, 'code' => 200, 'data'=>$selllead_list, 'total_count'=>$buylead_count];
        }else{
            $data = ['status' => false, 'code' => 404, 'message' => "data not found"];
        }
        return $data;
    }

    public function leadShow($lead_id){
        if(!empty($lead_id) && $lead_id!='' && is_numeric($lead_id) ){
            $sell = Sell::with(['user', 'category', 'psubcategory','commodity','city','state','district', 'sellImages'])->where('id', $lead_id)->first();
            if($sell){
                return ['status' => true, 'code' => 200, 'data'=>$sell];
            }else{
                return ['status' => false, 'code' => 404, 'message' => __('messages.response.error_404')];
            }
        }
    }    

    public function sellRequestList(Request $request){
        $seller_id      = $request->input('seller_id');
        $request_type   = $request->input('request_type');
        $vendor_id      = $request->input('vendor_id');
        // seller type 1 = former | 2 = business
        if($request_type == 'sender'){
            $sell_requests = SellRequest::with(['sellLead', 'vandor'])->where('seller_id', $seller_id)->get();
            $total_count = SellRequest::where('seller_id', $seller_id)->count();
        }else{
            $sell_requests = SellRequest::with(['sellLead', 'seller'])->where('vendor_id', $vendor_id)->get();
            $total_count = SellRequest::where('vendor_id', $vendor_id)->count();
        }
        if($sell_requests){
            $data = ['status' => true, 'code' => 200, 'data'=>$sell_requests, 'total_count'=>$total_count];
        }else{
            $data = ['status' => false, 'code' => 404, 'message' => "data not found"];
        }
        return $data;
    }

    public function sellRequestDetail(Request $request){
        $sell_request_id  = $request->input('sell_request_id');
        $request_type   = $request->input('request_type');
        if($request_type == 'sender'){
            $sell_requests = SellRequest::with(['sellLead', 'vandor'])->where('id', $sell_request_id)->first();
        }else{
            $sell_requests = SellRequest::with(['sellLead', 'seller'])->where('id', $sell_request_id)->first();
        }
        if($sell_requests){
            $data = ['status' => true, 'code' => 200, 'data'=>$sell_requests];
        }else{
            $data = ['status' => false, 'code' => 404, 'message' => "data not found"];
        }
        return $data;
    }

    public function vendorList(Request $request){
        $post = $request->all();
        // echo "<pre>"; print_r($post);die;
        $perameters     = $post;
        $user_id        = $post['user_id'];
        $category_id    = $post['category_id'];
        $subcategory_id = $post['subcategory_id'];
        $commodity_id   = $post['commodity_id'];

        $vendors = User::with('userCommodity')
                        ->where('status', '1')->where('id', '!=', $user_id)
                        ->when ((isset($category_id) && $category_id !== '' && !empty($category_id) ), function ($query) use ($perameters) {
                            $query->where('category_id', $perameters['category_id']);
                        })
                        ->when ((isset($subcategory_id) && $subcategory_id !== '' && !empty($subcategory_id) ), function ($query) use ($perameters) {
                            $query->where('subcategory_id', $perameters['subcategory_id']);
                        })
                        ->whereHas('userCommodity', function($query) use($perameters) {
                            $commodity_id    = isset($perameters['commodity_id']) ? $perameters['commodity_id'] : 0;
                            if(isset($commodity_id) && !empty($commodity_id)  && $commodity_id != '' && is_numeric($commodity_id) ){
                                $query->where('commodity_id', $commodity_id);
                            }
                        })
                        ->get();
        if(!empty($vendors)){
            return $vendors;
        }else{
            return false;
        }
    }
}
