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

Route::post('send_otp', 'UsersController@sendOTP')->name('send_otp');

Route::post('verify_otp', 'UsersController@verifyOTP')->name('verify_otp');

Route::post('register_user', 'UsersController@registerUser')->name('register_user');

Route::post('mobile_login', 'Auth\LoginController@mobileLogin');

// Route::post('register', 'Auth\RegisterController@register');

Route::post('register', 'UsersController@register');

Route::post('otpVerify', 'UsersController@otpVerify');
Route::post('admin/login', 'UsersController@login');