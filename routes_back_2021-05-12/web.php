<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Mail;
use App\Notifications\AccountActivated;
use App\Notifications\UserWelcome;
use App\Notifications\UserLikePost;
use App\Models\User;
use App\Models\Ebill;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/clear-cache', function() {
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    Artisan::call('config:cache');
    return "Cache is cleared";
});
// Authentification
Auth::routes([ 'verify' => true ]);

Route::get('/', function () {

    return view('welcome');
});

Route::get('/home', function () {
    return view('home');
});

Route::get('/logout', function(){
	Auth::logout();
});

Route::get('/login', function(){

});

Route::prefix('authentication')->group(function () {
    Route::post('login', 'UsersController@create');
});


Route::get('fcm-notification', function(){
	$user = User::find(5);
	// dd($user);
	$response = $user->notify(new AccountActivated);
	dd($response);
});


Route::get('user-welcome', function(){
	$fromUser = User::find(2);
    $toUser = User::find(5);

	$res = Notification::send($toUser, new UserWelcome($fromUser));
	dd($res);
});

Route::get('post-like', function(){
    $toUser = User::find(19);
    // dd($toUser);
	$res = Notification::send($toUser, new UserLikePost());
	dd($res);
});

Route::get('ebill-pdf_preview', function(){
	// dd(public_path());
    $ebill = Ebill::find(1);
    if(!empty($ebill)){
    	// $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('layouts.ebill_pdf_preview_2', compact('ebill'));
    	$path = public_path('/img/logo.png');
		$type = pathinfo($path, PATHINFO_EXTENSION);
		$data = file_get_contents($path);
		$custom_data['logo_base64'] = 'data:image/' . $type . ';base64,' . base64_encode($data);
    	
    	$path = public_path('/img/banner.jpg');
		$type = pathinfo($path, PATHINFO_EXTENSION);
		$data = file_get_contents($path);
		$custom_data['banner_base64'] = 'data:image/' . $type . ';base64,' . base64_encode($data);

    	$pdf 	 =  PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('layouts.ebill_pdf_preview_3', compact('ebill', 'custom_data'));
        $path 	 =  base_path('public/uploads/ebill_pdf');
        $file    =  date('d-M-Y').'_'.'ebill'.'_'.time().''.rand(). ".pdf";
        $filenew =  $path.'/'.$file;
        /*$ebill->ebill_pdf = asset('/uploads/ebill_pdf/'.$file);
        $ebill->save();*/
        // dd($filenew);
        $pdf->getDomPdf()->getOptions()->set('enable_php', true);
        $pdf_res  = $pdf->setPaper('a4', 'portrait')->setWarnings(false)->save($filenew);
        return view('layouts.ebill_pdf_preview_3', compact('ebill', 'custom_data'));
    }else{
        return redirect(route('admin.ebills.index'))->with('fail', 'Ebill Not found');
    }
});

/*
|--------------------------------------------------------------------------
| 								Backend
|--------------------------------------------------------------------------
*/

/* ----------------------- Admin Routes START -------------------------------- */

