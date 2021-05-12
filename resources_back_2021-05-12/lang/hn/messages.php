<?php

return [
    'notification' => [
        'welcome' => [
        	'title' =>'[hindi] Welcome User',
        	'body' =>'[Hindi] Thank you be a part of AgroStand.',
        ],
        'post_like' => [
        	'title' => ' [Hindi] :user Like Your Post',
        	'body' =>'[Hindi] User like your post.',
        ],
        'post_comment' => [
        	'title' => '[Hindi] :user Comment On Your Post',
        	'body' =>'[Hindi] User Comment on your post.',
        ],
        'following_user' => [
        	'title' =>'[Hindi] :user started following you',
        	'body' =>'[Hindi] You are Followed by App user.',
        ],
        'buy_lead' => [
        	'title' =>'[Hindi] Agrostand:-Buylead Created',
        	'body' =>'[Hindi] :user is looking for a :product.',
        ],
        'sell_lead' => [
        	'title' =>'[Hindi] Agrostand:-Selllead Created',
        	'body' =>'[Hindi] :user is ready to sell a :product.',
        ],
        'new_news' => [
        	'title' =>'[Hindi] New News Received',
        	'body' =>'[Hindi] New News has been created by admin.',
        ],
        'sell_request' => [
        	'title' =>'[Hindi] :user sent you a request to buy a product.',
        	'body' =>'[Hindi] User Sent You a Request.',
        ],
        'ebill' => [
        	'title' =>'[Hindi] Agrostand - Ebill Created',
        	'body' =>'[Hindi] :user is created a new ebill for you.',
        ],
        'rfp_update' => [
        	'title' =>'[Hindi] Agrostand:-RFP Updated',
        	'body' =>'[Hindi] :user is :rfp_status your request of proposal.',
        ],
        'shipping_status' => [
        	'title' =>'[Hindi] Agrostand:-Shipping Status',
        	'body' =>'[Hindi] :user is :shipping_status shipping of your ebill.',
        ],
        'driver_registration' => [
        	'title' =>'[Hindi] Agrostand:-Driver Registration',
        	'body' =>'[Hindi] Driver is registered in system also assign a bill for shipping',
        ],
        'agro_pay' => [
        	'title' => '[Hindi] Sender created a ebill which Payment mode is AgroPay',
        	'body' => '[Hindi] Please find attachment for further info',
        ],
        'agro_service' => [
        	'title' => '[Hindi] Sender created a ebill which shipping type is AgroService',
        	'body' => '[Hindi] Please find attachment for further info',
        ],
        'payment_process_sender' => [
        	'title' => '[Hindi] :user processed a payment for your ebill.',
        	'body' => '[Hindi] Check E-bill and take a action on payment process',
        ],
        'payment_process_admin' => [
        	'title' => '[Hindi] :user processed a payment for your ebill.',
        	'body' => '[Hindi] Check E-bill and take a action on payment process',
        ],
        'admin_shipping_status' =>[
            'title' => '[Hindi] AgroStand : Admin :shipping_status shipping request.',
            'body' => '[Hindi] Admin has been :shipping_status your shipping request.',
        ],
        'admin_payment_status' =>[
            'title' => '[Hindi] AgroStand : Admin :payment_status payment request.',
            'body' => '[Hindi] Admin has been :payment_status your payment request.',
        ],
        'sender_payment_status' =>[
            'title' => '[Hindi] AgroStand : :sender_user :payment_status payment request.',
            'body' => '[Hindi] :sender_user has been :payment_status your payment request.',
        ],
        'driver_order_receive' =>[
            'title' => '[Hindi] AgroStand : you have been received new order.',
            'body' => '[Hindi] :orde_id order has been assigned you by admin.',
        ],
        'send_otp' =>[
            'title' => '[Hindi] AgroStand : you have been received a otp.',
            'body' => '[Hindi] Agrostand sent you a otp :user_otp for :orde_id order.',
        ],
        'pickup_done' =>[
            'title' => '[Hindi] AgroStand : pickup done.',
            'body' => '[Hindi] Your Product has been pickup for an order :orde_id.',
        ],
        'drop_done' =>[
            'title' => '[Hindi] AgroStand : Drop done.',
            'body' => '[Hindi] Your Product has been drop for an order :orde_id.',
        ],
    ],
    "response"=>[
        'welcome' => '[hindi] Welcome User',
        'error_500' => '[hindi] Something went wrong in request',
        'error_404' => '[hindi] No data found',
        'success_200' => '[hindi] data found successfully',
        'send_otp' => '[hindi] Success : OTP send successfully',
        'send_otp_fail' => '[hindi] Failed : OTP send unsuccessfully, try again',
        'verify_otp' => '[hindi] Success : OTP verified successfully',
        'failed_verify_otp' => '[hindi] Failed : OTP verification failed, try again',
        'email_exist' => '[hindi] Email already exists',
        'mobile_exist' => '[hindi] Mobile number already exists',
        'referral_not_exist' => '[hindi] Referral code is not exists',
        'success_user_registration' => '[hindi] Success : User registration has been successed',
        'failed_user_registration' => '[hindi] Failed : User registration has been failed',
        'success_profile_update' => '[hindi] Success : User profile updation has been successed',
        'success_product_store' => '[hindi] Success : Product has been save successfully',
        'failed_product_store' => '[hindi] Failed : Product has failed',
        'success_post_store' => '[hindi] Success : Post has been created successfully',
        'failed_post_store' => '[hindi] Failed : Post has failed',
        'success_post_edit' => '[hindi] Success : Post has been edited successfully',
        'failed_post_edit' => '[hindi] Failed : Post has failed',
        'success_post_delete' => '[hindi] Success : Post has been deleted successfully',
        'success_post_like' => '[hindi] Success : Post has been liked successfully',
        'success_post_favorite' => '[hindi] Success : Post has been favorite successfully',
        'success_brand_store' => '[hindi] Success : Brand has been save successfully',
        'failed_brand_store' => '[hindi] Failed : Brand has failed',
        /*'resend_otp' => 'Success : OTP send successfully',
        'resend_otp_fail' => 'Failed : OTP send unsuccessfully, try again',*/
        'success_sell_request' => '[Hindi] Success : Sell request has been sent successfully',
        'success_product_delete' => '[Hindi] Success : Product has been deleted successfully',
    ],
];