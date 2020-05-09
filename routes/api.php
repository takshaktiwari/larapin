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

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::post('register', 'Api\UserController@register');
Route::post('login', 'Api\UserController@login');

Route::get('slider', 'Api\SliderController@index');

Route::get('categories', 'Api\CategoryController@categories');
Route::get('category', 'Api\CategoryController@category');
Route::get('products', 'Api\ProductController@products');
Route::get('product', 'Api\ProductController@product');
Route::get('reviews', 'Api\ReviewsController@reviews');
Route::get('review', 'Api\ReviewsController@review_single');

Route::get('countries', 'Api\AddressConroller@countries');
Route::get('country', 'Api\AddressConroller@country');
Route::get('states', 'Api\AddressConroller@states');
Route::get('state', 'Api\AddressConroller@state');
Route::get('locations', 'Api\AddressConroller@locations');
Route::get('location', 'Api\AddressConroller@location');

Route::middleware('auth:api')->group(function(){
	Route::get('address', 'Api\AddressConroller@address');
	Route::get('addresses', 'Api\AddressConroller@addresses');
	Route::post('address_create', 'Api\AddressConroller@address_create');
	Route::post('address_update', 'Api\AddressConroller@address_update');
});