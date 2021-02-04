<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
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
		// users list
		Route::get('users', 'UsersController@index');
		Route::post('/user/update_status', 'UsersController@updateStatus');
		
		// brand master
		Route::resource('brands', 'BrandController');
		// user master
		Route::resource('users', 'UsersController');
		
	});
});
/* ----------------------- Admin Routes END -------------------------------- */