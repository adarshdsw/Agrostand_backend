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

// Route::post('register', 'Auth\RegisterController@register');

Route::post('register', 'UsersController@register');

Route::post('otpVerify', 'UsersController@otpVerify');

Route::post('login', 'UsersController@login');
// banners list and Details
Route::get('/banners', 'Admin\BannerController@index')->name('banners');
// news list and Details
Route::post('/news', 'Admin\NewsController@index')->name('news');
// news list and Details
Route::post('/schemes', 'Admin\SchemeController@index')->name('schemes');
// post master
	Route::post('/posts', 'Api\PostController@index');
	Route::post('/post/store', 'Api\PostController@store');
	Route::get('/post/show/{id}', 'Api\PostController@show');
	Route::delete('/post/delete', 'Api\PostController@destroy');
	Route::post('/post/view_increment', 'Api\PostController@viewIncrement');
	Route::post('/post/like', 'Api\PostController@like');
	Route::post('/post/favorite', 'Api\PostController@favorite');
	Route::post('/post/comment', 'Api\PostController@comment');
	// user own posts
	Route::post('/post/user/', 'Api\PostController@userPosts')->name('user.own.posts');

// product master
	Route::post('/products', 'Api\ProductController@index');
	Route::post('/product/store', 'Api\ProductController@store');
	Route::get('/product/show/{id}', 'Api\ProductController@show');
	Route::get('/product/group', 'Api\ProductController@productGroup');
	// Buy lead store
	Route::post('/buy/lead_store', 'Api\BuyController@store');
	Route::post('/buy/product_list', 'Api\BuyController@index');
	// Buy product list

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
