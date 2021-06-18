<?php


use Illuminate\Http\Request;
use App\Models\News;
use App\Models\Scheme;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('localization')->group( function(){

	Route::get('languages', 'UsersController@languageList')->name('languages');

	Route::get('assured', 'UsersController@assuredList')->name('assured');

	Route::get('countries', 'UsersController@countryList')->name('countries');

	Route::get('units', 'UsersController@unitList')->name('units');

	Route::get('categories', 'UsersController@categoryList')->name('categories');

	Route::get('brands', 'UsersController@brandList')->name('brands');

	Route::get('roles', 'UsersController@roleList')->name('roles');

	Route::post('sub_categories', 'UsersController@subCategoryList')->name('sub_categories');

	Route::post('commodities', 'UsersController@commodityList')->name('commodities');

	Route::post('states', 'UsersController@stateList')->name('states');

	Route::post('/districts', 'UsersController@districtList')->name('districts');

	Route::post('/cities', 'UsersController@cityList')->name('cities');

	Route::post('select_language', 'UsersController@selectLanguage')->name('select_language');

	Route::post('send_otp', 'UsersController@sendOTP')->name('send_otp');

	Route::post('resend_otp', 'UsersController@resendOTP')->name('resend_otp');

	Route::post('verify_otp', 'UsersController@verifyOTP')->name('verify_otp');

	Route::post('register_user', 'UsersController@registerUser')->name('register_user');

	Route::post('mobile_login', 'Auth\LoginController@mobileLogin');

	Route::post('get_user_profile', 'UsersController@getUserProfile')->name('get_user_profile');

	Route::post('update_user_profile', 'UsersController@updateUserProfile')->name('update_user_profile');
	// provide user ratting
	Route::post('/user/provide_ratting', 'UsersController@provideUserRatting')->name('user.provide_ratting');
	// user follower
	Route::post('/user/following', 'UsersController@userFollowing')->name('user.following');
	// update user uniqe code
	Route::post('/user/update/uniqe_code', 'UsersController@updateUniqeCode')->name('user.update.uniqe_code');

	// Route::post('register', 'Auth\RegisterController@register');

	Route::post('register', 'UsersController@register');

	Route::post('otpVerify', 'UsersController@otpVerify');

	Route::post('login', 'UsersController@login');
	// banners list and Details
	Route::get('/banners', 'Admin\BannerController@index')->name('banners');
	// news list and Details
	Route::post('/news', 'Admin\NewsController@index')->name('news');
	// News Detail page
	Route::get('/news/show/{id}', function ($id){
		$news = News::find($id);
		if($news){
			$data = ['status' => true, 'code' => 200, 'data'=>$news];
		}else{
			$data = ['status' => false, 'code' => 404, 'message' => "data not found"];
		}
		return $data;
	});
	// schemes list and Details
	Route::post('/schemes', 'Admin\SchemeController@index')->name('schemes');
	// Schemes Detail page
	Route::get('/scheme/show/{id}', function ($id){
		$scheme = Scheme::find($id);
		if($scheme){
			$data = ['status' => true, 'code' => 200, 'data'=>$scheme];
		}else{
			$data = ['status' => false, 'code' => 404, 'message' => "data not found"];
		}
		return $data;
	});
	// post master
	Route::post('/posts', 'Api\PostController@index');
	Route::post('/post/store', 'Api\PostController@store');
	Route::get('/post/show/{id}', 'Api\PostController@show');
	Route::delete('/post/delete', 'Api\PostController@destroy');
	Route::post('/post/view_increment', 'Api\PostController@viewIncrement');
	Route::post('/post/like', 'Api\PostController@like');
	Route::post('/post/favorite', 'Api\PostController@favorite');
	Route::post('/post/comment', 'Api\PostController@comment');
	Route::post('/post/update', 'Api\PostController@update');
	// user own posts
	Route::post('/post/user/', 'Api\PostController@userPosts')->name('user.own.posts');

	// product master
	// product Catalogue listing
	Route::post('/products', 'Api\ProductController@index');
	// create product Catalogue
	Route::post('/product/store', 'Api\ProductController@store');
	// view product Catalogue
	Route::get('/product/show/{id}', 'Api\ProductController@show');
	// Edit product Catalogue
	Route::post('/product/update', 'Api\ProductController@update');
	// delete product Catalogue	
	Route::post('/product/destroy/', 'Api\ProductController@destroy');
	
	Route::get('/product/group', 'Api\ProductController@productGroup');
	// Suggestions of product catalogue
	Route::post('/user/products', 'Api\ProductController@userProducts');
	// Buy lead store
	Route::post('/buy/lead_store', 'Api\BuyController@store');
	Route::post('/buy/product_list', 'Api\BuyController@index');
	Route::post('/buy/lead_list', 'Api\BuyController@leadList');
	Route::get('/buy/lead/show/{id}', 'Api\BuyController@leadShow');
	Route::post('/buy/vendor_list', 'Api\BuyController@vendorList');
	Route::post('/buy/lead/delete', 'Api\BuyController@destroy');
	// Buy product list
	// Product Suggestions
	Route::post('/product/suggestions', 'Admin\SuggestionController@suggestionList');
	// Sell lead store
	Route::post('/sell/lead_store', 'Api\SellController@store');
	Route::post('/sell/vendor_list', 'Api\SellController@index');
	Route::post('/sell/request', 'Api\SellController@sellRequestVendor');
	Route::post('/sell/lead_list', 'Api\SellController@leadList');
	Route::get('/sell/lead/show/{id}', 'Api\SellController@leadShow');
	Route::post('/sell/request_list', 'Api\SellController@sellRequestList');
	Route::post('/sell/request_detail', 'Api\SellController@sellRequestDetail');
	Route::post('/sell/lead/delete', 'Api\SellController@destroy');

	/******************** Agronomist lead and thier services **************************/
	// Agronomist resultant data after search
	Route::post('/agronomist/lead/list', 'Api\AgronomistController@index');
	// former/business generate lead for agronomist
	Route::post('/agronomist/lead_store', 'Api\AgronomistController@store');
	// show detail lead of former / bussiness to agronomist
	Route::get('/agronomist/lead/show/{id}', 'Api\AgronomistController@leadShow');
	// delete former/business lead
	Route::post('/agronomist/lead/delete', 'Api\AgronomistController@destroy');
	// all generated lead list for agronomist
	Route::post('/agronomist/agrolead/list', 'Api\AgronomistController@agroLeadIndex');

	// agronomist create new services
	Route::post('/agronomist/service/store', 'Api\AgronomistController@serviceStore');
	// list of agronomist own services list
	Route::post('/agronomist/service/list', 'Api\AgronomistController@serviceList');
	// show detail of agronomist service
	Route::get('/agronomist/service/show/{id}', 'Api\AgronomistController@showService');

	// E-bill
	Route::post('/ebill/vendor/list', 'UsersController@index');
	Route::post('/ebill/create', 'Api\EbillController@store');
	/* Ebill Products */
	// Add Product
	Route::post('/ebill/product/add', 'Api\EbillController@addProduct');
	// Show Product
	Route::get('/ebill/product/show/{id}', 'Api\EbillController@showProduct');
	// Edit Product
	Route::post('/ebill/product/edit', 'Api\EbillController@editProduct');
	// Delete Product
	Route::get('/ebill/product/delete/{id}', 'Api\EbillController@deleteProduct');

	Route::post('/ebill/list', 'Api\EbillController@index');
	Route::post('/ebill/order_list', 'Api\EbillController@orderList');
	Route::get('/ebill/show/{id}', 'Api\EbillController@show');
	Route::post('/ebill/rfp_status/update', 'Api\EbillController@rfpStatusUpdate');
	Route::post('/ebill/shipping/store', 'Api\EbillController@shippingStore');
	Route::post('/ebill/shipping/update', 'Api\EbillController@shippingUpdate');

	Route::post('/ebill/business/transaction', 'Api\EbillController@ebillTransaction');
	Route::post('/ebill/sender/transaction/list', 'Api\EbillController@ebillTransactionList');
	Route::post('/ebill/payment_status/update', 'Api\EbillController@paymentStatusUpdate');
	
	/*Driver at pickup time*/
	/*Route::post('/ebill/verify/driver_otp', 'Api\EbillController@verifyDriverOtp');
	Route::post('/ebill/resend/driver_otp', 'Api\EbillController@resendDriverOtp');
	Route::post('/ebill/resend/delivery_otp', 'Api\EbillController@resendDeliveryOtp');
	Route::post('/ebill/verify/driver_delivery_otp', 'Api\EbillController@verifyDriverDeliveryOtp');*/
	

	/****************************** Driver App ******************************/
	/* login */
	Route::post('/driver/login', 'Api\DriverController@login');
	Route::post('/driver/tracking/list', 'Api\DriverController@driverTrackingList');
	Route::post('/driver/tracking/delivery_view', 'Api\DriverController@driverTrackingDeliveryView');
	// Send Pickup OTP
	Route::post('/driver/pickup/send_otp', 'Api\DriverController@sendPickupOtp');
	Route::post('/driver/pickup/resend_otp', 'Api\DriverController@resendPickupOtp');
	Route::post('/driver/pickup/verify_otp', 'Api\DriverController@verifyPickupOtp');
	// Send Drop OTP
	Route::post('/driver/drop/send_otp', 'Api\DriverController@sendDropOtp');
	Route::post('/driver/drop/resend_otp', 'Api\DriverController@resendDropOtp');
	Route::post('/driver/drop/verify_otp', 'Api\DriverController@verifyDropOtp');
	
	Route::post('/driver/update/location', 'Api\DriverController@updateLocation');

	// 2021-03-19
	Route::post('/user/villages', 'Admin\VillageController@villagesList');

	// 2021-03-30
	Route::post('user/notifications', 'UsersController@getUserNotifications');

	Route::post('/shipping/driver_info', 'Api\EbillController@shippingDriverInfo');\

	Route::post('brand/store', 'UsersController@brandStore')->name('brand.store');
	
	Route::post('/ebill/process/complete', 'Api\EbillController@complete');

});

