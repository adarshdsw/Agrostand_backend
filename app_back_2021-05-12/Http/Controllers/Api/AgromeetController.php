<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Agromeet;
use Illuminate\Http\Request;
use DateTime;

class AgromeetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $date = new DateTime();

        $now_start  = $date->format('Y-m-d')." "."00:00:01";
        $now_end    = $date->format('Y-m-d')." "."23:59:59";
        
        // yesterday date
        $date->modify('-1 day');
        $yesterday_start = $date->format('Y-m-d')." "."00:00:01";
        $yesterday_end   = $date->format('Y-m-d')." "."23:59:59";
        
        // future date
        $date->modify('+2 day');
        $tomorrow_start = $date->format('Y-m-d')." "."00:00:01";
        $tomorrow_end   = $date->format('Y-m-d')." "."23:59:59";

        // dd($now_start, $now_end, $yesterday_start, $yesterday_end, $tomorrow_start, $tomorrow_end);

        $data['agromeets_present']  = Agromeet::whereBetween('meeting_date_time', [$now_start, $now_end])->where('status', '1')->get();
        $data['agromeets_past']     = Agromeet::whereBetween('meeting_date_time', [$yesterday_start, $yesterday_end])->where('status', '1')->get();
        $data['agromeets_future']   = Agromeet::whereBetween('meeting_date_time', [$tomorrow_start, $tomorrow_end])->where('status', '1')->get();

        if($data){
            return ['status' => true, 'code' => 200, 'data'=>$data];
        }else{
            return ['status' => false, 'code' => 500];
        }
    }
}
