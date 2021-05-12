<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Agronomist;
use App\Models\AgronomistLeadImage;
use Illuminate\Http\Request;
use App\Models\AgronomistService;
use App\Models\AgronomistServiceImage;
use App\Models\AgronomistServiceOffer;

class AgronomistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $perameters     = $request->all();
        // perameter for category filter
        $category_id    = $request->input('category_id');
        $subcategory_id = $request->input('subcategory_id');
        $commodity_id   = $request->input('commodity_id');
        // perameters for location filter
        $state_id       = $request->input('state_id');
        $district_id    = $request->input('district_id');
        $city_id        = $request->input('city_id');

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
        $products = AgronomistService::with(['offer', 'user', 'category', 'images'])
                        // filter category wise
                        ->when ((isset($category_id) && $category_id !== '' && !empty($category_id) ), function ($query) use ($perameters) {
                            $query->where('category_id', $perameters['category_id']);
                        })
                        ->when ((isset($subcategory_id) && $subcategory_id !== '' && !empty($subcategory_id) ), function ($query) use ($perameters) {
                            $query->where('subcategory_id', $perameters['subcategory_id']);
                        })
                        ->when ((isset($commodity_id) && $commodity_id !== '' && !empty($commodity_id) ), function ($query) use ($perameters) {
                            $query->where('commodity_id', $perameters['commodity_id']);
                        })
                        // search by title
                        ->orWhere('service_name', 'like', '%'.$search_title.'%')
                        // search by service tags
                        ->orWhere('service_tags', 'regexp', '(^|,)('.$search_str.')(,|$)')

                        // filter location wise
                        ->when ((isset($perameters['state_id']) && $perameters['state_id'] !== '' && !empty($perameters['state_id']) ), function ($query) use ($perameters) {
                            $query->where('state_id', $perameters['state_id']);
                        })
                        ->when ((isset($perameters['district_id']) && $perameters['district_id'] !== '' && !empty($perameters['district_id']) ), function ($query) use ($perameters) {
                            $query->where('district_id', $perameters['district_id']);
                        })
                        ->when ((isset($perameters['city_id']) && $perameters['city_id'] !== '' && !empty($perameters['city_id']) ), function ($query) use ($perameters) {
                            $query->where('city_id', $perameters['city_id']);
                        })
                        // minimum fees
                        ->when ((isset($perameters['min_fees']) && $perameters['min_fees'] !== '' && !empty($perameters['min_fees']) ), function ($query) use ($perameters) {
                                $query->where('fees', '<=', $perameters['min_fees']);
                            })
                        ->when ((isset($perameters['max_fees']) && $perameters['max_fees'] !== '' && !empty($perameters['max_fees']) ), function ($query) use ($perameters) {
                            $query->where('fees', '>=', $perameters['max_fees']);
                        })
                        ->when ((isset($perameters['is_offer']) && $perameters['is_offer'] !== '' && !empty($perameters['is_offer']) ), function ($query) use ($perameters) {
                            $query->where('is_offer', $perameters['is_offer']);
                        })
                        /*->when ((isset($perameters['assured_id']) && $perameters['assured_id'] !== '' && !empty($perameters['assured_id']) ), function ($query) use ($perameters) {
                            $query->whereHas('user', function($query) use ($perameters){
                                $query->where('assured_id', $perameters['assured_id']);
                            });
                        })*/
                        ->whereHas('user', function($query) use ($perameters){
                            // filter by assurity like silver, gold
                            if( isset($perameters['assured_id']) && $perameters['assured_id'] !== '' && !empty($perameters['assured_id']) ){
                                $query->where('assured_id', $perameters['assured_id']);
                            }
                            // filter by average ratting
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
                        ->offset($offset)
                        ->limit($limit)
                        ->orderBy($column_name, $sort_by)
                        ->get();

        // get total count
        $total_count = AgronomistService::with(['offer', 'user'])
                        ->when ((isset($category_id) && $category_id !== '' && !empty($category_id) ), function ($query) use ($perameters) {
                            $query->where('category_id', $perameters['category_id']);
                        })
                        ->when ((isset($subcategory_id) && $subcategory_id !== '' && !empty($subcategory_id) ), function ($query) use ($perameters) {
                            $query->where('subcategory_id', $perameters['subcategory_id']);
                        })
                        ->when ((isset($commodity_id) && $commodity_id !== '' && !empty($commodity_id) ), function ($query) use ($perameters) {
                            $query->where('commodity_id', $perameters['commodity_id']);
                        })
                        // search by title
                        ->orWhere('service_name', 'like', '%'.$search_title.'%')
                        // search by service tags
                        ->orWhere('service_tags', 'regexp', '(^|,)('.$search_str.')(,|$)')
                        // filter by location
                        ->when ((isset($perameters['state_id']) && $perameters['state_id'] !== '' && !empty($perameters['state_id']) ), function ($query) use ($perameters) {
                            $query->where('state_id', $perameters['state_id']);
                        })
                        ->when ((isset($perameters['district_id']) && $perameters['district_id'] !== '' && !empty($perameters['district_id']) ), function ($query) use ($perameters) {
                            $query->where('district_id', $perameters['district_id']);
                        })
                        ->when ((isset($perameters['city_id']) && $perameters['city_id'] !== '' && !empty($perameters['city_id']) ), function ($query) use ($perameters) {
                            $query->where('city_id', $perameters['city_id']);
                        })
                        ->when ((isset($perameters['min_fees']) && $perameters['min_fees'] !== '' && !empty($perameters['min_fees']) ), function ($query) use ($perameters) {
                                $query->where('fees', '<=', $perameters['min_fees']);
                            })
                        ->when ((isset($perameters['max_fees']) && $perameters['max_fees'] !== '' && !empty($perameters['max_fees']) ), function ($query) use ($perameters) {
                            $query->where('fees', '>=', $perameters['max_fees']);
                        })
                        ->when ((isset($perameters['is_offer']) && $perameters['is_offer'] !== '' && !empty($perameters['is_offer']) ), function ($query) use ($perameters) {
                            $query->where('is_offer', $perameters['is_offer']);
                        })
                        ->whereHas('user', function($query) use ($perameters){
                            // filter by assurity like silver, gold
                            if( isset($perameters['assured_id']) && $perameters['assured_id'] !== '' && !empty($perameters['assured_id']) ){
                                $query->where('assured_id', $perameters['assured_id']);
                            }
                            // filter by average ratting
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
        
        // $total_count = Product::where('product_tags', 'regexp', '(^|,)('.$search_str.')(,|$)')->count();
        
        if($products){
            $data = ['status' => true, 'code' => 200, 'products' => $products, 'total_count'=>$total_count];
        }else{
            $data = ['status' => false, 'code' => 500];
        }
        return $data;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function agroLeadIndex(Request $request)
    {
        $perameters     = $request->all();
        // perameter for category filter
        $category_id    = $request->input('category_id');
        $subcategory_id = $request->input('subcategory_id');
        $commodity_id   = $request->input('commodity_id');
        // perameters for location filter

        $offset         = $request->input('offset');
        $limit          = $request->input('limit');
        $column_name    = $request->input('column_name');
        $sort_by        = $request->input('sort_by');

        $search_str     = ($request->input('search_str')) ? trim($request->input('search_str')) : '';
        // echo $search_str;die;
        $search_title   = $search_str;
        /*if($search_str){
            $search_str = str_replace(" ", "|", $search_str);
        }*/
        // $search_str = 'Pesticide for Rice|product|service';
        $products = Agronomist::with(['user', 'category', 'psubcategory', 'commodity', 'leadImages'])
                        // filter category wise
                        ->when ((isset($category_id) && $category_id !== '' && !empty($category_id) ), function ($query) use ($perameters) {
                            $query->where('category_id', $perameters['category_id']);
                        })
                        ->when ((isset($subcategory_id) && $subcategory_id !== '' && !empty($subcategory_id) ), function ($query) use ($perameters) {
                            $query->where('subcategory_id', $perameters['subcategory_id']);
                        })
                        ->when ((isset($commodity_id) && $commodity_id !== '' && !empty($commodity_id) ), function ($query) use ($perameters) {
                            $query->where('commodity_id', $perameters['commodity_id']);
                        })
                        // search by title
                        ->orWhere('plant_variety', 'like', '%'.$search_title.'%')
                        // filter by user
                        ->whereHas('user', function($query) use ($perameters){
                            // filter by assurity like silver, gold
                            if( isset($perameters['assured_id']) && $perameters['assured_id'] !== '' && !empty($perameters['assured_id']) ){
                                $query->where('assured_id', $perameters['assured_id']);
                            }
                            // filter by average ratting
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
                        ->offset($offset)
                        ->limit($limit)
                        ->orderBy($column_name, $sort_by)
                        ->get();

        // get total count
        $total_count = Agronomist::with(['user'])
                        ->when ((isset($category_id) && $category_id !== '' && !empty($category_id) ), function ($query) use ($perameters) {
                            $query->where('category_id', $perameters['category_id']);
                        })
                        ->when ((isset($subcategory_id) && $subcategory_id !== '' && !empty($subcategory_id) ), function ($query) use ($perameters) {
                            $query->where('subcategory_id', $perameters['subcategory_id']);
                        })
                        ->when ((isset($commodity_id) && $commodity_id !== '' && !empty($commodity_id) ), function ($query) use ($perameters) {
                            $query->where('commodity_id', $perameters['commodity_id']);
                        })
                        // search by title
                        ->orWhere('plant_variety', 'like', '%'.$search_title.'%')
                        // filter by user
                        ->whereHas('user', function($query) use ($perameters){
                            // filter by assurity like silver, gold
                            if( isset($perameters['assured_id']) && $perameters['assured_id'] !== '' && !empty($perameters['assured_id']) ){
                                $query->where('assured_id', $perameters['assured_id']);
                            }
                            // filter by average ratting
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
        
        // $total_count = Product::where('product_tags', 'regexp', '(^|,)('.$search_str.')(,|$)')->count();
        
        if($products){
            $data = ['status' => true, 'code' => 200, 'products' => $products, 'total_count'=>$total_count];
        }else{
            $data = ['status' => false, 'code' => 500];
        }
        return $data;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function serviceList(Request $request)
    {
        $offset  = $request->input('offset');
        $limit   = $request->input('limit');
        $user_id = $request->input('user_id');

        $products = AgronomistService::with(['images','category','subcategory','commodity','city','state','district','offer'])
        ->where('user_id', $user_id)
        ->offset($offset)
        ->limit($limit)
        ->orderBy('id', 'DESC')
        ->get();;

        $total_count = AgronomistService::where('user_id' ,$user_id)->count();
        
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
        // create new instace of Agronomist Model
        $agronomist = new Agronomist();
        $agronomist->user_id        = $post['user_id'];
        $agronomist->category_id    = ($post['category_id']) ? $post['category_id'] : 0;
        $agronomist->subcategory_id = ($post['subcategory_id']) ? $post['subcategory_id'] : 0;
        $agronomist->commodity_id   = ($post['commodity_id']) ? $post['commodity_id'] : 0;
        $agronomist->plant_variety  = ($post['plant_variety']) ? $post['plant_variety'] : '';
        $agronomist->description_problem = ($post['description_problem']) ? $post['description_problem'] : '';
        $agronomist->date_of_plantation = ($post['date_of_plantation']) ? $post['date_of_plantation'] : '';
        $agronomist->report             = ($post['report']) ? $post['report'] : '';
        $agronomist->specification      = ($post['specification']) ? $post['specification'] : '';
        $agronomist->is_offer           = ($post['is_offer']) ? '1' : '0';
        // if User upload a file
        if($report = $request->file('upload_report') ){
            $filename   = $report->getClientOriginalName();
            $name       = "plant_report";
            $extension  = $report->extension();
            $filenew    = date('d-M-Y').'_'.str_replace($filename, $name, $filename).'_'.time().''.rand(). "." .$extension;
            $report->move(base_path('/public/uploads/agronomist'), $filenew);
            $agronomist->upload_report = asset('/uploads/agronomist/'.$filenew);
        }
        $media_type      = $post['media_type'];
        // Save a data to agronomist lead
        $res = $agronomist->save();
        // if agronomist lead store succesfully
        if($res){
            // if multiple files upload
            if($files = $request->file('plant_images')){
                $img_extra = [];
                foreach($files as $file){
                    $row = [];
                    $filename   = $file->getClientOriginalName();
                    $name       = "plant_img";
                    $extension  = $file->extension();
                    $filenew    =  date('d-M-Y').'_'.str_replace($filename, $name, $filename).'_'.time().''.rand(). "." .$extension;
                    $file->move(base_path('/public/uploads/agronomist'), $filenew);
                    $row['agronimist_lead_id'] = $agronomist->id;
                    $row['img_value']   = $filename;
                    $row['img_path']    = asset('/uploads/agronomist/'.$filenew);
                    $row['media_type']  = $media_type;
                    $img_extra[] = $row;
                }
                // insert bulk data to agronomist_lead_images table
                AgronomistLeadImage::insert($img_extra);
            }
            $data = ['status' => true, 'code' => 200, 'data'=>$agronomist];
        }else{
            $data = ['status' => false, 'code' => 500, 'message' => "Something went wrong"];
        }
        return $data;
    }

    public function leadShow($lead_id){
        if(!empty($lead_id) && $lead_id!='' && is_numeric($lead_id) ){
            $agronomist = Agronomist::with(['user','category','psubcategory','commodity','leadImages'])
                    ->where('id', $lead_id)->first();
            if($agronomist){
                return ['status' => true, 'code' => 200, 'data'=>$agronomist];
            }else{
                return ['status' => false, 'code' => 404, 'message' => __('messages.response.error_404')];
            }
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function serviceStore(Request $request)
    {
        $post = $request->all();
        // echo "<pre>"; print_r($post);die;
        $agronomist_service = new AgronomistService();
        $agronomist_service->user_id        = $post['user_id'];
        $agronomist_service->category_id    = $post['category_id'];
        $agronomist_service->subcategory_id = $post['subcategory_id'];
        $agronomist_service->commodity_id   = $post['commodity_id'];
        $agronomist_service->service_name   = ($post['service_name']) ? $post['service_name'] : '';
        $agronomist_service->description    = isset($post['description']) ? $post['description'] : '';
        $agronomist_service->specification  = isset($post['specification']) ? $post['specification'] : '';
        $agronomist_service->service_tags   = isset($post['service_tags']) ? $post['service_tags'] : '';
        $agronomist_service->fees           = isset($post['fees']) ? $post['fees'] : '';
        $agronomist_service->total_amount   = isset($post['total_amount']) ? $post['total_amount'] : '';
        $agronomist_service->unit           = isset($post['unit']) ? $post['unit'] : '';
        $agronomist_service->state_id       = isset($post['state_id']) ? $post['state_id'] : '';
        $agronomist_service->district_id    = isset($post['district_id']) ? $post['district_id'] : '';
        $agronomist_service->city_id        = isset($post['city_id']) ? $post['city_id'] : '';
        // echo "<pre>"; print_r($agronomist_service);die;
        $res = $agronomist_service->save();
        // dd($res);
        if($res){
            $files = $request->file('service_images');
            if($files){
                $img_extra = [];
                foreach($files as $file){
                    $row = [];
                    $filename   = $file->getClientOriginalName();
                    $name       = "service_img";
                    $extension  = $file->extension();
                    $filenew    =  date('d-M-Y').'_'.str_replace($filename, $name, $filename).'_'.time().''.rand(). "." .$extension;
                    $file->move(base_path('/public/uploads/agronomist_service'), $filenew);
                    $row['service_id'] = $agronomist_service->id;
                    $row['image_name']   = $filename;
                    $row['service_image'] = asset('/uploads/agronomist_service/'.$filenew);
                    $row['created_at']    = date('Y-m-d H:i:s');
                    $row['updated_at']    = date('Y-m-d H:i:s');
                    $img_extra[] = $row;
                }
                AgronomistServiceImage::insert($img_extra);
            }
            if($request->input('is_offer') == 'true'){
                $agronomist_offer = new AgronomistServiceOffer();
                $agronomist_offer->service_id  = $agronomist_service->id;
                // $agronomist_offer->offer_name  = $request->input('offer_name');
                $agronomist_offer->discount    = ($request->input('discount')) ? $request->input('discount') : 0;
                $agronomist_offer->amount      = ($request->input('offer_amount')) ? $request->input('offer_amount') : 0;
                $agronomist_offer->start_offer = ($request->input('start_offer')) ? $request->input('start_offer') : '';
                $agronomist_offer->end_offer   = ($request->input('end_offer')) ? $request->input('end_offer') : '';
                $agronomist_offer->offer_day   = ($request->input('offer_day')) ? $request->input('offer_day') : '';
                $agronomist_offer->offer_specification   = ($request->input('offer_specification')) ? $request->input('offer_specification') : '';
                $res = $agronomist_offer->save();
            }
            
            $data = ['status' => true, 'code' => 200, 'data'=>$agronomist_service];
        }else{
            $data = ['status' => false, 'code' => 500, 'message' => "Something went wrong"];
        }
        return $data;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Agronomist  $agronomist
     * @return \Illuminate\Http\Response
     */
    public function show(Agronomist $agronomist)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Agronomist  $agronomist
     * @return \Illuminate\Http\Response
     */
    public function showService($id)
    {
        $service = AgronomistService::with(['user', 'images','category','subcategory','commodity','city','state','district','offer'])
        ->where('id', $id)
        ->first();
        if($service){
            return ['status' => true, 'code' => 200, 'data'=>$service];
        }else{
            return ['status' => false, 'code' => 500, 'message' => "something went wrong with database."];
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Agronomist  $agronomist
     * @return \Illuminate\Http\Response
     */
    public function edit(Agronomist $agronomist)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Agronomist  $agronomist
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Agronomist $agronomist)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Agronomist  $agronomist
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $agronomist_lead_id = $request->input('agronomist_lead_id');
        // dd($agronomist_lead_id);
        $agronomist_lead = Agronomist::find($agronomist_lead_id);
        if($agronomist_lead){
            AgronomistLeadImage::where('agronimist_lead_id', $agronomist_lead->id)->delete();
            $res = $agronomist_lead->delete();
            return ['status' => true, 'code' => 200, 'message'=>__('messages.response.success_lead_delete')];
        }else{
            return ['status' => false, 'code' => 404, 'message'=>__('messages.response.error_404')];
        }
    }
}
