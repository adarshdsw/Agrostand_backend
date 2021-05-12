<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Commodity;
use App\Models\CommodityRecords;
use Illuminate\Support\Facades\DB;

class CommodityController extends Controller
{
    /**
     * Display a listing of the madni commodity.
     *
     * @param  \Illuminate\Http\Request  $request
     * $request->input('offset');
     * $request->input('limit');
     * @return \Illuminate\Http\Response
     */
    public function commodityList(Request $request){
        $offset  = $request->input('offset');
        $limit   = $request->input('limit');
        $commodity_title   = $request->input('commodity_title');
        $commodities = Commodity::groupBy('title')
                        ->when ((isset($commodity_title) && $commodity_title !== '' && !empty($commodity_title) ), function ($query) use ($request) {
                            $commodity_title  = $request->input('commodity_title');
                            $query->where('title', 'like', '%'.$commodity_title.'%');
                        })
                        ->offset($offset)
                        ->limit($limit)
                        ->orderBy('title', 'ASC')
                        ->get();
        $total_count = count(Commodity::groupBy('title')
                        ->when ((isset($commodity_title) && $commodity_title !== '' && !empty($commodity_title) ), function ($query) use ($request) {
                            $commodity_title  = $request->input('commodity_title');
                            $query->where('title', 'like', '%'.$commodity_title.'%');
                        })
                        ->get());
        if($commodities){
            $data = ['status' => true, 'code' => 200, 'data' => $commodities, 'total_count'=>$total_count];
        }else{
            $data = ['status' => false, 'code' => 404];
        }
        return $data;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function mandiList(Request $request){
        $commodity     = $request->input('commodity');
        $market_title  = $request->input('market_title');
        $offset     = $request->input('offset');
        $limit      = $request->input('limit');

        $commodity_mandies = CommodityRecords::where('commodity', $commodity)
                            ->when ((isset($market_title) && $market_title !== '' && !empty($market_title) ), function ($query) use($request) {
                                $market_title  = $request->input('market_title');
                                $query->where('market', 'like', '%'.$market_title.'%');
                            })
                            ->offset($offset)
                            ->limit($limit)
                            ->orderBy('created', 'ASC')
                            ->get();

        $min_price_avg = CommodityRecords::where('commodity', $commodity)->avg('min_price');
        $max_price_avg = CommodityRecords::where('commodity', $commodity)->avg('max_price');

        $total_count = CommodityRecords::where('commodity', $commodity)->count();
        if($commodity_mandies){
            $data = ['status' => true, 'code' => 200, 'data' => $commodity_mandies, 'total_count'=>$total_count, 'min_price_avg'=>$min_price_avg, 'max_price_avg'=>$max_price_avg ];
        }else{
            $data = ['status' => false, 'code' => 404];
        }
        return $data;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function mandiDetailList(Request $request){
        $commodity     = $request->input('commodity');
        $market_title  = $request->input('market_title');
        $offset     = $request->input('offset');
        $limit      = $request->input('limit');

        $mandi_detail = CommodityRecords::where('commodity', $commodity)
                            ->where('market', $market_title)
                            ->offset($offset)
                            ->limit($limit)
                            ->orderBy('data_record_id', 'DESC')
                            ->get();
        $total_count = CommodityRecords::where('commodity', $commodity)->where('market', $market_title)->count();
        if($mandi_detail){
            $data = ['status' => true, 'code' => 200, 'data' => $mandi_detail, 'total_count'=>$total_count];
        }else{
            $data = ['status' => false, 'code' => 404];
        }
        return $data;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $state_title     = $request->input('state_title');
        $district_title  = $request->input('district_title');
        $market_title    = $request->input('market_title');
        $commodity_title = $request->input('commodity_title');
        $commodity_date  = $request->input('commodity_date');
        $limit           = $request->input('limit');
        $offset          = $request->input('offset');
        $data            = [];

            $data = CommodityRecords::where('state', 'like', '%'.$state_title.'%')
                    ->where('district', 'like', '%'.$district_title.'%')
                    ->where('market', 'like', '%'.$market_title.'%')
                    ->where('commodity', 'like', '%'.$commodity_title.'%')
                    ->when ((isset($commodity_date) && $commodity_date !== '' && !empty($commodity_date) ), function ($query) {
                        $query->where('created', date('Y-m-d', strtotime($commodity_date)));
                    })
                    ->offset($offset)
                    ->limit($limit)
                    ->get();
        // echo print_r(DB::getQueryLog());die;
        if($data){
            return ['status' => true, 'code' => 200, 'data' => $data];
        }else{
            return ['status' => false, 'code' => 404, 'message' => __('messages.response.error_404')];
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function filterData(Request $request)
    {
        // DB::enableQueryLog();

        $state_title = $request->input('state_title');
        $district_title = $request->input('district_title');
        $market_title = $request->input('market_title');

        $data['state']      = CommodityRecords::groupBy('state')->select('state')->get();
        if($state_title){
            $data['district']   = CommodityRecords::where('state', 'like', '%'.$state_title.'%')->groupBy('district')->select('district')->get();
        }
        if($district_title != ''){
            $data['market']      = CommodityRecords::where('district', $district_title)->groupBy('market')->select('market')->get();
        }
        if($market_title != ''){
            $data['commodity']      = CommodityRecords::where('market', $market_title)->groupBy('commodity')->select('commodity')->get();
        }
        // echo print_r(DB::getQueryLog());die;
        if($data){
            return ['status' => true, 'code' => 200, 'data' => $data];
        }else{
            return ['status' => false, 'code' => 404, 'message' => __('messages.response.error_404')];
        }
    }

    public function storeMiscellaneous(Request $request){
        $commodity_data     = [];
        $my_commodities     = Commodity::select('title')->get();
        $other_commodities  = CommodityRecords::groupBy('commodity')->select('commodity')->get();

        foreach($other_commodities as $other_commodity){
            foreach($my_commodities as $my_commodity){
                if($other_commodity->commodity !== $my_commodity->title ){
                    $row = [];
                    $row['subcategory_id'] = 0;
                    $row['title']          = $other_commodity->commodity;
                    $row['slug']           = strtolower($other_commodity->commodity);
                    $row['status']      = '1';
                    $row['created_at']  = date('Y-m-d H:i:s');
                    $row['updated_at']  = date('Y-m-d H:i:s');
                    $commodity_data[]   = $row;
                    break;
                }
            }   
        }
        echo "<pre>";print_r($commodity_data);die;
        $res = Commodity::insert($commodity_data);
        dd($res);
    }
}
