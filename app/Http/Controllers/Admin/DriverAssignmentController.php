<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Driver;
use App\Models\EbillShipping;

// Datatables
use DataTables;

class DriverAssignmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $drivers = Driver::where('status', 1)->where('driver_type', 2)->get();
        return view('admin.driver_assignments.shipping_index', compact('drivers'));
    }
    /**
     * data listing of the accepted shipping.
     *
     * @return \Illuminate\Http\Response
     */
    public function ebillShippingData(Request $request){
        // Retrieve ebills shipping where shipping_type = 4 (agro service)
        $ebill_shippings = EbillShipping::with(['ebill'])
                                ->where('shipping_type', 4)
                                ->where('shipping_status', 1)
                                ->where('driver_id', 0)
                                ->orderBy('id', 'DESC')
                                ->select('ebill_shippings.*');
        return DataTables::of($ebill_shippings)

                ->editColumn('shipping_status', function($ebill_shippings){
                    return ($ebill_shippings->shipping_status == '0') ? "<span class='badge bg-warning'>Pending</span>" : (($ebill_shippings->shipping_status == '1') ? "<span class='badge bg-success'>Approved</span>" : "<span class='badge bg-danger'>Decline</span>");
                })
                ->editColumn('payment_mode', function ($ebill_shippings) {
                    return ($ebill_shippings->payment_mode == '1') ? "<span class='badge bg-info'>COD</span>" : (($ebill_shippings->payment_mode == '2') ? "<span class='badge bg-info'>Pre Paid</span>" : "<span class='badge bg-info'>AgroPay</span>");
                })
                ->editColumn('pickup_date_time', function ($ebill_shippings) {
                    return date("Y-m-d", strtotime($ebill_shippings->pickup_date_time));
                })
                ->editColumn('drop_date_time', function ($ebill_shippings) {
                    return date("Y-m-d", strtotime($ebill_shippings->drop_date_time));
                })
                ->addColumn('action', function ($ebill_shippings) {
                    $btn_html = '';
                    if($ebill_shippings->shipping_status == 1){
                        $btn_html = $btn_html.'<input type="checkbox" class="shipping_checkbox" id="shipping_id_'.$ebill_shippings->id.'" value="'.$ebill_shippings->id.'" >';
                    }                    
                    return $btn_html;
                })
                ->filter(function ($query) use ($request) {
                    // filter for order id
                    if ($request->input('order_id') != '') {
                        $query->whereHas('ebill', function($query) use($request) {
                            $query->where('order_id', 'like', "%{$request->input('order_id')}%");
                        });
                    }
                    // filter for bill_number
                    if ($request->input('bill_number') != '') {
                        $query->whereHas('ebill', function($query) use($request) {
                            $query->where('bill_number', 'like', "%{$request->input('bill_number')}%");
                        });
                    }
                    // filter for Shipping Status
                    if ($request->input('shipping_status') != '') {
                        $query->where('shipping_status', $request->input('shipping_status'));
                    }
                    // filter for Payment Status
                    if ($request->input('payment_mode') != '') {
                        $query->where('payment_mode', $request->input('payment_mode'));
                    }
                    // filter for Pickup date
                    if ($request->input('pickup_date_time') != '') {
                        $from = $request->input('pickup_date_time')." 00:00:01";
                        $to = $request->input('pickup_date_time')." 23:59:59";
                        $query->whereBetween('pickup_date_time', [$from, $to]);
                    }
                })
                ->rawColumns(['payment_mode','shipping_status','action'])
                ->make(true);
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
        $driver_id = $request->input('driver_id');
        $shippings = $request->input('shipping_ides');
        $data = [];
        if(!empty($shippings)){
            foreach($shippings as $shipping_id){
                $shipping = EbillShipping::find($shipping_id);
                if($shipping){
                    $shipping->driver_id = $driver_id;
                    $shipping->save();
                    $data[] = ['status' => true, 'code' => 200, 'data' => $shipping];
                }else{
                    $data[] = ['status' => false, 'code' => 404, 'msg' => 'shipping not found', 'shipping_id'=>$shipping_id];
                }
            }
        }else{
            return ['status' => false, 'code' => 404, 'msg' => 'data not found'];
        }
        return $data;
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
    public function delete(Request $request)
    {
        //
        $shipping = EbillShipping::find($request->input('id'));
        if($shipping){
            $shipping->driver_id = 0;
            $shipping->save();
            return ['status' => true, 'code' => 200, 'data'=>$shipping];
        }else{
            return ['status' => false, 'code' => 404, 'message'=>'data not found'];
        }
    }
}
