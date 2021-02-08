<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Buy;
use Illuminate\Http\Request;

class BuyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
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
        $buy = new Buy();
        $buy->user_id        = $post['user_id'];
        $buy->category_id    = $post['category_id'];
        $buy->subcategory_id = $post['subcategory_id'];
        $buy->commodity_id   = $post['commodity_id'];
        $buy->product_title  = $post['product_title'];
        $buy->qty            = $post['qty'];
        $buy->size           = ($post['size']) ? $post['size'] : 0;
        $buy->buy_specification = ($post['buy_specification']) ? $post['buy_specification'] : '';
        $buy->min_price         = ($post['min_price']) ? $post['min_price'] : 0;
        $buy->max_price         = ($post['max_price']) ? $post['max_price'] : 0;
        $buy->product_specification = ($post['product_specification']) ? $post['product_specification'] : '';
        $buy->address           = $post['address'];
        $buy->state_id          = $post['state_id'];
        $buy->district_id       = $post['district_id'];
        $buy->city_id           = $post['city_id'];
        /*$buy->location          = $post['location'];
        $buy->latitude          = $post['latitude'];
        $buy->longitude         = $post['latitude'];*/

        $res = $buy->save();

        if($res){
            $data = ['status' => true, 'code' => 200, 'data'=>$buy];
        }else{
            $data = ['status' => false, 'code' => 500, 'message' => "data not found"];
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
    public function destroy(Buy $buy)
    {
        //
    }
}
