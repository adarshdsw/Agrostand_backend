<?php

return [
    'notification' => [
        'welcome' => [
        	'title' =>'Welcome User',
        	'body' =>'Thank you be a part of AgroStand.',
        ],
        'post_like' => [
        	'title' => ':user Like Your Post',
        	'body' =>'User like your post.',
        ],
        'post_comment' => [
        	'title' => ':user Comment On Your Post',
        	'body' =>'User Comment on your post.',
        ],
        'following_user' => [
        	'title' =>':user started following you',
        	'body' =>'You are Followed by App user.',
        ],
        'buy_lead' => [
        	'title' =>'Agrostand:-Buylead Created',
        	'body' =>':user is looking for a :product.',
        ],
        'sell_lead' => [
        	'title' =>'Agrostand:-Selllead Created',
        	'body' =>':user is ready to sell a :product.',
        ],
        'new_news' => [
        	'title' =>'New News Received',
        	'body' =>'New News has been created by admin.',
        ],
        'sell_request' => [
        	'title' =>':user sent you a request to buy a product.',
        	'body' =>'User Sent You a Request.',
        ],
        'ebill' => [
        	'title' =>'Agrostand - Ebill Created',
        	'body' =>':user is created a new ebill for you.',
        ],
        'rfp_update' => [
        	'title' =>'Agrostand:-RFP Updated',
        	'body' =>':user is :rfp_status your request of proposal.',
        ],
        'shipping_status' => [
        	'title' =>'Agrostand:-Shipping Status',
        	'body' =>':user is :shipping_status shipping of your ebill.',
        ],
        'driver_registration' => [
        	'title' =>'Agrostand:-Driver Registration',
        	'body' =>'Driver is registered in system also assign a bill for shipping',
        ],
        'agro_pay' => [
        	'title' => 'Sender created a ebill which Payment mode is AgroPay',
        	'body' => 'Please find attachment for further info',
        ],
        'agro_service' => [
        	'title' => 'Sender created a ebill which shipping type is AgroService',
        	'body' => 'Please find attachment for further info',
        ],
        'payment_process_sender' => [
        	'title' => ':user processed a payment for your ebill.',
        	'body' => 'Check E-bill and take a action on payment process',
        ],
        'payment_process_admin' => [
        	'title' => ':user processed a payment for your ebill.',
        	'body' => 'Check E-bill and take a action on payment process',
        ],
        'admin_shipping_status' =>[
            'title' => 'AgroStand : Admin :shipping_status shipping request.',
            'body' => 'Admin has been :shipping_status your shipping request.',
        ],
        'admin_payment_status' =>[
            'title' => 'AgroStand : Admin :payment_status payment request.',
            'body' => 'Admin has been :payment_status your payment request.',
        ],
        'sender_payment_status' =>[
            'title' => 'AgroStand : :sender_user :payment_status payment request.',
            'body' => ':sender_user has been :payment_status your payment request.',
        ],
        'driver_order_receive' =>[
            'title' => 'AgroStand : you have been received new order.',
            'body' => ':orde_id order has been assigned you by admin.',
        ],
        'send_otp' =>[
            'title' => 'AgroStand : you have been received a otp.',
            'body' => 'Agrostand sent you a otp :user_otp for :orde_id order.',
        ],
        'pickup_done' =>[
            'title' => 'AgroStand : pickup done.',
            'body' => 'Your Product has been pickup for an order :orde_id.',
        ],
        'drop_done' =>[
            'title' => 'AgroStand : Drop done.',
            'body' => 'Your Product has been drop for an order :orde_id.',
        ],
    ],
    "response"=>[
        'welcome' => 'Welcome User',
        'error_500' => 'Something went wrong in request',
        'error_404' => 'No data found',
        'error_402' => 'Unproccessing data please request required fileds',
        'success_200' => 'data found successfully',
        'send_otp' => 'Success : OTP send successfully',
        'send_otp_fail' => 'Failed : OTP send unsuccessfully, try again',
        'verify_otp' => 'Success : OTP verified successfully',
        'failed_verify_otp' => 'Failed : OTP verification failed, try again',
        'email_exist' => 'Email already exists',
        'mobile_exist' => 'Mobile number already exists',
        'referral_not_exist' => 'Referral code is not exists',
        'success_user_registration' => 'Success : User registration has been successed',
        'failed_user_registration' => 'Failed : User registration has been failed',
        'success_profile_update' => 'Success : User profile updation has been successed',
        'success_product_store' => 'Success : Product has been save successfully',
        'failed_product_store' => 'Failed : Product has failed',
        'success_post_store' => 'Success : Post has been created successfully',
        'failed_post_store' => 'Failed : Post has failed',
        'success_post_edit' => 'Success : Post has been edited successfully',
        'failed_post_edit' => 'Failed : Post has failed',
        'success_post_delete' => 'Success : Post has been deleted successfully',
        'success_post_like' => 'Success : Post has been liked successfully',
        'success_post_favorite' => 'Success : Post has been favorite successfully',
        'success_brand_store' => 'Success : Brand has been save successfully',
        'failed_brand_store' => 'Failed : Brand has failed',
        'success_sell_request' => 'Success : Sell request has been sent successfully',
        /*'resend_otp' => 'Success : OTP send successfully',
        'resend_otp_fail' => 'Failed : OTP send unsuccessfully, try again',*/
        'success_ebill_store' => 'Success : Ebill has been created successfully',
        'failed_ebill_store' => 'Failed : Ebill has failed',
        'success_shipping_store' => 'Success : Ebill Shipping has been created successfully',
        'failed_shipping_store' => 'Failed : Ebill Shipping has failed',
        'success_shipping_update' => 'Success : Ebill Shipping has been updated successfully',
        'failed_shipping_update' => 'Failed : Ebill Shipping updation has failed',
        'success_ebill_product_delete' => 'Success : Ebill Product has been deleted successfully',
        'failed_ebill_product_delete' => 'Failed : Ebill Product deletion has failed',
        'success_ebill_product_store' => 'Success : Ebill Product has been added successfully',
        'failed_ebill_product_store' => 'Failed : Ebill Product addition has failed',
        'success_ebill_product_update' => 'Success : Ebill Product has been updated successfully',
        'failed_ebill_product_update' => 'Failed : Ebill Product updation has failed',
        'success_rfp_status_update' => 'Success : RFP status has been updated successfully',
        'failed_rfp_status_update' => 'Failed : RFP status updation has failed',
        'success_ebill_transaction' => 'Success : Ebill Transaction has been done successfully',
        'failed_ebill_transaction' => 'Failed : Ebill Transaction has failed',
        'success_payment_status' => 'Success : Payment has been done successfully',
        'failed_payment_status' => 'Failed : Payment has failed',
        'success_product_delete' => 'Success : Product has been deleted successfully',
        'user_blocked'           => 'You have been blocked by admin',
        'success_lead_delete' => 'Success : Lead has been deleted successfully',
    ],
];