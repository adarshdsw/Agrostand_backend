<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Sell;
use App\Models\SellLeadImage;
use App\Models\SellRequest;
use Illuminate\Http\Request;

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
        $category_id    = $request->input('category_id');
        $subcategory_id = $request->input('subcategory_id');
        $commodity_id   = $request->input('commodity_id');
        $offset         = $request->input('offset');
        $limit          = $request->input('limit');
        $column_name    = $request->input('column_name');
        $sort_by        = $request->input('sort_by');

        $vendors = User::with('category', 'subcategory', 'commodity')
                        ->where('status', '1')->where('role_id', '!=', 1)
                        ->when ((isset($category_id) && $category_id !== '' && !empty($category_id) ), function ($query) use ($perameters) {
                            $query->where('category_id', $perameters['category_id']);
                        })
                        ->when ((isset($subcategory_id) && $subcategory_id !== '' && !empty($subcategory_id) ), function ($query) use ($perameters) {
                            $query->where('subcategory_id', $perameters['subcategory_id']);
                        })
                        ->when ((isset($commodity_id) && $commodity_id !== '' && !empty($commodity_id) ), function ($query) use ($perameters) {
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
                        ->when ((isset($perameters['assured_id']) && $perameters['assured_id'] !== '' && !empty($perameters['assured_id']) ), function ($query) use ($perameters) {
                            $query->where('assured_id', $perameters['assured_id']);
                        })
                        ->offset($offset)
                        ->limit($limit)
                        ->orderBy($column_name, $sort_by)
                        ->get();
        $total_count = User::with('category', 'subcategory', 'commodity')
                        ->where('status', '1')->where('role_id', '!=', 1)
                        ->when ((isset($category_id) && $category_id !== '' && !empty($category_id) ), function ($query) use ($perameters) {
                            $query->where('category_id', $perameters['category_id']);
                        })
                        ->when ((isset($subcategory_id) && $subcategory_id !== '' && !empty($subcategory_id) ), function ($query) use ($perameters) {
                            $query->where('subcategory_id', $perameters['subcategory_id']);
                        })
                        ->when ((isset($commodity_id) && $commodity_id !== '' && !empty($commodity_id) ), function ($query) use ($perameters) {
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
                        ->when ((isset($perameters['assured_id']) && $perameters['assured_id'] !== '' && !empty($perameters['assured_id']) ), function ($query) use ($perameters) {
                            $query->where('assured_id', $perameters['assured_id']);
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
        // dd($sell);
        $res = $sell->save();

        if($res){
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
    public function destroy(Sell $sell)
    {
        //
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
            $data = ['status' => true, 'code' => 200];
        }else{
            $data = ['status' => false, 'code' => 500, 'msg'=>'Something went wrong'];
        }
        return $data;
    }

    public function leadList(Request $request){
        $perameters = $request->all();
        // dd($perameters);
        $user_id        = $request->input('user_id');
        $category_id    = $request->input('category_id');
        $subcategory_id = $request->input('subcategory_id');
        $commodity_id   = $request->input('commodity_id');
        $offset         = $request->input('offset');
        $limit          = $request->input('limit');
        $column_name    = $request->input('column_name');
        $sort_by        = $request->input('sort_by');
        
        $selllead_list = Sell::with(['user', 'category', 'sellImages'])
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
                            ->when ((isset($perameters['assured_id']) && $perameters['assured_id'] !== '' && !empty($perameters['assured_id']) ), function ($query) use ($perameters) {
                                $query->whereHas('user', function($query) use ($perameters){
                                    $query->where('assured_id', $perameters['assured_id']);
                                });
                            })
                            ->where('user_id', '!=', $user_id)
                            ->orderBy($column_name, $sort_by)
                            ->offset($offset)
                            ->limit($limit)
                            ->get();
        
        $buylead_count = Sell::with(['user'])
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
                            ->when ((isset($perameters['assured_id']) && $perameters['assured_id'] !== '' && !empty($perameters['assured_id']) ), function ($query) use ($perameters) {
                                $query->whereHas('user', function($query) use ($perameters){
                                    $query->where('assured_id', $perameters['assured_id']);
                                });
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
}
