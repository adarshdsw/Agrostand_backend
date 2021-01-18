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



/* ----------------------- Admin Routes START -------------------------------- */

Route::prefix('admin')->name('admin.')->namespace('Admin')->group(function(){
	Route::post('login', 'AdminController@login');
});
