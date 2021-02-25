<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Ebill;
use App\Models\EbillExpenses;
use App\Models\EbillProducts;
use App\Models\EbillBelongsManyProducts;
use App\Models\EbillShipping;
use App\Models\EbillTransaction;
use App\Models\Driver;
use App\Models\DriverTracking;
use Illuminate\Http\Request;

class EbillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $perameters     = $request->all();
        // echo "<pre>";print_r($perameters);die;
        $user_id        = $request->input('user_id');
        $vendor_id      = $request->input('vendor_id');
        $role_id        = $request->input('role_id');
        $offset         = $request->input('offset');
        $limit          = $request->input('limit');
        $column_name    = $request->input('column_name');
        $sort_by        = $request->input('sort_by');
        $seller_type    = $request->input('seller_type');
        if(!empty($seller_type) && $seller_type == '1' ){
            // get list of user ebills
            $ebills = Ebill::with(['vendor'])
            ->where('user_id', $user_id)
            ->offset($offset)
            ->limit($limit)
            ->orderBy($column_name, $sort_by)
            ->get();
            // get total count of user ebills
            $total_count = Ebill::where('user_id', $user_id)->count();
        }else{
            // get list of vendor ebills
            $ebills = Ebill::with(['user'])
            ->where('vendor_id', $vendor_id)
            ->offset($offset)
            ->limit($limit)
            ->orderBy($column_name, $sort_by)
            ->get();
            // get total count of vendor ebills
            $total_count = Ebill::where('vendor_id', $vendor_id)->count();
        }


        if($ebills){
            $data = ['status' => true, 'code' => 200, 'ebills' => $ebills, 'total_count'=>$total_count];
        }else{
            $data = ['status' => false, 'code' => 404, 'msg' => 'data not found'];
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
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $perameters = $request->all();
        // $order_id = 'AS'.date("Ymd").'-'.rand(10000, 99999);
        // $bill_number = time();
        $ebill = new Ebill();
        $ebill->user_id         = $perameters['user_id'];
        $ebill->vendor_id       = $perameters['vendor_id'];
        $ebill->order_id        = ($perameters['order_id']) ? $perameters['order_id'] : '';
        $ebill->bill_number     = ($perameters['bill_number']) ? $perameters['bill_number'] : 0;
        $ebill->specification   = ($perameters['specification']) ? $perameters['specification'] : '';
        $ebill->ship_to         = ($perameters['ship_to']) ? $perameters['ship_to'] : '';
        $ebill->bill_to         = ($perameters['bill_to']) ? $perameters['bill_to'] : '';
        $ebill->bill_date       = $perameters['bill_date'];
        $ebill->due_date        = $perameters['due_date'];
        $ebill->advance_amount  = ($perameters['advance_amount']) ? $perameters['advance_amount'] : 0;
        $ebill->due_amount      = ($perameters['due_amount']) ? $perameters['due_amount'] : 0;
        $ebill->total_amount    = $perameters['total_amount'];
        $ebill->status          = ($perameters['status']) ? $perameters['status'] : '1';
        $ebill->seller_type     = ($perameters['seller_type']) ? $perameters['seller_type'] : '1';
        $res = $ebill->save();
        if($res){
            // Insert Ebill Expenses
            $ebill_expense = new EbillExpenses();
            $ebill_expense->ebill_id        = $ebill->id;
            $ebill_expense->shipping_charge = $perameters['shipping_charge'];
            $ebill_expense->bank_charge     = $perameters['bank_charge'];
            $ebill_expense->mandi_tax       = $perameters['mandi_tax'];
            $ebill_expense->other_expense   = $perameters['other_expense'];
            $ebill_expense->save();
            // Corelate Ebill and thier products
            $products   = ($perameters['products']) ? $perameters['products'] : '';
            if(!empty($products)){
                $product_arr = explode(',', $products);
                if(!empty($product_arr)){
                    $product_data = [];
                    foreach ($product_arr as $product) {
                        $row = [];
                        $row['ebill_id'] = $ebill->id;
                        $row['ebill_product_id'] = $product;
                        $row['created_at'] = date('Y-m-d H:i:s');
                        $row['updated_at'] = date('Y-m-d H:i:s');
                        $product_data[] = $row;
                    }
                    EbillBelongsManyProducts::insert($product_data);
                }
            }
            $data = ['status' => true, 'code' => 200, 'ebill' => $ebill];
        }else{
            $data = ['status' => false, 'code' => 500];
        }
        return $data;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function shippingStore(Request $request)
    {
        $perameters = $request->all();
        // echo "<pre>";print_r($perameters);die;
        // $order_id = 'AS'.date("Ymd").'-'.rand(10000, 99999);
        // $bill_number = time();
        $ebill_shipping = new EbillShipping();
        $ebill_id           = ($perameters['ebill_id']) ? $perameters['ebill_id'] : 0;
        $ebill_shipping->ebill_id  = $ebill_id;
        $shipping_type      = ($perameters['shipping_type']) ? $perameters['shipping_type'] : '1';
        $ebill_shipping->shipping_type      = $shipping_type;
        if($shipping_type == '1'){
            $ebill_shipping->transport_name     = ($perameters['transport_name']) ? $perameters['transport_name'] : '';
            $ebill_shipping->bill_number        = ($perameters['bill_number']) ? $perameters['bill_number'] : '';
            // $ebill_shipping->bill_receipt_img   = ($perameters['bill_receipt_img']) ? $perameters['bill_receipt_img'] : '';
            // upload transport receipt bill
            $file_transport = isset($perameters['bill_receipt_img']) ? $perameters['bill_receipt_img'] : '';
            if($file_transport){
                $filename   = $file_transport->getClientOriginalName();
                $name       = "shipping_transport_img";
                $extension  = $file_transport->extension();
                $filenew    =  date('d-M-Y').'_'.str_replace($filename,$name,$filename).'_'.time().''.rand(). "." .$extension;
                $file_transport->move(base_path('/public/uploads/shipping'), $filenew);
                $ebill_shipping->bill_receipt_img   = asset('/uploads/shipping/'.$filenew);
            }
        }elseif($shipping_type == '2'){
            $ebill_shipping->courier_name       = ($perameters['courier_name']) ? $perameters['courier_name'] : '';
            $ebill_shipping->tracking_number    = ($perameters['tracking_number']) ? $perameters['tracking_number'] : '';
            // $ebill_shipping->courier_receipt_img = ($perameters['courier_receipt_img']) ? $perameters['courier_receipt_img'] : '';
            // upload courier receipt bill
            $file_courier = isset($perameters['courier_receipt_img']) ? $perameters['courier_receipt_img'] : '';
            if($file_courier){
                $filename   = $file_courier->getClientOriginalName();
                $name       = "shipping_courier_img";
                $extension  = $file_courier->extension();
                $filenew    =  date('d-M-Y').'_'.str_replace($filename,$name,$filename).'_'.time().''.rand(). "." .$extension;
                $file_courier->move(base_path('/public/uploads/shipping'), $filenew);
                $ebill_shipping->courier_receipt_img   = asset('/uploads/shipping/'.$filenew);
            }
        }elseif($shipping_type == '3'){
            $ebill_shipping->lt_driver_name     = ($perameters['lt_driver_name']) ? $perameters['lt_driver_name'] : '';
            $ebill_shipping->lt_driver_mobile   = ($perameters['lt_driver_mobile']) ? $perameters['lt_driver_mobile'] : '';
            $ebill_shipping->lt_vehcile_number  = ($perameters['lt_vehcile_number']) ? $perameters['lt_vehcile_number'] : '';
            $ebill_shipping->lt_owner_name      = ($perameters['lt_owner_name']) ? $perameters['lt_owner_name'] : '';
            // $ebill_shipping->lt_driver_img      = ($perameters['lt_driver_img']) ? $perameters['lt_driver_img'] : '';
            // upload shipping driver image
            $file_driver = isset($perameters['lt_driver_img']) ? $perameters['lt_driver_img'] : '';
            if($file_driver){
                $filename   = $file_driver->getClientOriginalName();
                $name       = "shipping_driver_img";
                $extension  = $file_driver->extension();
                $filenew    =  date('d-M-Y').'_'.str_replace($filename,$name,$filename).'_'.time().''.rand(). "." .$extension;
                $file_driver->move(base_path('/public/uploads/shipping'), $filenew);
                $driver_img   = asset('/uploads/shipping/'.$filenew);
                $ebill_shipping->lt_driver_img   = $driver_img;
            }
            // $ebill_shipping->lt_loading_vehcile_img = ($perameters['lt_loading_vehcile_img']) ? $perameters['lt_loading_vehcile_img'] : '';
            // upload shipping loading image
            $file_loading = isset($perameters['lt_loading_vehcile_img']) ? $perameters['lt_loading_vehcile_img'] : '';
            if($file_loading){
                $filename   = $file_loading->getClientOriginalName();
                $name       = "shipping_loading_img";
                $extension  = $file_loading->extension();
                $filenew    =  date('d-M-Y').'_'.str_replace($filename,$name,$filename).'_'.time().''.rand(). "." .$extension;
                $file_loading->move(base_path('/public/uploads/shipping'), $filenew);
                $ebill_shipping->lt_loading_vehcile_img   = asset('/uploads/shipping/'.$filenew);
            }
            $ebill_shipping->lt_driver_identity     = ($perameters['lt_driver_identity']) ? $perameters['lt_driver_identity'] : '';
            // $ebill_shipping->lt_driver_identity_img = ($perameters['lt_driver_identity_img']) ? $perameters['lt_driver_identity_img'] : '';
            // upload shipping driver identity image
            $file_driver_id = isset($perameters['lt_driver_identity_img']) ? $perameters['lt_driver_identity_img'] : '';
            if($file_driver_id){
                $filename   = $file_driver_id->getClientOriginalName();
                $name       = "shipping_driverid_img";
                $extension  = $file_driver_id->extension();
                $filenew    =  date('d-M-Y').'_'.str_replace($filename,$name,$filename).'_'.time().''.rand(). "." .$extension;
                $file_driver_id->move(base_path('/public/uploads/shipping'), $filenew);
                $ebill_shipping->lt_driver_identity_img   = asset('/uploads/shipping/'.$filenew);
            }
            $ebill_shipping->lt_driver_otp          = '123456';

            /*$driver = new Driver();
            $driver->name = ($perameters['lt_driver_name']) ? $perameters['lt_driver_name'] : '';
            $driver->mobile = ($perameters['lt_driver_mobile']) ? $perameters['lt_driver_mobile'] : '';
            $driver->profile_image = $driver_img;
            $driver->driver_otp = '123456';
            $driver->status = 1;
            $driver->save();*/
            $driver_data = [];
            $driver_data['name'] = ($perameters['lt_driver_name']) ? $perameters['lt_driver_name'] : '';
            $driver_data['mobile'] = ($perameters['lt_driver_mobile']) ? $perameters['lt_driver_mobile'] : '';
            $driver_data['profile_image'] = $driver_img;
            $driver_data['driver_otp'] = '123456';
            $driver_data['status'] = 1;
            $driver = Driver::updateOrCreate(['mobile' => $driver_data['mobile']],$driver_data);
            $driver_tracking = new DriverTracking();
            $driver_tracking->ebill_id = $ebill_id;
            $driver_tracking->driver_id = $driver->id;
            $driver_tracking->status = 1;
            $driver_tracking->save();
        }
        // echo "<pre>";print_r($ebill_shipping);die;
        $res = $ebill_shipping->save();
        if($res){
            $ebill = $ebill_shipping->ebill()->first();
            $ebill->shipping_status = 1;
            $ebill->save();
            $data = ['status' => true, 'code' => 200, 'ebill_shipping' => $ebill_shipping];
        }else{
            $data = ['status' => false, 'code' => 500];
        }
        return $data;
    }

    /**
     * Resend Driver OTP
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function resendDriverOtp(Request $request){
        $perameters = $request->all();
        $ebill_shipping_id = $perameters['ebill_shipping_id'];
        $ebill_shipping = EbillShipping::find($ebill_shipping_id);
        if($ebill_shipping){
            $ebill_shipping->lt_driver_otp = '123456';
            $res = $ebill_shipping->save();
            if($res){
                $data = ['status' => true, 'code' => 200, 'msg'=>'otp resend successfully'];
            }else{
                $data = ['status' => false, 'code' => 403, 'msg'=>'otp resend failed'];
            }
        }else{
            $data = ['status' => false, 'code' => 404, 'msg'=>'data not found'];
        }
        return $data;
    }

    /**
     * Driver OTP verify
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     *
     */
    public function verifyDriverOtp(Request $request){
        $perameters = $request->all();
        $ebill_shipping_id = $perameters['ebill_shipping_id'];
        $driver_otp = $perameters['driver_otp'];
        $ebill_shipping = EbillShipping::find($ebill_shipping_id);
        if($ebill_shipping){
            if($ebill_shipping->lt_driver_otp == $driver_otp){
                // set driver otp null
                $ebill_shipping->lt_driver_otp = '';
                $res    = $ebill_shipping->save();
                // get ebill which belongs to ebill shipping
                /*$ebill  = $ebill_shipping->ebill()->first();
                $ebill->shipping_status = 1;
                $res    = $ebill->save();*/

                $data = ['status' => true, 'code' => 200, 'msg'=>'otp verified successfully'];
            }else{
                $data = ['status' => false, 'code' => 403, 'msg'=>'otp not verified'];
            }
        }else{
            $data = ['status' => false, 'code' => 404, 'msg'=>'data not found'];
        }
        return $data;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ebill  $ebill
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ebill = Ebill::with(['user', 'vendor', 'products', 'expenses', 'driver'])->where('id', $id)->first();
        if($ebill){
            return ['status' => true, 'code' => 200, 'data'=>$ebill];
        }else{
            return ['status' => false, 'code' => 404, 'message' => "data not found"];
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ebill  $ebill
     * @return \Illuminate\Http\Response
     */
    public function edit(Ebill $ebill)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ebill  $ebill
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ebill $ebill)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ebill  $ebill
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ebill $ebill)
    {
        //
    }

    /**
     * Remove the Ebill product from storage.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteProduct($id)
    {
        $ebill_product = EbillProducts::find($id);
        if($ebill_product){
            $res = $ebill_product->delete();
            if($res){
                return ['status' => true, 'code' => 200, 'message' => "data deleted success"];
            }else{
                return ['status' => false, 'code' => 500, 'message' => "something went wrong with database."];
            }
        }else{
            return ['status' => false, 'code' => 404, 'message' => "data not found"];
        }
    }

    /**/
    public function addProduct(Request $request){
        $ebill_product = new EbillProducts;
        $ebill_product->category_id     = $request->input('category_id');
        $ebill_product->subcategory_id  = $request->input('subcategory_id');
        $ebill_product->commodity_id    = $request->input('commodity_id');
        $ebill_product->product_name    = $request->input('product_name');
        $ebill_product->packet_number   = $request->input('packet_number');
        $ebill_product->total_volume    = ($request->input('total_volume')) ? $request->input('total_volume') : 0;
        $ebill_product->volume_unit     = ($request->input('volume_unit')) ? $request->input('volume_unit') : '';
        $ebill_product->product_rate    = $request->input('product_rate');
        $ebill_product->rate_unit       = $request->input('rate_unit');
        $ebill_product->product_tax     = ($request->input('product_tax')) ? $request->input('product_tax') : 0;
        $ebill_product->product_image   = $request->input('product_image');
        $ebill_product->specification   = $request->input('specification');
        $ebill_product->subtotal        = $request->input('subtotal');
        // upload product file / video
        $file = $request->file('product_image');
        if($file){
            $filename   = $file->getClientOriginalName();
            $name       = "ebill_product";
            $extension  = $file->extension();
            $filenew    =  date('d-M-Y').'_'.str_replace($filename,$name,$filename).'_'.time().''.rand(). "." .$extension;
            $file->move(base_path('/public/uploads/products'), $filenew);
            $ebill_product->product_image   = asset('/uploads/products/'.$filenew);
        }
        $ebill_product->status = $request->input('status');
        $res = $ebill_product->save();
        if($res){
            return ['status' => true, 'code' => 200, 'data'=>$ebill_product];
        }else{
            return ['status' => false, 'code' => 500, 'message' => "something went wrong with database."];
        }
    }

    public function rfpStatusUpdate(Request $request){
        $ebill_id = $request->input('ebill_id');
        $rfp_status = $request->input('rfp_status');
        $decline_reason = ($request->input('decline_reason')) ? $request->input('decline_reason') : '';
        $ebill = Ebill::find($ebill_id);
        if($ebill){
            $ebill->rfp_status = $rfp_status;
            $ebill->decline_reason   = $decline_reason;
            $res = $ebill->save();
            if($res){
                return ['status' => true, 'code' => 200, 'data'=>$ebill];
            }else{
                return ['status' => false, 'code' => 500, 'message' => "something went wrong with database."];
            }
        }else{
            return ['status' => false, 'code' => 404, 'message' => "data not found."];
        }
    }

    public function ebillTransaction(Request $request){
        $perameters = $request->all();
        $ebill_tran = new EbillTransaction;
        $ebill_tran->ebill_id    = $perameters['ebill_id'];
        $ebill_tran->sender_id   = $perameters['sender_id'];
        $ebill_tran->receiver_id = $perameters['receiver_id'];
        $ebill_tran->transaction_amount = $perameters['transaction_amount'];
        $ebill_tran->status = 1;
        $res = $ebill_tran->save();
        if($res){
            // get ebill which belongs to ebill shipping
            $ebill  = $ebill_tran->ebill()->first();
            $ebill->payment_status = 2;
            $res    = $ebill->save();
            return ['status' => true, 'code' => 200, 'data'=>$ebill_tran];
        }else{
            return ['status' => false, 'code' => 500, 'message' => "something went wrong with database."];
        }
    }

    public function paymentStatusUpdate(Request $request){
        $ebill_id       = $request->input('ebill_id');
        $payment_status = $request->input('payment_status');
        $ebill = Ebill::find($ebill_id);
        if($ebill){
            $ebill->payment_status = $payment_status;
            $res = $ebill->save();
            if($res){
                return ['status' => true, 'code' => 200, 'data'=>$ebill];
            }else{
                return ['status' => false, 'code' => 500, 'message' => "something went wrong with database."];
            }
        }else{
            return ['status' => false, 'code' => 404, 'message' => "data not found."];
        }
    }

    // delivery part
    /* send delivery otp  */
    public function sendDeliveryOtp(Request $request){
        $ebill_id   = $request->input('ebill_id');
        $driver_id  = $request->input('driver_id');
        $driver_tracking = DriverTracking::where('ebill_id', $ebill_id)->where('driver_id', $driver_id)->first();
        if($driver_tracking){
            $driver_tracking->delivery_otp = '123456';
            $res = $driver_tracking->save();
            if($res){
                return ['status' => true, 'code' => 200, 'data'=>$driver_tracking];
            }else{
                return ['status' => false, 'code' => 500, 'message' => "something went wrong with database."];
            }
        }else{
            return ['status' => false, 'code' => 404, 'message' => "data not found."];   
        }
    }
    /* resend delivery otp  */
    public function resendDeliveryOtp(Request $request){
        $ebill_id   = $request->input('ebill_id');
        $driver_id  = $request->input('driver_id');
        $driver_tracking = DriverTracking::where('ebill_id', $ebill_id)->where('driver_id', $driver_id)->first();
        if($driver_tracking){
            $driver_tracking->delivery_otp = '123456';
            $res = $driver_tracking->save();
            if($res){
                return ['status' => true, 'code' => 200, 'data'=>$driver_tracking];
            }else{
                return ['status' => false, 'code' => 500, 'message' => "something went wrong with database."];
            }
        }else{
            return ['status' => false, 'code' => 404, 'message' => "data not found."];   
        }
    }
        /**
     * Driver OTP verify
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     *
     */
    public function verifyDriverDeliveryOtp(Request $request){
        $ebill_id   = $request->input('ebill_id');
        $driver_id  = $request->input('driver_id');
        $driver_delivery_otp  = $request->input('driver_delivery_otp');
        $last_updated_location  = $request->input('last_updated_location');
        $driver_tracking = DriverTracking::where('ebill_id', $ebill_id)->where('driver_id', $driver_id)->first();
        if($driver_tracking){
            if($driver_tracking->delivery_otp == $driver_delivery_otp){
                // set driver otp null
                $driver_tracking->delivery_otp = '';
                $driver_tracking->last_updated_location = $last_updated_location;
                $driver_tracking->is_delivered = 1;
                $driver_tracking->status = 0;
                $res    = $driver_tracking->save();
                // get ebill which belongs to ebill shipping
                $ebill  = $driver_tracking->ebill()->first();
                $ebill->is_delivered = 1;
                $res    = $ebill->save();

                $data = ['status' => true, 'code' => 200, 'msg'=>'otp verified successfully'];
            }else{
                $data = ['status' => false, 'code' => 403, 'msg'=>'otp not verified'];
            }
        }else{
            $data = ['status' => false, 'code' => 404, 'msg'=>'data not found'];
        }
        return $data;
    }

}