// Commodity Filter data
Route::post('commodity/list', 'Api\CommodityController@commodityList')->name('commodity.list');
Route::post('commodity/mandi_list', 'Api\CommodityController@mandiList')->name('commodity.mandi_list');
Route::post('commodity/mandi_detail_list', 'Api\CommodityController@mandiDetailList')->name('commodity.mandi_detail_list');

Route::post('commodity/filter_data', 'Api\CommodityController@filterData')->name('commodity.filter_data');
Route::post('commodity/index', 'Api\CommodityController@index')->name('commodity.index');
// add miscellaneous commodity
Route::get('/commodity/miscellaneous', 'Api\CommodityController@storeMiscellaneous')->name('commodity.miscellaneous');

Route::get('/settings', 'Admin\SettingController@show')->name('settings');

Route::get('/settings/bank', 'Admin\SettingController@bank')->name('bank');

Route::get('/agromeet/list', 'Api\AgromeetController@index')->name('agromeet.list');


/* ----------------------- Admin Routes START -------------------------------- */

Route::prefix('admin')->name('admin.')->namespace('Admin')->group(function(){
	Route::post('login', 'AdminController@login');
	// category master
	Route::get('/category', 'CategoryController@categoryList');
	Route::post('/category/store', 'CategoryController@store');
	Route::get('/category/edit/{id}', 'CategoryController@edit');
	Route::put('/category/{id}', 'CategoryController@update');
	Route::delete('/category/{id}', 'CategoryController@destroy');
	// subcategory list
	Route::get('sub_category', 'CategoryController@subCategorylist');
	// commodity master
	Route::get('/commodity', 'CommodityController@index');
	Route::post('/commodity/store', 'CommodityController@store');
	Route::get('/commodity/edit/{id}', 'CommodityController@edit');
	Route::put('/commodity/{id}', 'CommodityController@update');
	Route::delete('/commodity/{id}', 'CommodityController@destroy');
	// Banner master
	Route::get('/banners', 'BannerController@index');
	Route::post('/banner/store', 'BannerController@store');
	Route::get('/banner/edit/{id}', 'BannerController@edit');
	Route::put('/banner/{id}', 'BannerController@update');
	Route::delete('/banner/{id}', 'BannerController@destroy');
	// news master
	Route::get('news', 'NewsController@index');
	Route::post('/news/store', 'NewsController@store');
	Route::get('/news/edit/{id}', 'NewsController@edit');
	Route::put('/news/{id}', 'NewsController@update');
	Route::delete('/news/{id}', 'NewsController@destroy');
	// Goverement Schemes
	Route::get('schemes', 'SchemeController@index');
	Route::post('/scheme/store', 'SchemeController@store');
	Route::get('/scheme/edit/{id}', 'SchemeController@edit');
	Route::put('/scheme/{id}', 'SchemeController@update');
	Route::delete('/scheme/{id}', 'SchemeController@destroy');
	// users list
	Route::get('users', 'UsersController@index');
	Route::post('/user/update_status', 'UsersController@updateStatus');
});