//All the admin routes will be defined here...
Route::prefix('admin')->name('admin.')->namespace('Admin')->group(function(){


        
	// Let’s define all the authentication routes inside the admin routes group:
	Route::namespace('Auth')->group(function(){
	    //Login Routes
	    Route::get('/','LoginController@showLoginForm')->name('login');
	    Route::get('/login','LoginController@showLoginForm')->name('login');
	    Route::post('/login','LoginController@login')->name('login');
	    Route::post('/logout','LoginController@logout')->name('logout');

	    //Forgot Password Routes
	    Route::get('/password/reset','ForgotPasswordController@showLinkRequestForm')->name('password.request');
	    Route::post('/password/email','ForgotPasswordController@sendResetLinkEmail')->name('password.email');

	    //Reset Password Routes
	    Route::get('/password/reset/{token}','ResetPasswordController@showResetForm')->name('password.reset');
	    Route::post('/password/reset','ResetPasswordController@reset')->name('password.update');
	});

	// Only Authenticated users for "admin" guard are allowed.
	Route::group(['middleware'=>'auth:admin'], function(){
		// dashboard
		Route::get('/', 'HomeController@index')->name('dashboard');
		Route::get('/dashboard', 'HomeController@index')->name('dashboard');
		// category master
		Route::get('/categories', 'CategoryController@index')->name('categories.index');
		// subcategory list
		Route::get('sub_category', 'CategoryController@subCategorylist');
		// show category form to create
		Route::get('/category/create', 'CategoryController@createCategory')->name('category.create');
		// show subcategory form to create
		Route::get('/subcategory/create', 'CategoryController@createSubcategory')->name('subcategory.create');
		// store category form to db
		Route::post('/category/store', 'CategoryController@store');
		// store my category form to db
		Route::post('/category/store_category', 'CategoryController@storeCategory')->name('category.store');
		// store my subcategory form to db
		Route::post('/category/store_subcategory', 'CategoryController@storeSubCategory')->name('subcategory.store');
		// show category form to edit
		Route::get('/category/{category}/edit', 'CategoryController@editCategory')->name('category.edit');
		// update my category form to db
		Route::put('/category/{category}', 'CategoryController@updateCategory')->name('category.update');
		// show subcategory form to edit
		Route::get('/subcategory/{subcategory}/edit', 'CategoryController@editSubCategory')->name('subcategory.edit');
		// update my category form to db
		Route::put('/subcategory/{subcategory}', 'CategoryController@updateSubCategory')->name('subcategory.update');

		// commodity master
		Route::get('/commodity', 'CommodityController@index');
		Route::post('/commodity/store', 'CommodityController@store');
		Route::get('/commodity/edit/{id}', 'CommodityController@edit');
		Route::put('/commodity/{id}', 'CommodityController@update');
		Route::delete('/commodity/{id}', 'CommodityController@destroy');

		// My Commodity Master
		Route::get('/commodity', 'CommodityController@commodityList')->name('commodity.index');
		Route::post('/commodity-data', 'CommodityController@commodityData')->name('commodity.data');
		// show commodity form to create
		Route::get('/commodity/create', 'CommodityController@create')->name('commodity.create');
		// store commodity form to db
		Route::post('/commodity/store', 'CommodityController@storeCommodity')->name('commodity.store');
		// show commodity form to edit
		Route::get('/commodity/{commodity}/edit', 'CommodityController@editCommodity')->name('commodity.edit');
		// update my commodity form to db
		Route::put('/commodity/{commodity}', 'CommodityController@updateCommodity')->name('commodity.update');
		// delete my commodity
		Route::delete('/commodity/{commodity}', 'CommodityController@deleteCommodity')->name('commodity.delete');

		// Banner master
		Route::get('/banners', 'BannerController@index');
		Route::post('/banner/store', 'BannerController@store');
		Route::get('/banner/edit/{id}', 'BannerController@edit');
		Route::put('/banner/{id}', 'BannerController@update');
		Route::delete('/banner/{id}', 'BannerController@destroy');


		// My Banner Master
		Route::get('/banner', 'BannerController@bannerList')->name('banner.index');
		// show banner form to create
		Route::get('/banner/create', 'BannerController@create')->name('banner.create');
		// store banner form to db
		Route::post('/banner/store', 'BannerController@storeBanner')->name('banner.store');
		// show banner Complete Details
		Route::get('/banner/{banner}', 'BannerController@show')->name('banner.show');
		// show banner form to edit
		Route::get('/banner/{banner}/edit', 'BannerController@editBanner')->name('banner.edit');
		// update my banner form to db
		Route::put('/banner/update/{banner}', 'BannerController@updateBanner')->name('banner.update');
		// delete my banner
		Route::delete('/banner/{banner}', 'BannerController@deleteBanner')->name('banner.delete');

		// news master
		Route::get('news', 'NewsController@index');
		Route::post('/news/store', 'NewsController@store');
		Route::get('/news/edit/{id}', 'NewsController@edit');
		Route::put('/news/{id}', 'NewsController@update');
		Route::delete('/news/{id}', 'NewsController@destroy');
		// My News Master
		Route::get('/news', 'NewsController@newsList')->name('news.index');
		Route::post('news-data', 'NewsController@newsData')->name('news-data');
		// show banner form to create
		Route::get('/news/create', 'NewsController@create')->name('news.create');
		// store news form to db
		Route::post('/news/store', 'NewsController@storeNews')->name('news.store');
		// show news Complete Details
		Route::get('/news/{news}', 'NewsController@show')->name('news.show');
		// show news form to edit
		Route::get('/news/{news}/edit', 'NewsController@editNews')->name('news.edit');
		// update my news form to db
		Route::put('/news/update/{news}', 'NewsController@updateNews')->name('news.update');
		// delete my news
		Route::delete('/news/{news}', 'NewsController@deleteNews')->name('news.delete');

		// Goverement Schemes
		Route::get('schemes', 'SchemeController@index');
		Route::post('/scheme/store', 'SchemeController@store');
		Route::get('/scheme/edit/{id}', 'SchemeController@edit');
		Route::put('/scheme/{id}', 'SchemeController@update');
		Route::delete('/scheme/{id}', 'SchemeController@destroy');
		// My Schemes Master
		Route::get('/scheme', 'SchemeController@schemeList')->name('scheme.index');
		// post datatable
		Route::post('scheme-data', 'SchemeController@schemeData')->name('scheme-data');
		// show banner form to create
		Route::get('/scheme/create', 'SchemeController@create')->name('scheme.create');
		// store scheme form to db
		Route::post('/scheme/store', 'SchemeController@storeScheme')->name('scheme.store');
		// show scheme Complete Details
		Route::get('/scheme/{scheme}', 'SchemeController@show')->name('scheme.show');
		// show scheme form to edit
		Route::get('/scheme/{scheme}/edit', 'SchemeController@editScheme')->name('scheme.edit');
		// update my scheme form to db
		Route::put('/scheme/update/{scheme}', 'SchemeController@updateScheme')->name('scheme.update');
		// delete my scheme
		Route::delete('/scheme/{scheme}', 'SchemeController@deleteScheme')->name('scheme.delete');

		Route::post('/user/update_status', 'UsersController@updateStatus');
		Route::get('user/update_assure', 'UsersController@updateAssure')->name('user.assure');
		Route::get('user/update_verify', 'UsersController@updateVerify')->name('user.verify');
		Route::get('user/update_status_new', 'UsersController@updateStatusNew')->name('user.status_update_new');
		
		// brand master
		Route::resource('brands', 'BrandController');
		// user master
		Route::resource('users', 'UsersController');
		// user datatable
		Route::post('users-data', 'UsersController@userData')->name('users-data');
		// Route::get('users/data', 'UsersController@userData')->name('users.data');
		// datatables
		Route::get('datatables', 'DatatablesController@getIndex');
		Route::get('datatables/data', 'DatatablesController@anyData')->name('datatables.data');
		// Route::controller('datatables', 'DatatablesController', [
		//     'anyData'  => 'datatables.data',
		//     'getIndex' => 'datatables',
		// ]);
		// units master
		Route::resource('units', 'UnitController');
		// product group master
		Route::resource('pgroups', 'ProductGroupController');
		// suggestion
		Route::resource('suggestions', 'SuggestionController');
		// drivers
		Route::resource('drivers', 'DriverController');
		Route::post('drivers-data', 'DriverController@driverData')->name('driver.data');
		// ebills
		Route::resource('ebills', 'EbillController');
		// Ebills-data
		Route::post('/ebills-data', 'EbillController@EbillsData')->name('ebills.data');
		// villages
		Route::resource('villages', 'VillageController');
		// agromeets
		Route::resource('agromeets', 'AgromeetController');
		// get state districts
		Route::get('/state/districts/', 'VillageController@getStateDistricts')->name('state.districts');
		Route::get('/district/cities/', 'VillageController@getDistrictCities')->name('district.cities');
		
		Route::get('ebill_shipping', 'EbillController@shipping_index')->name('ebill.shipping.index');
		Route::post('ebill_shipping-data', 'EbillController@ebillShippingData')->name('ebill.shipping.data');
		Route::get('/shippings/driver/create/{ebill_shipping}', 'EbillController@addDriver')->name('shipping.driver.add');
		Route::post('/shippings/driver/store', 'EbillController@driverShippingStore')->name('shipping.driver.store');
		
		Route::get('ebill/shipping/accept/{ebill_shipping_id}', 'EbillController@shippingAccept')->name('ebill.shipping.accept');
		Route::post('ebill/shipping/accept/save', 'EbillController@shippingAcceptSave')->name('ebill.shipping.accept_save');

		Route::get('ebill/shipping/decline/{ebill_shipping_id}', 'EbillController@shippingDecline')->name('ebill.shipping.decline');
		Route::post('ebill/shipping/decline/save', 'EbillController@shippingDeclineSave')->name('ebill.shipping.decline_save');
		// Ebill Driver Tracking
		Route::get('driver_tracking', 'DriverController@driverTrackingList')->name('driver.tracking.index');
		// show driver Complete shipping
		Route::get('/driver/shippings/create', 'DriverController@driverShippingCreate')->name('driver.shipping.create');
		Route::get('/driver/shippings/{driver}', 'DriverController@driverShippingList')->name('driver_shipping.show');
		Route::post('/driver/shippings/store', 'DriverController@driverShippingStore')->name('driver.shipping.store');
		// Payment Holded by admin list
		Route::get('hold_payment', 'EbillController@ebillHoldingPayment')->name('ebill.holding.payment');
		Route::post('pay_holding-data', 'EbillController@payHoldingData')->name('ebill.holding.payment.data');
		
		Route::post('ebill/holding_payment/accept/{ebill_id}', 'EbillController@holdingPaymentAccept')->name('ebill.holding_payment.accept');
		Route::post('ebill/holding_payment/decline/{ebill_id}', 'EbillController@holdingPaymentDecline')->name('ebill.holding_payment.decline');
		Route::post('ebill/holding_payment/processed/{ebill_id}', 'EbillController@holdingPaymentProcessed')->name('ebill.holding_payment.processed');
		// Ebill Shipping Assignment to Driver
		Route::resource('driver_assignments', 'DriverAssignmentController');
		Route::post('driver_shipping-data', 'DriverAssignmentController@ebillShippingData')->name('ebill.shipping.data');
		Route::post('driver_shipping-store', 'DriverAssignmentController@store')->name('driver_shipping-store');
		Route::post('driver_shipping-delete', 'DriverAssignmentController@delete')->name('drivers.delete_ebill');

		Route::get('settings', 'SettingController@index')->name('settings');
		Route::put('settings/update/{setting}', 'SettingController@update')->name('settings.update');

		Route::get('bank', 'AdminBankController@index')->name('bank');
		Route::put('bank/update/{admin_bank}', 'AdminBankController@update')->name('bank.update');

		Route::get('/profile', 'AdminController@edit')->name('profile');
		Route::put('profile/update/{admin}', 'AdminController@update')->name('profile.update');
	});
});
/* ----------------------- Admin Routes END -------------------------------- */