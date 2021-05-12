<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Buy;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

// Notificarion
use App\Notifications\NotifyBuyLead;

class BuyController extends Controller
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
        $search_str     = ($request->input('search_str')) ? trim($request->input('search_str')) : '';
        // echo $search_str;die;
        $search_title   = $search_str;
        if($search_str){
            $search_str = str_replace(" ", "|", $search_str);
        }
        // $search_str = 'Pesticide for Rice|product|service';
        $products = Product::with(['offer','price','user','category','brand','group', 'city', 'district', 'state'])
                        ->when ((isset($category_id) && $category_id !== '' && !empty($category_id) ), function ($query) use ($perameters) {
                            $query->where('category_id', $perameters['category_id']);
                        })
                        ->when ((isset($subcategory_id) && $subcategory_id !== '' && !empty($subcategory_id) ), function ($query) use ($perameters) {
                            $query->where('subcategory_id', $perameters['subcategory_id']);
                        })
                        ->when ((isset($commodity_id) && $commodity_id !== '' && !empty($commodity_id) ), function ($query) use ($perameters) {
                            $query->where('commodity_id', $perameters['commodity_id']);
                        })
                        ->orWhere('title', 'like', '%'.$search_title.'%')
                        
                        ->orWhere('product_tags', 'regexp', '(^|,)('.$search_str.')(,|$)')

                        ->when ((isset($perameters['state_id']) && $perameters['state_id'] !== '' && !empty($perameters['state_id']) ), function ($query) use ($perameters) {
                            $query->where('state_id', $perameters['state_id']);
                        })
                        ->when ((isset($perameters['district_id']) && $perameters['district_id'] !== '' && !empty($perameters['district_id']) ), function ($query) use ($perameters) {
                            $query->where('district_id', $perameters['district_id']);
                        })
                        ->when ((isset($perameters['city_id']) && $perameters['city_id'] !== '' && !empty($perameters['city_id']) ), function ($query) use ($perameters) {
                            $query->where('city_id', $perameters['city_id']);
                        })
                        ->when ((isset($perameters['brand_id']) && $perameters['brand_id'] !== '' && !empty($perameters['brand_id']) ), function ($query) use ($perameters) {
                            $query->where('brand_id', $perameters['brand_id']);
                        })
                        /*->when (( (isset($perameters['min_price']) && $perameters['min_price'] !== '' && !empty($perameters['min_price'])) && (isset($perameters['max_price']) && $perameters['max_price'] !== '' && !empty($perameters['max_price'])) ), function ($query) use ($perameters) {
                            $query->whereHas('price', function($query) use ($perameters){
                                $query->whereBetween('approx_price', [$perameters['min_price'], $perameters['max_price']]);
                            });
                        })*/
                        ->whereHas('price', function($query) use($perameters) {
                            // get approx price of prodiuct between min and max price
                            if( (isset($perameters['min_price']) && $perameters['min_price'] !== '' && !empty($perameters['min_price'])) && (isset($perameters['max_price']) && $perameters['max_price'] !== '' && !empty($perameters['max_price'])) ){
                                $query->whereBetween('approx_price', [$perameters['min_price'], $perameters['max_price']]);
                            }
                            $update_rate_date    = isset($perameters['update_rate_date']) ? $perameters['update_rate_date'] : '';
                            if(isset($update_rate_date) && !empty($update_rate_date)  && $update_rate_date != '' ){
                                $query->where('last_update', $perameters['update_rate_date']);
                            }
                        })
                        ->whereHas('user', function($query) use($perameters) {
                            $assured_id    = isset($perameters['assured_id']) ? $perameters['assured_id'] : 0;
                            // if filter by assured id
                            if(isset($assured_id) && !empty($assured_id)  && $assured_id != '' && is_numeric($assured_id) ){
                                $query->where('assured_id', $perameters['assured_id']);
                            }
                            $avg_ratting    = isset($perameters['avg_ratting']) ? $perameters['avg_ratting'] : 0;
                            // if filter by avg ratting
                            if(isset($avg_ratting) && !empty($avg_ratting)  && $avg_ratting != '' ){
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
                        ->offset($offset)
                        ->limit($limit)
                        ->orderBy($column_name, $sort_by)
                        ->get();

        // get total count
        $total_count = Product::with(['offer', 'price', 'user'])
                        ->when ((isset($category_id) && $category_id !== '' && !empty($category_id) ), function ($query) use ($perameters) {
                            $query->where('category_id', $perameters['category_id']);
                        })
                        ->when ((isset($subcategory_id) && $subcategory_id !== '' && !empty($subcategory_id) ), function ($query) use ($perameters) {
                            $query->where('subcategory_id', $perameters['subcategory_id']);
                        })
                        ->when ((isset($commodity_id) && $commodity_id !== '' && !empty($commodity_id) ), function ($query) use ($perameters) {
                            $query->where('commodity_id', $perameters['commodity_id']);
                        })
                        
                        ->orWhere('title', 'like', '%'.$search_title.'%')
                        
                        ->orWhere('product_tags', 'regexp', '(^|,)('.$search_str.')(,|$)')

                        ->when ((isset($perameters['brand_id']) && $perameters['brand_id'] !== '' && !empty($perameters['brand_id']) ), function ($query) use ($perameters) {
                            $query->where('brand_id', $perameters['brand_id']);
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

                        ->whereHas('price', function($query) use($perameters) {
                            // get approx price of prodiuct between min and max price
                            if( (isset($perameters['min_price']) && $perameters['min_price'] !== '' && !empty($perameters['min_price'])) && (isset($perameters['max_price']) && $perameters['max_price'] !== '' && !empty($perameters['max_price'])) ){
                                $query->whereBetween('approx_price', [$perameters['min_price'], $perameters['max_price']]);
                            }
                            $update_rate_date    = isset($perameters['update_rate_date']) ? $perameters['update_rate_date'] : '';
                            if(isset($update_rate_date) && !empty($update_rate_date)  && $update_rate_date != '' ){
                                $query->where('last_update', $perameters['update_rate_date']);
                            }
                        })
                        
                        ->whereHas('user', function($query) use($perameters) {
                            $assured_id    = isset($perameters['assured_id']) ? $perameters['assured_id'] : 0;
                            // if filter by assured id
                            if(isset($assured_id) && !empty($assured_id)  && $assured_id != '' && is_numeric($assured_id) ){
                                $query->where('assured_id', $perameters['assured_id']);
                            }
                            $avg_ratting    = isset($perameters['avg_ratting']) ? $perameters['avg_ratting'] : 0;
                            // if filter by avg ratting
                            if(isset($avg_ratting) && !empty($avg_ratting)  && $avg_ratting != '' ){
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
                        ->count();
        
        // $total_count = Product::where('product_tags', 'regexp', '(^|,)('.$search_str.')(,|$)')->count();
        
        if($products){
            $data = ['status' => true, 'code' => 200, 'products' => $products, 'total_count'=>$total_count];
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
        $buy = new Buy();
        $buy->user_id        = $post['user_id'];
        $buy->category_id    = ($post['category_id']) ? $post['category_id'] : 0;
        $buy->subcategory_id = ($post['subcategory_id']) ? $post['subcategory_id'] : 0;
        $buy->commodity_id   = ($post['commodity_id']) ? $post['commodity_id'] : 0;
        $buy->product_title  = ($post['product_title']) ? $post['product_title'] : '';
        $buy->qty            = ($post['qty']) ? $post['qty'] : 0;
        $buy->size           = ($post['size']) ? $post['size'] : 0;
        $buy->package_unit      = ($post['package_unit']) ? $post['package_unit'] : 0;
        $buy->buy_specification = ($post['buy_specification']) ? $post['buy_specification'] : '';
        $buy->min_price         = ($post['min_price']) ? $post['min_price'] : 0;
        $buy->max_price         = ($post['max_price']) ? $post['max_price'] : 0;
        $buy->product_specification = ($post['product_specification']) ? $post['product_specification'] : '';
        $buy->address           = ($post['address']) ? $post['address'] : '';
        $buy->state_id          = ($post['state_id']) ? $post['state_id'] : 0;
        $buy->district_id       = ($post['district_id']) ? $post['district_id'] : 0;
        $buy->city_id           = ($post['city_id']) ? $post['city_id'] : 0;
        $buy->location          = ($post['location']) ? $post['location'] : '';
        $buy->latitude          = ($post['latitude']) ? $post['latitude'] : '';
        $buy->longitude         = ($post['latitude']) ? $post['latitude'] : '';

        $res = $buy->save();

        if($res){
            // list of all vendors which belongs to searched category, subcategory, commodity
            $vendors = $this->vendorList($request);
            // if vendors are not empty
            if(!empty($vendors)){
                /*foreach($vendors as $vendor){
                    $vendor->notify(new NotifyBuyLead($buy));
                }*/
            }
            $data = ['status' => true, 'code' => 200, 'data'=>$buy];
        }else{
            $data = ['status' => false, 'code' => 500, 'message' => "Something went wrong"];
        }
        return $data;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Buy  $buy
     * @return \Illuminate\Http\Response
     */
    public function show(Buy $buy)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Buy  $buy
     * @return \Illuminate\Http\Response
     */
    public function edit(Buy $buy)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Buy  $buy
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Buy $buy)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Buy  $buy
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $buylead_id = $request->input('buylead_id');
        $buylead = Buy::find($buylead_id);
        if($buylead){
            $res = $buylead->delete();
            return ['status' => true, 'code' => 200, 'message'=>__('messages.response.success_lead_delete')];
        }else{
            return ['status' => false, 'code' => 404, 'message'=>__('messages.response.error_404')];
        }
    }

    public function leadList(Request $request){
        $perameters = $request->all();
        // dd($perameters);
        // catagory wise
        $category_id    = $request->input('category_id');
        $subcategory_id = $request->input('subcategory_id');
        $commodity_id   = $request->input('commodity_id');
        // location wise
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
        }
        $perameters['search_str'] = $search_str;*/
        
        $buylead_list = Buy::with(['user', 'category'])
                            ->when (($search_str !== '' && !empty($search_str) ), function ($query) use ($perameters) {
                                $query->where('product_title', 'like', '%'.$perameters['product_title'].'%');
                            })
                            // catagory wise
                            ->when (($category_id !== '' && !empty($category_id) ), function ($query) use ($perameters) {
                                $query->where('category_id', $perameters['category_id']);
                            })
                            ->when (($subcategory_id !== '' && !empty($subcategory_id) ), function ($query) use ($perameters) {
                                $query->where('subcategory_id', $perameters['subcategory_id']);
                            })
                            ->when (($commodity_id !== '' && !empty($commodity_id) ), function ($query) use ($perameters) {
                                $query->where('commodity_id', $perameters['commodity_id']);
                            })
                            // location wise
                            ->when ((isset($perameters['state_id']) && $perameters['state_id'] !== '' && !empty($perameters['state_id']) ), function ($query) use ($perameters) {
                                $query->where('state_id', $perameters['state_id']);
                            })
                            ->when ((isset($perameters['district_id']) && $perameters['district_id'] !== '' && !empty($perameters['district_id']) ), function ($query) use ($perameters) {
                                $query->where('district_id', $perameters['district_id']);
                            })
                            ->when ((isset($perameters['city_id']) && $perameters['city_id'] !== '' && !empty($perameters['city_id']) ), function ($query) use ($perameters) {
                                $query->where('city_id', $perameters['city_id']);
                            })
                            /*->when (( ($perameters['min_price'] !== '' && !empty($perameters['min_price'])) && ($perameters['max_price'] !== '' && !empty($perameters['max_price'])) ), function ($query) use ($perameters) {
                                $query->whereBetween('approx_price', [$perameters['min_price'], $perameters['max_price']]);
                            })*/
                            ->when ((isset($perameters['min_price']) && $perameters['min_price'] !== '' && !empty($perameters['min_price']) ), function ($query) use ($perameters) {
                                $query->where('min_price', '<=', $perameters['min_price']);
                            })
                            ->when ((isset($perameters['max_price']) && $perameters['max_price'] !== '' && !empty($perameters['max_price']) ), function ($query) use ($perameters) {
                                $query->where('max_price', '>=', $perameters['max_price']);
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
                            /*->when ((isset($perameters['assured_id']) && $perameters['assured_id'] !== '' && !empty($perameters['assured_id']) ), function ($query) use ($perameters) {
                                $query->whereHas('user', function($query) use ($perameters){
                                    $query->where('assured_id', $perameters['assured_id']);
                                });
                            })*/
                            ->orderBy($column_name, $sort_by)
                            ->offset($offset)
                            ->limit($limit)
                            ->get();
        
        $buylead_count = Buy::with(['user'])
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
                            /*->when (( ($perameters['min_price'] !== '' && !empty($perameters['min_price'])) && ($perameters['max_price'] !== '' && !empty($perameters['max_price'])) ), function ($query) use ($perameters) {
                                $query->whereBetween('approx_price', [$perameters['min_price'], $perameters['max_price']]);
                            })*/
                            ->when ((isset($perameters['min_price']) && $perameters['min_price'] !== '' && !empty($perameters['min_price']) ), function ($query) use ($perameters) {
                                $query->where('min_price', '<=', $perameters['min_price']);
                            })
                            ->when ((isset($perameters['max_price']) && $perameters['max_price'] !== '' && !empty($perameters['max_price']) ), function ($query) use ($perameters) {
                                $query->where('max_price', '>=', $perameters['max_price']);
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
                            ->count();
        if(!empty($buylead_list)){
            $data = ['status' => true, 'code' => 200, 'data'=>$buylead_list, 'total_count'=>$buylead_count];
        }else{
            $data = ['status' => false, 'code' => 404, 'message' => __('messages.response.error_404')];
        }
        return $data;
    }

    public function leadShow($lead_id){
        if(!empty($lead_id) && $lead_id!='' && is_numeric($lead_id) ){
            $buy = Buy::with(['user','category','psubcategory','commodity','city','state','district'])->where('id', $lead_id)->first();
            if($buy){
                return ['status' => true, 'code' => 200, 'data'=>$buy];
            }else{
                return ['status' => false, 'code' => 404, 'message' => __('messages.response.error_404')];
            }
        }
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
