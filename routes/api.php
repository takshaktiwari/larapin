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
Route::get('districts', 'Api\AddressConroller@districts');
Route::get('district', 'Api\AddressConroller@district');
Route::get('pincodes', 'Api\AddressConroller@pincodes');
Route::get('pincode', 'Api\AddressConroller@pincode');
Route::get('locations', 'Api\AddressConroller@locations');
Route::get('location', 'Api\AddressConroller@location');

Route::get('shipping_slots', 'Api\CheckoutController@shipping_slots');
Route::get('shipping_charge', 'Api\CheckoutController@shipping_charge');

Route::middleware('auth:api')->group(function(){
	Route::post('change_password', 'Api\UserController@change_password');

	Route::get('wishlist', 'Api\WishlistController@wishlist');
	Route::get('wishlist/add', 'Api\WishlistController@add');

	Route::get('wishlist/delete', 'Api\WishlistController@destroy');
	Route::post('coupon_verify', 'Api\CheckoutController@coupon_verify');

	Route::get('address', 'Api\AddressConroller@address');
	Route::get('addresses', 'Api\AddressConroller@addresses');
	Route::post('address_create', 'Api\AddressConroller@address_create');
	Route::post('address_update', 'Api\AddressConroller@address_update');

	Route::post('checkout', 'Api\CheckoutController@checkout');
	Route::get('orders', 'Api\OrderController@orders');
	Route::get('order_detail', 'Api\OrderController@order_detail');
});