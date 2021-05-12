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
use App\Models\User;
use App\Models\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

// Notificarion
use App\Notifications\NotifyEbillCreated;
use App\Notifications\NotifyRfpUpdated;
use App\Notifications\NotifyShippingStatus;
use App\Notifications\NotifySenderDriverRegistration;
use App\Notifications\NotifyAdminAgroPay;
use App\Notifications\NotifyAdminAgroService;
use App\Notifications\NotifyPaymentProcessSender;
use App\Notifications\NotifyPaymentProcessAdmin;
use App\Notifications\SenderNotifyPaymentStatusReceiver;

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
        
        $shipping_status = $request->input('shipping_status');
        $payment_status  = $request->input('payment_status');
        
        $search     = ($request->input('search'))?$request->input('search'):'';
        if(!empty($seller_type) && $seller_type == '1' ){
            // get list of user ebills
            $ebills = Ebill::with(['vendor', 'shipping'])
            ->when ((isset($search) && $search !== '' && !empty($search) ), function ($query) use ($perameters) {
                $query->where('order_id', 'like', $perameters['search'].'%');
            })
            ->when ((isset($shipping_status) && $shipping_status !== '' && !empty($shipping_status) ), function ($query) use ($perameters) {
                $query->where('shipping_status', $perameters['shipping_status']);
            })
            ->when ((isset($payment_status) && $payment_status !== '' && !empty($payment_status) ), function ($query) use ($perameters) {
                $query->where('payment_status', $perameters['payment_status']);
            })
            ->where('user_id', $user_id)
            ->where('payment_status', '!=', '1')
            ->where('is_delivered', '!=', '1')
            ->offset($offset)
            ->limit($limit)
            ->orderBy($column_name, $sort_by)
            ->get();
            // get total count of user ebills
            $total_count = Ebill::where('user_id', $user_id)->where('payment_status', '!=', '1')->where('is_delivered', '!=', '1')->count();
        }else{
            // get list of vendor ebills
            $ebills = Ebill::with(['user', 'shipping'])
            ->when ((isset($search) && $search !== '' && !empty($search) ), function ($query) use ($perameters) {
                $query->where('order_id', 'like', $search.'%');
            })
            ->when ((isset($shipping_status) && $shipping_status !== '' && !empty($shipping_status) ), function ($query) use ($perameters) {
                $query->where('shipping_status', $perameters['shipping_status']);
            })
            ->when ((isset($payment_status) && $payment_status !== '' && !empty($payment_status) ), function ($query) use ($perameters) {
                $query->where('payment_status', $perameters['payment_status']);
            })
            ->where('vendor_id', $vendor_id)
            ->where('payment_status', '!=', '1')
            ->where('is_delivered', '!=', '1')
            ->offset($offset)
            ->limit($limit)
            ->orderBy($column_name, $sort_by)
            ->get();
            // get total count of vendor ebills
            $total_count = Ebill::where('vendor_id', $vendor_id)->where('payment_status', '!=', '1')->where('is_delivered', '!=', '1')->count();
        }


        if($ebills){
            $data = ['status' => true, 'code' => 200, 'ebills' => $ebills, 'total_count'=>$total_count];
        }else{
            $data = ['status' => false, 'code' => 404, 'msg' => 'data not found'];
        }
        return $data;
    }
    /**
     * Display a listing of the order.
     *
     * @return \Illuminate\Http\Response
     */
    public function orderList(Request $request)
    {
        $perameters     = $request->all();
        // echo "<pre>";print_r($perameters);die;
        $user_id        = $request->input('user_id');
        $vendor_id      = $request->input('vendor_id');
        $offset         = $request->input('offset');
        $limit          = $request->input('limit');
        $column_name    = $request->input('column_name');
        $sort_by        = $request->input('sort_by');
        $seller_type    = $request->input('seller_type');
        $search     = ($request->input('search'))?$request->input('search'):'';

        if(!empty($seller_type) && $seller_type == '1' ){
            // get list of user ebills
            $ebills = Ebill::with(['vendor'])
            ->when ((isset($search) && $search !== '' && !empty($search) ), function ($query) use ($perameters) {
                $query->where('order_id', 'like', $search.'%');
            })
            ->where('user_id', $user_id)
            ->where('payment_status', '1')
            ->where('is_delivered', '1')
            ->offset($offset)
            ->limit($limit)
            ->orderBy($column_name, $sort_by)
            ->get();
            // get total count of user ebills
            $total_count = Ebill::where('user_id', $user_id)->where('payment_status', '1')->where('is_delivered', '1')->count();
        }else{
            // get list of vendor ebills
            $ebills = Ebill::with(['user'])
            ->when ((isset($search) && $search !== '' && !empty($search) ), function ($query) use ($perameters) {
                $query->where('order_id', 'like', $search.'%');
            })
            ->where('vendor_id', $vendor_id)
            ->where('payment_status', '1')
            ->where('is_delivered', '1')
            ->offset($offset)
            ->limit($limit)
            ->orderBy($column_name, $sort_by)
            ->get();
            // get total count of vendor ebills
            $total_count = Ebill::where('vendor_id', $vendor_id)->where('payment_status', '1')->where('is_delivered', '1')->count();
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
        $user_id    = $perameters['user_id'];
        $vendor_id  = $perameters['vendor_id'];

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
            // Correlate Ebill and thier products
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

            $path = public_path('/img/logo.png');
            $type = pathinfo($path, PATHINFO_EXTENSION);
            $data = file_get_contents($path);
            $custom_data['logo_base64'] = 'data:image/' . $type . ';base64,' . base64_encode($data);
            
            $path = public_path('/img/dimension.png');
            $type = pathinfo($path, PATHINFO_EXTENSION);
            $data = file_get_contents($path);
            $custom_data['dimention_base64'] = 'data:image/' . $type . ';base64,' . base64_encode($data);

            $pdf     =  \PDF::loadView('layouts.ebill_pdf_preview_2', compact('ebill', 'custom_data'));
            $path    =  base_path('public/uploads/ebill_pdf');
            $file    =  date('d-M-Y').'_'.'ebill'.'_'.time().''.rand(). ".pdf";
            $filenew =  $path.'/'.$file;
            $ebill->ebill_pdf = asset('/uploads/ebill_pdf/'.$file);
            $ebill->save();
            // dd($filenew);
            $pdf_res  = $pdf->setPaper('a4', 'landscape')->setWarnings(false)->save($filenew);

            $userTo     = User::find($vendor_id);
            $userFrom   = User::find($user_id);
            if(!empty($userTo)){
                // $userTo->notify(new NotifyEbillCreated($userFrom, $ebill));
            }


            $data = ['status' => true, 'code' => 200, 'ebill' => $ebill, 'message'=>__('messages.response.success_ebill_store')];
        }else{
            $data = ['status' => false, 'code' => 500, 'message'=>__('messages.response.failed_ebill_store')];
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

        $ebill_shipping     = new EbillShipping();
        $ebill_id           = ($perameters['ebill_id']) ? $perameters['ebill_id'] : 0;
        $ebill_shipping->ebill_id  = $ebill_id;
        $shipping_type      = ($perameters['shipping_type']) ? $perameters['shipping_type'] : '1';
        $payment_mode       = ($perameters['payment_mode']) ? $perameters['payment_mode'] : '1';
        $ebill_shipping->shipping_type     = $shipping_type;
        $ebill_shipping->payment_mode      = $payment_mode;
        // if shipping type is transportation
        if($shipping_type == '1'){
            $ebill_shipping->transport_name     = ($perameters['transport_name']) ? $perameters['transport_name'] : '';
            $ebill_shipping->bill_number        = ($perameters['bill_number']) ? $perameters['bill_number'] : '';
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
        // if shipping type is courier
        }elseif($shipping_type == '2'){
            $ebill_shipping->courier_name       = ($perameters['courier_name']) ? $perameters['courier_name'] : '';
            $ebill_shipping->tracking_number    = ($perameters['tracking_number']) ? $perameters['tracking_number'] : '';
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
        // if shipping type is non-agro driver
        }elseif($shipping_type == '3'){
            $ebill_shipping->lt_driver_name     = ($perameters['lt_driver_name']) ? $perameters['lt_driver_name'] : '';
            $ebill_shipping->lt_driver_mobile   = ($perameters['lt_driver_mobile']) ? $perameters['lt_driver_mobile'] : '';
            $ebill_shipping->lt_vehcile_number  = ($perameters['lt_vehcile_number']) ? $perameters['lt_vehcile_number'] : '';
            $ebill_shipping->lt_owner_name      = ($perameters['lt_owner_name']) ? $perameters['lt_owner_name'] : '';
            // upload shipping driver image
            $file_driver = isset($perameters['lt_driver_img']) ? $perameters['lt_driver_img'] : '';
            if($file_driver){
                $filename   = $file_driver->getClientOriginalName();
                $name       = "profile_image";
                $extension  = $file_driver->extension();
                $filenew    =  date('d-M-Y').'_'.str_replace($filename,$name,$filename).'_'.time().''.rand(). "." .$extension;
                $file_driver->move(base_path('/public/uploads/driver'), $filenew);
                $driver_img   = asset('/uploads/driver/'.$filenew);
                $ebill_shipping->lt_driver_img   = $driver_img;
            }
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

            /*$driver = new Driver();
            $driver->name = ($perameters['lt_driver_name']) ? $perameters['lt_driver_name'] : '';
            $driver->mobile = ($perameters['lt_driver_mobile']) ? $perameters['lt_driver_mobile'] : '';
            $driver->profile_image = $driver_img;
            $driver->driver_otp = '123456';
            $driver->status = 1;
            $driver->save();*/
        }elseif($shipping_type == '4'){
            $ebill_shipping->pickup_date_time = ($perameters['pickup_date_time']) ? $perameters['pickup_date_time'] : '';
            $ebill_shipping->pickup_address   = ($perameters['pickup_address']) ? $perameters['pickup_address'] : '';
            $ebill_shipping->pickup_lat_long  = ($perameters['pickup_lat_long']) ? $perameters['pickup_lat_long'] : '';
            $ebill_shipping->drop_date_time   = ($perameters['drop_date_time']) ? $perameters['drop_date_time'] : '';
            $ebill_shipping->drop_address     = ($perameters['drop_address']) ? $perameters['drop_address'] : '';
            $ebill_shipping->drop_lat_long    = ($perameters['drop_lat_long']) ? $perameters['drop_lat_long'] : '';
            $ebill_shipping->shipping_distance = ($perameters['shipping_distance']) ? $perameters['shipping_distance'] : '';
        }
        $res = $ebill_shipping->save();
        if($res){
            $ebill = $ebill_shipping->ebill()->first();
            $ebill->shipping_status = 1;
            $ebill->save();
            // get admin data
            $adminTo = Admin::first();
            // if shipping type is non-agro driver
            if($shipping_type == '3'){
                // update or create driver and make relation between driver and shipping ebill
                $driver_data = [];
                $driver_data['name'] = ($perameters['lt_driver_name']) ? $perameters['lt_driver_name'] : '';
                $driver_data['mobile'] = ($perameters['lt_driver_mobile']) ? $perameters['lt_driver_mobile'] : '';
                $driver_data['profile_image'] = isset($driver_img) ? $driver_img : '';
                $driver_data['driver_otp'] = '123456';
                $driver_data['user_name'] = strtolower(str_replace(' ', '', $driver_data['name']));
                $driver_data['password'] = md5('123456');
                $driver_data['status'] = 1;
                $driver = Driver::updateOrCreate(['mobile' => $driver_data['mobile']],$driver_data);
                // Driver Tracking Associate Automatically
                /*$driver_tracking = new DriverTracking();
                $driver_tracking->ebill_id      = $ebill_id;
                $driver_tracking->shipping_id   = $ebill_shipping->id;
                $driver_tracking->driver_id     = $driver->id;
                $driver_tracking->status = 1;
                $driver_tracking->save();*/
                $ebill_shipping->driver_id     = $driver->id;
                $res = $ebill_shipping->save();

                $senderTo = User::find($ebill->user_id);
                if(!empty($senderTo)){
                    $senderTo->notify(new NotifySenderDriverRegistration($driver));
                }
            }
            // get user to notify about shipping
            $userTo = User::find($ebill->vendor_id);
            if(!empty($userTo)){
                $userTo->notify(new NotifyShippingStatus($ebill));
            }
            // if payment mode AgroPay then Notify to Admin by mail
            if($payment_mode == '3'){
                if(!empty($adminTo)){
                    $adminTo->notify(new NotifyAdminAgroPay($ebill));
                }
            }
            // if shipping Type AgroSerivce then Notify to Admin by mail
            if($shipping_type == '4'){
                if(!empty($adminTo)){
                    $adminTo->notify(new NotifyAdminAgroService($ebill));
                }
            }
            $data = ['status' => true, 'code' => 200, 'ebill_shipping' => $ebill_shipping, 'message'=>__('messages.response.success_shipping_store')];
        }else{
            $data = ['status' => false, 'code' => 500, 'message'=>__('messages.response.failed_shipping_store')];
        }
        return $data;
    }

    /**
     * Update a old created shipping in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function shippingUpdate(Request $request){
        $perameters = $request->all();
        $ebill_id   = $perameters['ebill_id'];
        $ebill_shipping_id = $perameters['ebill_shipping_id'];
        $ebill_shipping = EbillShipping::find($ebill_shipping_id);
        if(!empty($ebill_shipping)){
            $shipping_type      = ($perameters['shipping_type']) ? $perameters['shipping_type'] : '1';
            $payment_mode       = ($perameters['payment_mode']) ? $perameters['payment_mode'] : '1';
            $ebill_shipping->shipping_type     = $shipping_type;
            $ebill_shipping->payment_mode      = $payment_mode;
            // if shipping type is transportation
            if($shipping_type == '1'){
                $ebill_shipping->transport_name     = ($perameters['transport_name']) ? $perameters['transport_name'] : '';
                $ebill_shipping->bill_number        = ($perameters['bill_number']) ? $perameters['bill_number'] : '';
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
                $ebill_shipping->shipping_status   = 1;
            // if shipping type is courier
            }elseif($shipping_type == '2'){
                $ebill_shipping->courier_name       = ($perameters['courier_name']) ? $perameters['courier_name'] : '';
                $ebill_shipping->tracking_number    = ($perameters['tracking_number']) ? $perameters['tracking_number'] : '';
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
                $ebill_shipping->shipping_status   = 1;
            // if shipping type is non-agro driver
            }elseif($shipping_type == '3'){
                $ebill_shipping->lt_driver_name     = ($perameters['lt_driver_name']) ? $perameters['lt_driver_name'] : '';
                $ebill_shipping->lt_driver_mobile   = ($perameters['lt_driver_mobile']) ? $perameters['lt_driver_mobile'] : '';
                $ebill_shipping->lt_vehcile_number  = ($perameters['lt_vehcile_number']) ? $perameters['lt_vehcile_number'] : '';
                $ebill_shipping->lt_owner_name      = ($perameters['lt_owner_name']) ? $perameters['lt_owner_name'] : '';
                // upload shipping driver image
                $file_driver = isset($perameters['lt_driver_img']) ? $perameters['lt_driver_img'] : '';
                if($file_driver){
                    $filename   = $file_driver->getClientOriginalName();
                    $name       = "profile_image";
                    $extension  = $file_driver->extension();
                    $filenew    =  date('d-M-Y').'_'.str_replace($filename,$name,$filename).'_'.time().''.rand(). "." .$extension;
                    $file_driver->move(base_path('/public/uploads/driver'), $filenew);
                    $driver_img   = asset('/uploads/driver/'.$filenew);
                    $ebill_shipping->lt_driver_img   = $driver_img;
                }
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
                $ebill_shipping->shipping_status   = 1;
            }elseif($shipping_type == '4'){
                $ebill_shipping->pickup_date_time = ($perameters['pickup_date_time']) ? $perameters['pickup_date_time'] : '';
                $ebill_shipping->pickup_address   = ($perameters['pickup_address']) ? $perameters['pickup_address'] : '';
                $ebill_shipping->pickup_lat_long  = ($perameters['pickup_lat_long']) ? $perameters['pickup_lat_long'] : '';
                $ebill_shipping->drop_date_time   = ($perameters['drop_date_time']) ? $perameters['drop_date_time'] : '';
                $ebill_shipping->drop_address     = ($perameters['drop_address']) ? $perameters['drop_address'] : '';
                $ebill_shipping->drop_lat_long    = ($perameters['drop_lat_long']) ? $perameters['drop_lat_long'] : '';
                $ebill_shipping->shipping_status   = 0;
            }

            $res = $ebill_shipping->save();
            if($res){
                if($shipping_type == '3'){
                    $driver_data = [];
                    $driver_data['name'] = ($perameters['lt_driver_name']) ? $perameters['lt_driver_name'] : '';
                    $driver_data['mobile'] = ($perameters['lt_driver_mobile']) ? $perameters['lt_driver_mobile'] : '';
                    $driver_data['profile_image'] = isset($driver_img) ? $driver_img : '';
                    $driver_data['driver_otp'] = '123456';
                    $driver_data['user_name'] = strtolower(str_replace(' ', '', $driver_data['name']));
                    $driver_data['password'] = md5('123456');
                    $driver_data['status'] = 1;
                    $driver = Driver::updateOrCreate(['mobile' => $driver_data['mobile']],$driver_data);
                    // Driver Tracking Associate Automatically
                    $driver_tracking = new DriverTracking();
                    $driver_tracking->ebill_id      = $ebill_id;
                    $driver_tracking->shipping_id   = $ebill_shipping->id;
                    $driver_tracking->driver_id     = $driver->id;
                    $driver_tracking->status = 1;
                    $driver_tracking->save();
                }

                return ['status' => true, 'code' => 200, 'data'=>$ebill_shipping, 'message'=>__('messages.response.success_shipping_update')];
            }else{
                return ['status' => false, 'code' => 500, 'message' => __('messages.response.failed_shipping_update')];
            }
        }else{
            return ['status' => false, 'code' => 404, 'message' => __('messages.response.error_404')];
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ebill  $ebill
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ebill = Ebill::with(['user', 'vendor', 'products', 'expenses', 'shipping'])->where('id', $id)->first();
        if($ebill){
            return ['status' => true, 'code' => 200, 'data'=>$ebill];
        }else{
            return ['status' => false, 'code' => 404, 'message' => "data not found"];
        }
    }

    public function shippingDriverInfo(Request $request){
        $data = [];
        $post = $request->all();
        $data['driver'] = Driver::find($request->input('driver_id'));
        $data['driver_tracking'] = DriverTracking::where('ebill_id',$request->input('driver_id'))
                                        ->where('shipping_id',$request->input('shipping_id'))
                                        ->where('driver_id',$request->input('driver_id'))
                                        ->orderBy('id', 'DESC')
                                        ->first();
        if($data){
            return ['status' => true, 'code' => 200, 'data'=>$data];
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
                return ['status' => true, 'code' => 200, 'message' => __('messages.response.success_ebill_product_delete')];
            }else{
                return ['status' => false, 'code' => 500, 'message' => __('messages.response.failed_ebill_product_delete')];
            }
        }else{
            return ['status' => false, 'code' => 404, 'message' => __('messages.response.error_404')];
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
        
        $ebill_product->product_volume_type = $request->input('product_volume_type');
        $ebill_product->batch_number = $request->input('batch_number');
        $ebill_product->expiry_date = $request->input('expiry_date');
        
        $ebill_product->product_tax     = ($request->input('product_tax')) ? $request->input('product_tax') : 0;
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
            return ['status' => true, 'code' => 200, 'data'=>$ebill_product, 'message' => __('messages.response.success_ebill_product_store')];
        }else{
            return ['status' => false, 'code' => 500, 'message' => __('messages.response.failed_ebill_product_store')];
        }
    }

    // show ebill product by product id
    public function showProduct($id){
        $ebill_product = EbillProducts::find($id);
        if(!empty($ebill_product)){
            return ['status' => true, 'code' => 200, 'data'=>$ebill_product];
        }else{
            return ['status' => false, 'code' => 404, 'message' => "data not found."];
        }
    }

    /**/
    public function editProduct(Request $request){
        $ebill_product_id     = $request->input('ebill_product_id');
        $ebill_product = EbillProducts::find($ebill_product_id);
        // dd($ebill_product);
        if($ebill_product){
            $ebill_product->category_id     = $request->input('category_id');
            $ebill_product->subcategory_id  = $request->input('subcategory_id');
            $ebill_product->commodity_id    = $request->input('commodity_id');
            $ebill_product->product_name    = $request->input('product_name');
            $ebill_product->packet_number   = $request->input('packet_number');
            $ebill_product->total_volume    = ($request->input('total_volume')) ? $request->input('total_volume') : 0;
            $ebill_product->volume_unit     = ($request->input('volume_unit')) ? $request->input('volume_unit') : '';
            $ebill_product->product_rate    = $request->input('product_rate');
            $ebill_product->rate_unit       = $request->input('rate_unit');
            
            $ebill_product->product_volume_type = $request->input('product_volume_type');
            $ebill_product->batch_number = $request->input('batch_number');
            $ebill_product->expiry_date = $request->input('expiry_date');
            
            $ebill_product->product_tax     = ($request->input('product_tax')) ? $request->input('product_tax') : 0;
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
                return ['status' => true, 'code' => 200, 'data'=>$ebill_product, 'message' => __('messages.response.success_ebill_product_update')];
            }else{
                return ['status' => false, 'code' => 500, 'message' => __('messages.response.failed_ebill_product_update')];
            }
        }else{
            return ['status' => false, 'code' => 404, 'message' => __('messages.response.error_404')];
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
                $userTo = User::find($ebill->user_id);
                if(!empty($userTo)){
                    $userTo->notify(new NotifyRfpUpdated($ebill));
                }
                return ['status' => true, 'code' => 200, 'data'=>$ebill, 'message' => __('messages.response.success_rfp_status_update')];
            }else{
                return ['status' => false, 'code' => 500, 'message' => __('messages.response.failed_rfp_status_update')];
            }
        }else{
            return ['status' => false, 'code' => 404, 'message' => __('messages.response.error_404')];
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

            // if ebill shipping is not empty
            if($ebill_shipping = $ebill->shipping){
                // if payment mode is PrePaid
                if($ebill_shipping->payment_mode == '2'){
                    $userTo   = User::find($ebill->user_id);
                    if(!empty($userTo)){
                        $userTo->notify(new NotifyPaymentProcessSender($ebill));
                    }
                }
                // if payment mode is AgroPay
                if($ebill_shipping->payment_mode == '3'){
                    $adminTo = Admin::first();
                    if(!empty($adminTo)){
                        $adminTo->notify(new NotifyPaymentProcessAdmin($ebill));
                    }
                }
            }
            return ['status' => true, 'code' => 200, 'data'=>$ebill_tran, 'message' => __('messages.response.success_ebill_transaction')];
        }else{
            return ['status' => false, 'code' => 500, 'message' => __('messages.response.failed_ebill_transaction')];
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
                $vendorTo   = User::find($ebill->vendor_id);
                if(!empty($vendorTo)){
                    $vendorTo->notify(new SenderNotifyPaymentStatusReceiver($ebill));
                }
                return ['status' => true, 'code' => 200, 'data'=>$ebill, 'message' => __('messages.response.success_payment_status')];
            }else{
                return ['status' => false, 'code' => 500, 'message' => __('messages.response.failed_payment_status')];
            }
        }else{
            return ['status' => false, 'code' => 404, 'message' => __('messages.response.error_404')];
        }
    }


    public function ebillTransactionList(Request $request){
        $user_id = $request->input('user_id');
        $ebill_transaction_sends = EbillTransaction::with(['ebill', 'receiver'])->where('sender_id', $user_id)->get();
        $ebill_transaction_recieves = EbillTransaction::with(['ebill', 'sender'])->where('receiver_id', $user_id)->get();
        if($ebill_transaction_sends){
            $data['sends'] = $ebill_transaction_sends;
            $data['recieves'] = $ebill_transaction_recieves;
            return ['status' => true, 'code' => 200, 'data'=>$data, 'message' => __('messages.response.success_ebill_transaction')];
        }else{
            return ['status' => false, 'code' => 404, 'message' => __('messages.response.error_404')];
        }
    }

}
