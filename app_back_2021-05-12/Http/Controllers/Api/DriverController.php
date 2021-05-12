<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Driver;
use Illuminate\Support\Facades\Hash;
use App\Models\DriverTracking;
use App\Models\Ebill;
use App\Models\EbillShipping;
use App\Models\User;

// Notification
use App\Notifications\SendEmailOtpToUser;
use App\Notifications\NotifyUserPickUpDone;

class DriverController extends Controller
{
    public function login(Request $request ){
    	$mobile 	= $request->input('mobile');
    	$password 	= md5($request->input('password'));
    	$driver_type = $request->input('driver_type');
        $device_id  = $request->input('device_id');

    	$driver 	= Driver::where('status', 1)
    					->where('mobile', $mobile)
    					->where('driver_type', $driver_type)
    					->where('password', $password)
    					->first();
    	if($driver){
            $driver->device_id = $device_id;
            $res = $driver->save();
    		$data = ['status' => true, 'code' => 200, 'driver' => $driver];
    	}else{
    		$data = ['status' => false, 'code' => 404, 'msg' => 'Driver not found'];
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

    public function driverTrackingList(Request $request){
        $perameters = $request->all();
        $driver_id = $request->input('driver_id');
        $pickup_lists = EbillShipping::with(['ebill'])
                    ->where('driver_id', $driver_id)
                    ->whereHas('ebill', function($query) use($perameters) {
                        $query->where('pickup_status', 0);
                    })
                    ->get();
        if($pickup_lists){
            $data['pickup_lists'] = $pickup_lists;
        }
        $drop_lists = EbillShipping::with(['ebill'])
                    ->where('driver_id', $driver_id)
                    ->whereHas('ebill', function($query) use($perameters) {
                        $query->where('pickup_status', 1);
                    })
                    ->get();
        if($drop_lists){
            $data['drop_lists'] = $drop_lists;
        }

        if($data){
            return ['status'=>true, 'code'=>200, 'data'=>$data];
        }else{
            return ['status'=>false, 'code'=>404, 'msg'=>'data not found'];
        }
    }
    /**
     * Delivery View
     *
     *
     */
    public function driverTrackingDeliveryView(Request $request){
        $id         = $request->input('id');
        $user_id    = $request->input('user_id');
        $vendor_id  = $request->input('vendor_id');
        $perameters = $request->all();
        $driver_id  = $request->input('driver_id');
        $view = EbillShipping::with(['ebill'])
                    ->where('id', $id)
                    ->where('driver_id', $driver_id)
                    ->first();
        $user       = User::find($user_id);
        $vendor     = User::find($vendor_id);
        $data = ['view'=>$view, 'user'=>$user, 'vendor'=>$vendor];
        if($data){
            return ['status'=>true, 'code'=>200, 'data'=>$data];
        }else{
            return ['status'=>false, 'code'=>404, 'msg'=>'data not found'];   
        }
    }

    /**
     * Send pickup OTP
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function sendPickupOtp(Request $request){
        $perameters = $request->all();
        $ebill_id = $perameters['ebill_id'];
        $ebill = Ebill::where('id', $ebill_id)->where('pickup_status', 0)->first();
        if($ebill){
            $ebill->pickup_otp = '123456';
            $res = $ebill->save();
            if($res){
                $userTo   = User::find($ebill->user_id);
                if(!empty($userTo)){
                    // $userTo->notify(new SendEmailOtpToUser($ebill));
                }
                $data = ['status' => true, 'code' => 200, 'msg'=>'otp send successfully'];
            }else{
                $data = ['status' => false, 'code' => 403, 'msg'=>'something went wrong'];
            }
        }else{
            $data = ['status' => false, 'code' => 404, 'msg'=>'data not found'];
        }
        return $data;
    }

    /**
     * Resend pickup OTP
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function resendPickupOtp(Request $request){
        $perameters = $request->all();
        $ebill_id = $perameters['ebill_id'];
        $ebill = Ebill::where('id', $ebill_id)->where('pickup_status', 0)->first();
        if($ebill){
            $ebill->pickup_otp = '123456';
            $res = $ebill->save();
            if($res){
                $userTo   = User::find($ebill->user_id);
                if(!empty($userTo)){
                    // $userTo->notify(new SendEmailOtpToUser($ebill));
                }
                $data = ['status' => true, 'code' => 200, 'msg'=>'otp resend successfully'];
            }else{
                $data = ['status' => false, 'code' => 403, 'msg'=>'something went wrong'];
            }
        }else{
            $data = ['status' => false, 'code' => 404, 'msg'=>'data not found'];
        }
        return $data;
    }

    /**
     * Verify pickup otp
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     *
     */
    public function verifyPickupOtp(Request $request){
        $perameters = $request->all();
        $ebill_id   = $perameters['ebill_id'];
        $sender_otp = $perameters['sender_otp'];
        $ebill = Ebill::where('id', $ebill_id)->where('pickup_status', 0)->first();
        // dd($ebill);
        
        if($ebill){
            if($ebill->pickup_otp == $sender_otp){
                // set pickup otp null
                $ebill->pickup_otp = 0;
                $ebill->pickup_status = 1;
                $res = $ebill->save();

                $userTo   = User::find($ebill->user_id);
                if(!empty($userTo)){
                    $userTo->notify(new NotifyUserPickUpDone($ebill));
                }

                $vendorTo   = User::find($ebill->vendor_id);
                if(!empty($vendorTo)){
                    $vendorTo->notify(new NotifyUserPickUpDone($ebill));
                }
                $data = ['status' => true, 'code' => 200, 'msg'=>'pickup otp verified successfully'];
            }else{
                $data = ['status' => false, 'code' => 403, 'msg'=>'otp not verified'];
            }
        }else{
            $data = ['status' => false, 'code' => 404, 'msg'=>'data not found'];
        }
        return $data;
    }

    /**
     * Send drop OTP
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function sendDropOtp(Request $request){
        $perameters = $request->all();
        $ebill_id = $perameters['ebill_id'];
        $ebill = Ebill::where('id', $ebill_id)->where('drop_status', 0)->first();
        if($ebill){
            $ebill->drop_otp = '123456';
            $res = $ebill->save();
            if($res){
                $receiverTo   = User::find($ebill->vendor_id);
                if(!empty($receiverTo)){
                    // $receiverTo->notify(new SendEmailOtpToUser($ebill));
                }
                $data = ['status' => true, 'code' => 200, 'msg'=>'otp send successfully'];
            }else{
                $data = ['status' => false, 'code' => 403, 'msg'=>'something went wrong'];
            }
        }else{
            $data = ['status' => false, 'code' => 404, 'msg'=>'data not found'];
        }
        return $data;
    }

    /**
     * Resend drop OTP
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function resendDropOtp(Request $request){
        $perameters = $request->all();
        $ebill_id = $perameters['ebill_id'];
        $ebill = Ebill::where('id', $ebill_id)->where('drop_status', 0)->first();
        if($ebill){
            $ebill->drop_otp = '123456';
            $res = $ebill->save();
            if($res){
                $receiverTo = User::find($ebill->vendor_id);
                if(!empty($receiverTo)){
                    // $receiverTo->notify(new SendEmailOtpToUser($ebill));
                }
                $data = ['status' => true, 'code' => 200, 'msg'=>'otp resend successfully'];
            }else{
                $data = ['status' => false, 'code' => 403, 'msg'=>'something went wrong'];
            }
        }else{
            $data = ['status' => false, 'code' => 404, 'msg'=>'data not found'];
        }
        return $data;
    }

    /**
     * Verify drop otp
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     *
     */
    public function verifyDropOtp(Request $request){
        $perameters = $request->all();
        // dd($perameters);
        $ebill_id   = $perameters['ebill_id'];
        $receiver_otp = $perameters['receiver_otp'];
        $case       = $perameters['case'];
        $ebill      = Ebill::where('id', $ebill_id)->where('drop_status', 0)->first();
        
        if($ebill){
            if($ebill->drop_otp == $receiver_otp){
                // set drop otp null
                $ebill->drop_otp = 0;
                $ebill->drop_status = 1;
                $ebill->is_delivered = 1;
                // All note : '0=pending', '1=success', '2=processed by receiver', '3=hold by admin', '4=accept by admin', '5=decline by admin', '6=processed by admin', '7=cancel by sender'
                if($case == '1'){
                    $ebill->payment_status = 1;
                }elseif($case == '2'){
                    $ebill->payment_status = 2;
                }elseif($case == '3'){
                    $ebill->payment_status = 3;
                }elseif($case == '4'){
                    $ebill->payment_status = 3;
                }elseif($case == '5'){
                    $ebill->payment_status = 2;
                }elseif($case == '6'){
                    $ebill->payment_status = 3;
                }
                // dd($ebill);
                $res = $ebill->save();

                $data = ['status' => true, 'code' => 200, 'msg'=>'drop otp verified successfully'];
            }else{
                $data = ['status' => false, 'code' => 403, 'msg'=>'otp not verified'];
            }
        }else{
            $data = ['status' => false, 'code' => 404, 'msg'=>'data not found'];
        }
        return $data;
    }

    public function updateLocation(Request $request){
        $post = $request->all();
        $driver_tracking = new DriverTracking();
        $driver_tracking->ebill_id              = $post['ebill_id'];
        $driver_tracking->shipping_id           = $post['shipping_id'];
        $driver_tracking->driver_id             = $post['driver_id'];
        $driver_tracking->last_updated_location = $post['last_updated_location'];
        $driver_tracking->latitude              = $post['latitude'];
        $driver_tracking->longitude             = $post['longitude'];
        $res = $driver_tracking->save();
        if($res){
            return ['status' => true, 'code' => 200, 'data'=>$driver_tracking];
        }else{
            return ['status' => false, 'code' => 500, 'msg'=>'something went wrong'];
        }
    }
}
