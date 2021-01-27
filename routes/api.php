<?php


use Illuminate\Http\Request;

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

Route::get('languages', 'UsersController@languageList')->name('languages');

Route::get('countries', 'UsersController@countryList')->name('countries');

Route::get('categories', 'UsersController@categoryList')->name('categories');

Route::post('sub_categories', 'UsersController@subCategoryList')->name('sub_categories');

Route::post('commodities', 'UsersController@commodityList')->name('commodities');

Route::post('states', 'UsersController@stateList')->name('states');

Route::post('select_language', 'UsersController@selectLanguage')->name('select_language');

Route::post('send_otp', 'UsersController@sendOTP')->name('send_otp');

Route::post('resend_otp', 'UsersController@resendOTP')->name('resend_otp');

Route::post('verify_otp', 'UsersController@verifyOTP')->name('verify_otp');

Route::post('register_user', 'UsersController@registerUser')->name('register_user');

Route::post('mobile_login', 'Auth\LoginController@mobileLogin');

Route::post('get_user_profile', 'UsersController@getUserProfile')->name('get_user_profile');

Route::post('update_user_profile', 'UsersController@updateUserProfile')->name('update_user_profile');

// Route::post('register', 'Auth\RegisterController@register');

Route::post('register', 'UsersController@register');

Route::post('otpVerify', 'UsersController@otpVerify');

Route::post('login', 'UsersController@login');
// banners list and Details
Route::get('/banners', 'Admin\BannerController@index')->name('banners');
// news list and Details
Route::get('/news', 'Admin\NewsController@index')->name('news');
// news list and Details
Route::get('/schemes', 'Admin\SchemeController@index')->name('schemes');


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
});
