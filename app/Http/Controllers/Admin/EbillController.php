<?php

namespace App\Http\Controllers\Admin;

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

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; 
use Illuminate\Support\Facades\DB;

// Notification
use App\Notifications\AdminNotifyShippingStatusSender;
use App\Notifications\AdminNotifyPaymentStatusReceiver;
use App\Notifications\NotifyDriverNewOrderReceive;

// Datatables
use DataTables;

class EbillController extends Controller
{
    // note : '0=pending', '1=success', '2=processed by receiver', '3=hold by admin', '4=accept by admin', '5=decline by admin', '6=processed by admin', '7=cancel by sender'
    private $payment_status = [
        ['key'=>0, 'value'=>'pending', 'color'=>'warning'],
        ['key'=>1, 'value'=>'success', 'color'=>'success'],
        ['key'=>2, 'value'=>'processed by receiver', 'color'=>'primary'],
        ['key'=>3, 'value'=>'hold by admin', 'color'=>'primary'],
        ['key'=>4, 'value'=>'accept by admin', 'color'=>'success'],
        ['key'=>5, 'value'=>'decline by admin', 'color'=>'danger'],
        ['key'=>6, 'value'=>'processed by admin', 'color'=>'primary'],
        ['key'=>7, 'value'=>'cancel by sender', 'color'=>'danger'],
    ];
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payment_status = $this->payment_status;
        return view('admin.ebills.index', compact('payment_status'));
    }
    public function EbillsData(Request $request){
        
        $ebills = Ebill::with(['user', 'vendor'])->orderBy('id', 'DESC')->select('ebills.*');

        return DataTables::of($ebills)
                ->addColumn('transaction_amount', function($ebills){
                    $ebills_transaction = '';
                    /*$ebills_transaction = ($ebills->transaction) ? $ebills->transaction->first() : '';
                    return ($ebills_transaction) ? $ebills_transaction->transaction_amount : '';*/
                    if(!empty($ebills->transaction)){
                        $ebills_transaction = $ebills->transaction->first();
                    }
                    return ($ebills_transaction) ? $ebills_transaction->transaction_amount : '';;
                })
                ->addColumn('transaction_receipt', function($ebills){
                    $ebills_transaction = ($ebills->transaction) ? $ebills->transaction->first() : '';
                    $receipt_btn = '';
                    if($ebills_transaction){
                        $receipt_btn = $receipt_btn.'<a class="btn btn-xs btn-info" href="'.$ebills_transaction->transaction_receipt.'" role="button" title="open in new tab" target="_blank" ><i class="fas fa-download"></i></a>&nbsp;';
                    }
                    return $receipt_btn;
                })
                ->editColumn('rfp_status', function($ebills){
                    return ($ebills->rfp_status == '0') ? "<span class='badge bg-warning'>Pending</span>" : (($ebills->rfp_status == '1') ? "<span class='badge bg-success'>Active</span>" : "<span class='badge bg-danger'>Decline</span>");
                })
                ->editColumn('shipping_status', function($ebills){
                    return ($ebills->shipping_status == '0') ? "<span class='badge bg-warning'>Pending</span>" : (($ebills->shipping_status == '1') ? "<span class='badge bg-success'>Active</span>" : "<span class='badge bg-danger'>Decline</span>");
                })
                ->editColumn('payment_status', function ($ebills) {
                    // echo "<pre>";print_r($this->payment_status);die;
                    foreach($this->payment_status as $pstatus){
                        if($ebills->payment_status == $pstatus['key']){
                            return "<span class='badge bg-".$pstatus['color']."'>".$pstatus['value']."</span>";
                        }
                    }
                })
                ->editColumn('is_delivered', function($ebills){
                    return ($ebills->is_delivered == 0) ? "<span class='badge bg-danger'>Nop!</span>" : "<span class='badge bg-success'>Yeah!</span>";
                })
                ->addColumn('download_ebill', function ($ebills) {
                    if($ebills->ebill_pdf){
                        $download_btn = '';
                        $download_btn = $download_btn.'<a class="btn btn-xs btn-info" href="'.$ebills->ebill_pdf.'" role="button" title="Download" download ><i class="fas fa-download"></i></a>&nbsp;';
                        return $download_btn;
                    }
                })
                ->addColumn('action', function ($ebills) {
                    $btn_html = '';
                    $btn_html = $btn_html.'<a class="btn btn-xs btn-info" href="'.route('admin.ebills.show', $ebills).'" role="button" title="View"><i class="fas fa-eye"></i></a>&nbsp;';
                    return $btn_html;
                })
                ->filter(function ($query) use ($request) {
                    // filter for order id
                    if ($request->input('order_id') != '') {
                        $query->where('order_id', 'like', "%{$request->input('order_id')}%");
                    }
                    // filter for bill_number
                    if ($request->input('bill_number') != '') {
                        $query->where('bill_number', 'like', "%{$request->input('bill_number')}%");
                    }
                    // filter for RFP status
                    if ($request->input('rfp_status') != '') {
                        $query->where('rfp_status', $request->input('rfp_status'));
                    }
                    // filter for Shipping Status
                    if ($request->input('shipping_status') != '') {
                        $query->where('shipping_status', $request->input('shipping_status'));
                    }
                    // filter for Payment Status
                    if ($request->input('payment_status') != '') {
                        $query->where('payment_status', $request->input('payment_status'));
                    }
                    // filter for Is Delivered
                    if ($request->input('is_delivered') != '') {
                        $query->where('is_delivered', $request->input('is_delivered'));
                    }
                })
                ->rawColumns(['transaction_amount', 'transaction_receipt', 'rfp_status', 'shipping_status', 'payment_status', 'is_delivered', 'download_ebill', 'action'])
                ->make(true);
    }
    /**
     * Display a listing of the pending shipping.
     *
     * @return \Illuminate\Http\Response
     */
    public function shipping_index()
    {
        /*$ebills = Ebill::with(['shipping'])->whereHas('shipping', function ($query) {
            $query->where('shipping_type', 4);
        })->orderBy('id', 'DESC')->get();*/
        return view('admin.ebills.shipping_index');
    }
    public function ebillShippingData(Request $request){
        // Retrieve ebills shipping where shipping_type = 4 (agro service)
        $ebill_shippings = EbillShipping::with(['ebill'])->where('shipping_type', 4)
                                ->orderBy('id', 'DESC')
                                ->select('ebill_shippings.*');
        return DataTables::of($ebill_shippings)

                ->editColumn('shipping_status', function($ebill_shippings){
                    return ($ebill_shippings->shipping_status == '0') ? "<span class='badge bg-warning'>Pending</span>" : (($ebill_shippings->shipping_status == '1') ? "<span class='badge bg-success'>Approved</span>" : "<span class='badge bg-danger'>Decline</span>");
                })
                ->editColumn('payment_mode', function ($ebill_shippings) {
                    return ($ebill_shippings->payment_mode == '1') ? "<span class='badge bg-info'>COD</span>" : (($ebill_shippings->payment_mode == '2') ? "<span class='badge bg-info'>Pre Paid</span>" : "<span class='badge bg-info'>AgroPay</span>");
                })
                ->addColumn('multi_select_shipping', function ($ebill_shippings) {
                    $btn_html = '';
                    if($ebill_shippings->shipping_status == 0){
                        $btn_html = $btn_html.'<input type="checkbox" class="shipping_checkbox" id="shipping_id_'.$ebill_shippings->id.'" value="'.$ebill_shippings->id.'" >';
                    }                    
                    return $btn_html;
                })
                ->addColumn('action', function ($ebill_shippings) {
                    $btn_html = '';
                    if($ebill_shippings->shipping_status == 0){
                        $btn_html = $btn_html.'<a class="btn btn-xs btn-success ajax-accept" href="'.route("admin.ebill.shipping.accept", $ebill_shippings->id).'" role="button" title="Accept"><i class="fas fa-check"></i></a>';
                        $btn_html = $btn_html.'<a class="btn btn-xs btn-danger ajax-decline" href="'.route("admin.ebill.shipping.decline", $ebill_shippings->id).'" role="button" title="Decline"><i class="fas fa-times"></i></a>';
                    }                    
                    // $btn_html = $btn_html.'<a class="btn btn-xs btn-info" href="javascript:;" role="button" title="View"><i class="fas fa-eye"></i></a>&nbsp;';
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
                })
                ->rawColumns(['payment_mode','shipping_status','action', 'multi_select_shipping'])
                ->make(true);
    }
    /**
     * Display a listing of the holding ebill payment.
     *
     * @return \Illuminate\Http\Response
     */
    public function ebillHoldingPayment()
    {
        $payment_status = $this->payment_status;
        /*$ebill_shippings = EbillShipping::with(['ebill'])
            ->whereHas('ebill', function($query){
                $query->where('payment_status', '!=' ,1);
            })
            ->where(function($query){
                $query->orWhere(function($query) {
                    $query->where('shipping_type', 3);
                    $query->where('payment_mode', 3);
                });
                $query->orWhere(function($query) {
                    $query->where('shipping_type', 4);
                    $query->where(function($query) {
                        $query->orWhere('payment_mode', 1);
                        $query->orWhere('payment_mode', 3);
                    });
                });
            })
        ->orderBy('id', 'DESC')
        ->get();*/
        return view('admin.ebills.pay_holding_index', compact('payment_status'));
    }
    public function payHoldingData(Request $request){
        $ebills = Ebill::with(['user', 'vendor', 'shipping'])
                    ->where('payment_status', '!=' ,1)
                    ->whereHas('shipping', function($query){
                        $query->where(function($query){
                            $query->orWhere(function($query) {
                                $query->where('shipping_type', 3);
                                $query->where('payment_mode', 3);
                            });
                            $query->orWhere(function($query) {
                                $query->where('shipping_type', 4);
                                $query->where(function($query) {
                                    $query->orWhere('payment_mode', 1);
                                    $query->orWhere('payment_mode', 3);
                                });
                            });
                        });
                    })
                    ->orderBy('id', 'DESC')
                    ->select('ebills.*');

        return DataTables::of($ebills)
                ->editColumn('rfp_status', function($ebills){
                    return ($ebills->rfp_status == '0') ? "<span class='badge bg-warning'>Pending</span>" : (($ebills->rfp_status == '1') ? "<span class='badge bg-success'>Active</span>" : "<span class='badge bg-danger'>Decline</span>");
                })
                ->editColumn('shipping_status', function($ebills){
                    return ($ebills->shipping_status == '0') ? "<span class='badge bg-warning'>Pending</span>" : (($ebills->shipping_status == '1') ? "<span class='badge bg-success'>Active</span>" : "<span class='badge bg-danger'>Decline</span>");
                })
                ->editColumn('payment_status', function ($ebills) {
                    // echo "<pre>";print_r($this->payment_status);die;
                    foreach($this->payment_status as $pstatus){
                        if($ebills->payment_status == $pstatus['key']){
                            return "<span class='badge bg-".$pstatus['color']."'>".$pstatus['value']."</span>";
                        }
                    }
                })
                ->editColumn('is_delivered', function($ebills){
                    return ($ebills->is_delivered == 0) ? "<span class='badge bg-danger'>Nop!</span>" : "<span class='badge bg-success'>Yeah!</span>";
                })
                ->addColumn('action', function ($ebills) {
                    $btn_html = '';
                    // <!-- if payment status '2=processed by receiver', '7=cancel by sender' -->
                    if(in_array($ebills->payment_status, [2,7]) && $ebills->is_delivered == 0 ){
                        $btn_html = $btn_html.'<a class="btn btn-xs btn-success ajax-accept" href="'.route("admin.ebill.holding_payment.accept", $ebills->id).'" role="button" title="Accept"><i class="fas fa-check"></i></a>';
                        $btn_html = $btn_html.'<a class="btn btn-xs btn-danger ajax-decline" href="'.route("admin.ebill.holding_payment.decline", $ebills->id).'" role="button" title="Decline"><i class="fas fa-times"></i></a>';
                    }
                    // <!-- if payment status '3=hold by admin', '4=accept by admin' -->
                    elseif(in_array($ebills->payment_status, [3,4,7]) && $ebills->is_delivered == 1 ){
                        // <!-- ebill.holding_payment.processed -->
                        $btn_html = $btn_html.'<a class="btn btn-xs btn-success ajax-accept" href="'.route('admin.ebill.holding_payment.processed', $ebills->id).'" role="button" title="Processed"><i class="fas fa-check-circle"></i></a>';
                    }
                    return $btn_html;
                })
                ->filter(function ($query) use ($request) {
                    // filter for order id
                    if ($request->input('order_id') != '') {
                        $query->where('order_id', 'like', "%{$request->input('order_id')}%");
                    }
                    // filter for bill_number
                    if ($request->input('bill_number') != '') {
                        $query->where('bill_number', 'like', "%{$request->input('bill_number')}%");
                    }
                    // filter for RFP status
                    if ($request->input('rfp_status') != '') {
                        $query->where('rfp_status', $request->input('rfp_status'));
                    }
                    // filter for Shipping Status
                    if ($request->input('shipping_status') != '') {
                        $query->where('shipping_status', $request->input('shipping_status'));
                    }
                    // filter for Payment Status
                    if ($request->input('payment_status') != '') {
                        $query->where('payment_status', $request->input('payment_status'));
                    }
                    // filter for Is Delivered
                    if ($request->input('is_delivered') != '') {
                        $query->where('is_delivered', $request->input('is_delivered'));
                    }
                })
                ->rawColumns(['rfp_status','shipping_status','payment_status','is_delivered','action'])
                ->make(true);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function holdingPaymentAccept($ebill_id)
    {
        $ebill = Ebill::find($ebill_id);
        if($ebill){
            $ebill->payment_status = 4;
            $res = $ebill->save();
            if($res){
                $vendorTo   = User::find($ebill->vendor_id);
                if(!empty($vendorTo)){
                    $vendorTo->notify(new AdminNotifyPaymentStatusReceiver($ebill));
                }
                return ['status' => true, 'code' => 200, 'data'=>$ebill];
            }else{
                return ['status' => false, 'code' => 404, 'message'=>'something went wrong in database'];
            }
        }else{
            return ['status' => false, 'code' => 404, 'message'=>'data not found'];
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function holdingPaymentDecline($ebill_id)
    {
        $ebill = Ebill::find($ebill_id);
        if($ebill){
            $ebill->payment_status = 5;
            $res = $ebill->save();
            if($res){
                $vendorTo   = User::find($ebill->vendor_id);
                if(!empty($vendorTo)){
                    $vendorTo->notify(new AdminNotifyPaymentStatusReceiver($ebill));
                }
                return ['status' => true, 'code' => 200, 'data'=>$ebill];
            }else{
                return ['status' => false, 'code' => 404, 'message'=>'something went wrong in database'];
            }
        }else{
            return ['status' => false, 'code' => 404, 'message'=>'data not found'];
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function holdingPaymentProcessed($ebill_id)
    {
        $ebill = Ebill::find($ebill_id);
        if($ebill){
            $ebill->payment_status = 6;
            $res = $ebill->save();
            // dd($ebill);
            return ['status' => true, 'code' => 200, 'data'=>$ebill];
        }else{
            return ['status' => false, 'code' => 404, 'message'=>'data not found'];
        }
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addDriver( EbillShipping $ebill_shipping)
    {
        $drivers = Driver::where('status', 1)->get();
        $driver_track = DriverTracking::where("shipping_id", $ebill_shipping->id)->first();
        $driver_id = ($driver_track) ? $driver_track->driver_id : 0;
        return view('admin/ebills/add_driver', compact('drivers', 'ebill_shipping', 'driver_id') )->render();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function driverShippingStore(Request $request)
    {
        $data = [];
        $driver_tracking = new DriverTracking();

        $data['ebill_id']    = $request->input('ebill_id');
        $data['shipping_id'] = $request->input('shipping_id');
        $data['driver_id']   = $request->input('driver_id');        
        $res = DriverTracking::updateOrCreate(['shipping_id'=>$request->input('shipping_id'), 'ebill_id'=>$request->input('ebill_id')], $data);
        if($res){
            $driver = Driver::find($data['driver_id']);
            $ebill = Ebill::find($data['ebill_id']);
            if(!empty($driver && $ebill)){
                $driver->notify(new NotifyDriverNewOrderReceive($ebill));
            }
            return response()->json([
                'success'=>'The driver has been successfully added.'
            ]);
        }else{
            return response()->json([
                'danger'=>'something went wrong with database.'
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Ebill $ebill)
    {
        if(!empty($ebill)){
            return view('admin.ebills.show', compact('ebill'));
        }else{
            return redirect(route('admin.ebills.index'))->with('fail', 'Ebill Not found');
        }
    }

    public function shippingAccept($ebill_shipping_id){
        $ebill_shipping = EbillShipping::find($ebill_shipping_id);
        return view('admin/ebills/shipping_accept_form', compact('ebill_shipping') )->render();
    }

    public function shippingDecline($ebill_shipping_id){
        $ebill_shipping = EbillShipping::find($ebill_shipping_id);
        return view('admin/ebills/shipping_decline_form', compact('ebill_shipping') )->render();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function shippingAcceptSave(Request $request)
    {
        $ebill_shipping_id = $request->input('shipping_id');
        $request->validate([
            'shipping_charge' => 'required|numeric',
        ]);
        $ebill_shipping = EbillShipping::find($ebill_shipping_id);
        $ebill = $ebill_shipping->ebill()->first();
        if($ebill_shipping){
            $ebill_shipping->shipping_status = 1;
            $ebill_shipping->shipping_charge = $request->input('shipping_charge');
            $ebill_shipping->shipping_description = $request->input('shipping_description');
            $res = $ebill_shipping->save();
            if($res){
                $userTo   = User::find($ebill->user_id);
                if(!empty($userTo)){
                    $userTo->notify(new AdminNotifyShippingStatusSender($ebill, $ebill_shipping));
                }
                return ['status' => true, 'code' => 200, 'data'=>$ebill_shipping];
            }else{
                return ['status' => false, 'code' => 404, 'message'=>'something went wrong in database'];
            }
        }else{
            return ['status' => false, 'code' => 404, 'message'=>'data not found'];
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function shippingDeclineSave(Request $request)
    {
        $ebill_shipping_id = $request->input('shipping_id');
        $request->validate([
            'decline_reason' => 'required',
        ]);
        $ebill_shipping = EbillShipping::find($ebill_shipping_id);
        $ebill = $ebill_shipping->ebill()->first();
        if($ebill_shipping){
            $ebill_shipping->shipping_status = 2;
            $ebill_shipping->decline_reason = $request->input('decline_reason');
            $res = $ebill_shipping->save();
            if($res){
                $userTo   = User::find($ebill->user_id);
                if(!empty($userTo)){
                    $userTo->notify(new AdminNotifyShippingStatusSender($ebill, $ebill_shipping));
                }
                return ['status' => true, 'code' => 200, 'data'=>$ebill_shipping];
            }else{
                return ['status' => false, 'code' => 404, 'message'=>'something went wrong in database'];
            }
        }else{
            return ['status' => false, 'code' => 404, 'message'=>'data not found'];
        }
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
