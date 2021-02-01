<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductOffer;
use App\Models\ProductPrice;
use App\Models\ProductRatting;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        if($products){
            $data = ['status' => true, 'code' => 200, 'user_ratting_id' => $user_ratting];
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
        $product = new Product;
        $product->user_id          = $request->input('user_id');
        $product->category_id      = $request->input('category_id');
        $product->subcategory_id   = $request->input('subcategory_id');
        $product->commodity_id     = $request->input('commodity_id');
        $product->brand_id     = $request->input('brand_id');
        $product->title        = $request->input('title');
        $product->description  = $request->input('description');
        $product->product_url  = ($request->input('product_url')) ? $request->input('product_url') : '';
        $product->website_url  = ($request->input('website_url')) ? $request->input('website_url') : '';
        $product->package_size = ($request->input('package_size')) ? $request->input('package_size') : '';
        $product->unit         = ($request->input('unit')) ? $request->input('unit') : '';
        $product->product_use  = ($request->input('product_use')) ? $request->input('product_use') : '';
        $product->specification = ($request->input('specification')) ? $request->input('specification') : '';
        $product->total_amount = ($request->input('total_amount')) ? $request->input('total_amount') : '0.00';
        // upload product file / video
        $file = $request->file('feature_img');
        if($file){
            $filename   = $file->getClientOriginalName();
            $name       = "product";
            $extension  = $file->extension();
            $filenew    =  date('d-M-Y').'_'.str_replace($filename,$name,$filename).'_'.time().''.rand(). "." .$extension;
            $file->move(base_path('/public/uploads/product'), $filenew);
            $product->feature_img   = '/uploads/product/'.$filenew;
        }
        // upload product document
        $doc_file = $request->file('document');
        if($doc_file){
            $filename   = $file->getClientOriginalName();
            $name       = "product_doc";
            $extension  = $file->extension();
            $filenew    =  date('d-M-Y').'_'.str_replace($filename,$name,$filename).'_'.time().''.rand(). "." .$extension;
            $file->move(base_path('/public/uploads/product'), $filenew);
            $product->feature_img   = '/uploads/product/'.$filenew;
        }
        // $product->views = 0;
        $product->status = $request->input('status');
        $res = $product->save();
        if($res){
            return ['status' => true, 'code' => 200, 'data'=>$product];
        }else{
            return ['status' => false, 'code' => 500, 'message' => "something went wrong with database."];
        }
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
}
