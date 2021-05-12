<?php

return [
    'notification' => [
        'welcome' => [
        	'title' =>'आपका स्वागत है उपयोगकर्ता|',
        	'body' =>'धन्यवाद आप AgroStand का हिस्सा हैं।.',
        ],
        'post_like' => [
        	'title' => ':user आपकी पोस्ट  को लाइक किया|',
        	'body' =>'उपयोगकर्ता को आपकी पोस्ट पसंद आई है.',
        ],
        'post_comment' => [
        	'title' => ':user आपकी पोस्ट पर कमेंट किया|',
        	'body' =>'आपकी पोस्ट पर कमेंट आया है',
        ],
        'following_user' => [
        	'title' =>':user ने आपका अनुसरण करना शुरू कर दिया है',
        	'body' =>'आप App उपयोगकर्ता द्वारा अनुसरण कर रहे हैं।',
        ],
        'buy_lead' => [
        	'title' =>'Agrostand:-Buylead बनाया गया',
        	'body' =>':user एक :product के लिए देख रहा है',
        ],
        'sell_lead' => [
        	'title' =>'Agrostand:-Selllead बनाया गया',
        	'body' =>':user :Product बेचने के लिए तैयार है|',
        ],
        'new_news' => [
        	'title' =>'नई खबर प्राप्त हुई है',
        	'body' =>'नया समाचार व्यवस्थापक द्वारा बनाया गया है।',
        ],
        'sell_request' => [
        	'title' =>':user ने आपको एक उत्पाद खरीदने का अनुरोध भेजा है।',
        	'body' =>'उपयोगकर्ता ने आपसे अनुरोध किया है।|',
        ],
        'ebill' => [
        	'title' =>'Agrostand - Ebill बनाया गया',
        	'body' =>':user ने आपके लिए एक नया Ebill बनाया है।',
        ],
        'rfp_update' => [
        	'title' =>'Agrostand : RFP अपडेट कर दिया है',
        	'body' =>':user ने :rfp_status स्टेटस अपडेट किया है',
        ],
        'shipping_status' => [
        	'title' =>'Agrostand:- शिपिंग की स्थिति',
        	'body' =>':user ने आपके Ebill की शिपिंग स्थिति :shipping_status बदल दी है|',
        ],
        'driver_registration' => [
        	'title' =>'Agrostand:-चालक पंजीकरण',
        	'body' =>'चालक को पंजीकृत किया गया है और चालक को Order दिया गया है',
        ],
        'agro_pay' => [
        	'title' => 'Ebill शिपिंग किया गया है जो भुगतान मोड agropay है',
        	'body' => 'कृपया अधिक जानकारी के लिए अनुलग्नक खोजें',
        ],
        'agro_service' => [
        	'title' => 'Ebill शिपिंग किया गया है जो भुगतान मोड AgroService है',
        	'body' => 'कृपया अधिक जानकारी के लिए अनुलग्नक खोजें',
        ],
        'payment_process_sender' => [
        	'title' => ':user आपके ईबील के लिए भुगतान संसाधित किया गया|',
        	'body' => 'ई-वे बिल की जांच करें और भुगतान प्रक्रिया पर कार्रवाई करें',
        ],
        'payment_process_admin' => [
        	'title' => ':user आपके ईबील के लिए भुगतान संसाधित किया गया|',
        	'body' => 'ई-वे बिल की जांच करें और भुगतान प्रक्रिया पर कार्रवाई करें',
        ],
        'admin_shipping_status' =>[
            'title' => 'AgroStand Admin - Shipping',
            'body' => 'AgroStand Admin - आपके शिपिंग अनुरोध को :shipping_status कर लिया गया है।.',
        ],
        'admin_payment_status' =>[
            'title' => 'AgroStand Admin payment request.',
            'body' => 'Admin को आपके भुगतान अनुरोध को :payment_status कर लिया गया है।',
        ],
        'sender_payment_status' =>[
            'title' => 'AgroStand लेनदेन अनुरोध स्थिति',
            'body' => 'Sender को आपका भुगतान अनुरोध :sender_user कर लिया गया है।',
        ],
        'driver_order_receive' =>[
            'title' => 'AgroStand : Driver को नया ऑर्डर मिला।',
            'body' => ':orde_id आदेश आपको Admin द्वारा सौंपा गया है।',
        ],
        'send_otp' =>[
            'title' => 'AgroStand : आपको एक otp प्राप्त हुआ है।',
            'body' => 'Agrostand ने आपको :orde_id ऑर्डर के लिए एक ओटीपी :user_otp भेजा।',
        ],
        'pickup_done' =>[
            'title' => 'AgroStand : आइटम को सफलतापूर्वक उठाया गया है।',
            'body' => 'आइटम को ड्राइवर द्वारा सफलतापूर्वक उठाया गया है, ऑर्डर आईडी :orde_id है.',
        ],
        'drop_done' =>[
            'title' => 'AgroStand : ड्राइवर द्वारा आइटम सफलतापूर्वक छोड़ दिया गया है',
            'body' => 'ड्राइवर द्वारा आइटम को सफलतापूर्वक छोड़ दिया गया है| ऑर्डर आईडी :orde_id है.',
        ],
    ],
    "response"=>[
        'welcome' => 'आपका स्वागत है उपयोगकर्ता|',
        'error_500' => 'अनुरोध में कुछ गलत हो गया।',
        'error_404' => 'डाटा प्राप्त नहीं हुआ',
        'error_402' => 'असुरक्षित डेटा कृपया दर्ज किए गए अनुरोधों का अनुरोध करें.',
        'success_200' => 'डेटा सफलतापूर्वक मिला',
        'send_otp' => 'Success : OTP को सफलतापूर्वक भेजें',
        'send_otp_fail' => 'Failed : OTP असफल रूप से भेजें, पुनः प्रयास करें',
        'verify_otp' => 'Success : OTP सफलतापूर्वक सत्यापित किया गया',
        'failed_verify_otp' => 'Failed : OTP सत्यापन विफल, फिर से प्रयास करें',
        'email_exist' => 'ईमेल पहले से मौजूद है',
        'mobile_exist' => 'मोबाइल नंबर पहले से मौजूद है',
        'referral_not_exist' => 'रेफरल कोड मौजूद नहीं है',
        'success_user_registration' => 'Success : उपयोगकर्ता पंजीकरण सफल रहा है',
        'failed_user_registration' => 'Failed : उपयोगकर्ता पंजीकरण विफल हो गया है',
        'success_profile_update' => 'Success : उपयोगकर्ता प्रोफ़ाइल अपडेशन सफल रहा है',
        'success_product_store' => 'Success : उत्पाद सफलतापूर्वक सहेजा गया है',
        'failed_product_store' => 'Failed : उत्पाद विफल हो गया है',
        'success_post_store' => 'Success : पोस्ट सफलतापूर्वक बनाई गई है',
        'failed_post_store' => 'Failed : पोस्ट को विफल कर दिया गया है',
        'success_post_edit' => 'Success : पोस्ट को सफलतापूर्वक संपादित किया गया है',
        'failed_post_edit' => 'Failed : पोस्ट को विफल कर दिया गया है',
        'success_post_delete' => 'Success : पोस्ट सफलतापूर्वक हटा दी गई है',
        'success_post_like' => 'Success : पोस्ट को सफलतापूर्वक पसंद किया गया है',
        'success_post_favorite' => 'Success : पोस्ट सफलतापूर्वक पसंदीदा रही है',
        'success_brand_store' => 'Success : ब्रांड सफलतापूर्वक बनाया गया है',
        'failed_brand_store' => 'Failed : ब्रांड विफल हो गया है',
        /*'resend_otp' => 'Success : OTP send successfully',
        'resend_otp_fail' => 'Failed : OTP send unsuccessfully, try again',*/
        'success_sell_request' => 'Success : विक्रय अनुरोध सफलतापूर्वक भेजा गया है|',
        'success_product_delete' => 'Success : उत्पाद सफलतापूर्वक हटा दिया गया है|',
        'success_lead_delete' => 'Success : लीड को सफलतापूर्वक हटा दिया गया है|',
    ],
];