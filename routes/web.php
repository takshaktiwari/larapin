<?php

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

Auth::routes();

Route::get('/', 'HomeController@index');
Route::get('page/{slug}', 'PageController@front_show');

Route::get('categories', 'CategoryController@front_index');
Route::get('shop', 'ShopController@index');
Route::get('product/{slug}', 'ShopController@product');
Route::get('reviews/{slug}', 'ProductReviewController@front_reviews');

Route::get('cart', 'CartController@cart');
Route::get('cart/store', 'CartController@store');
Route::post('cart/update', 'CartController@update');
Route::get('cart/remove/{id}', 'CartController@remove');
Route::post('cart/coupon_apply', 'CartController@coupon_apply');

Route::get('checkout', 'CheckoutController@checkout');
Route::post('checkout/do', 'CheckoutController@checkout_do');
Route::get('order/confirmation/{order_id}', 'OrderController@confirmation');

Route::middleware(['auth'])->group(function(){
	Route::post('review/create', 'ProductReviewController@front_store');
});

Route::middleware(['auth'])->prefix('user')->group(function(){
	Route::get('home', 'UserController@home');
	Route::get('orders', 'OrderController@front_orders');
	Route::get('order/{id}', 'OrderController@front_order_detail');
	Route::post('order/cancel', 'OrderHistoryController@front_order_cancel');

	Route::get('wishlist', 'WishlistController@wishlist');
	Route::get('wishlist/add/{product_id}', 'WishlistController@add');
	Route::get('wishlist/delete/{id}', 'WishlistController@destroy');
	
	Route::get('addresses', 'UserAddressController@front_addresses');
	Route::get('address/create', 'UserAddressController@front_create');
	Route::post('address/create', 'UserAddressController@store');
	Route::get('address/edit/{addr_id}', 'UserAddressController@front_edit');
	Route::post('address/update', 'UserAddressController@update');
	Route::get('address/delete/{addr_id}', 'UserAddressController@destroy');

	Route::get('profile', 'UserController@profile');
	Route::post('profile/update', 'UserController@profile_update');

	Route::get('change_password', 'UserController@change_password');
	Route::post('change_password', 'UserController@change_password_do');
});


Route::middleware(['auth', 'admin'])->prefix('admin')->group(function(){
	Route::get('home', 'AdminController@index');
	Route::get('change_password', 'AdminController@change_password');
	Route::post('change_password', 'AdminController@change_password_do');

	Route::get('categories', 'CategoryController@index');
	Route::get('category/create', 'CategoryController@create');
	Route::post('category/create', 'CategoryController@store');
	Route::get('category/edit/{id}', 'CategoryController@edit');
	
	Route::get('category/attributes/{category_id}', 'CategoryController@attributes');
	Route::post('category/attributes/update', 'CategoryController@attributes_update');

	Route::get('category/{category_id}/countries', 'CategoryController@countries');
	Route::post('category/countries/update', 'CategoryController@countries_update');
	Route::get('category/{category_id}/states', 'CategoryController@states');
	Route::post('category/states/update', 'CategoryController@states_update');
	Route::get('category/{category_id}/districts', 'CategoryController@districts');
	Route::post('category/districts/update', 'CategoryController@districts_update');
	Route::get('category/{category_id}/pincodes', 'CategoryController@pincodes');
	Route::post('category/pincodes/update', 'CategoryController@pincodes_update');

	Route::get('attributes', 'AttributeController@index');
	Route::get('attribute/create', 'AttributeController@create');
	Route::post('attribute/create', 'AttributeController@store');
	Route::get('attribute/edit/{id}', 'AttributeController@edit');
	Route::post('attribute/update', 'AttributeController@update');
	Route::get('attribute/delete/{id}', 'AttributeController@destroy');

	Route::get('brands', 'BrandController@index');
	Route::get('brand/create', 'BrandController@create');
	Route::post('brand/create', 'BrandController@store');
	Route::get('brand/edit/{id}', 'BrandController@edit');
	Route::post('brand/update', 'BrandController@update');
	Route::get('brand/delete/{id}', 'BrandController@destroy');

	Route::get('attr_options', 'AttrOptionController@index');
	Route::get('attr_option/create', 'AttrOptionController@create');
	Route::post('attr_option/create', 'AttrOptionController@store');
	Route::get('attr_option/edit/{id}', 'AttrOptionController@edit');
	Route::post('attr_option/update', 'AttrOptionController@update');
	Route::get('attr_option/delete/{id}', 'AttrOptionController@destroy');

	Route::get('products', 'ProductController@index');
	Route::get('product/create', 'ProductController@create');
	Route::post('product/create', 'ProductController@store');
	Route::get('product/info/{id}', 'ProductController@edit');
	Route::post('product/info/update', 'ProductController@info_update');
	Route::get('product/details/{id}', 'ProductDetailController@edit');
	Route::post('product/details/update', 'ProductDetailController@update');
	Route::get('product/variants/{id}', 'ProductVariantController@edit');
	Route::post('product/variants/update', 'ProductVariantController@update');
	Route::get('product/images/{id}', 'ProductImageController@edit');
	Route::post('product/images/update', 'ProductImageController@update');
	Route::get('product/images/delete/{img_id}', 'ProductImageController@destroy');
	Route::get('product/images/primary/{img_id}', 'ProductImageController@primary');
	Route::get('product/delete/{id}', 'ProductController@destroy');


	Route::get('product_reviews', 'ProductReviewController@index');
	Route::get('product_review/show/{id}', 'ProductReviewController@show');
	Route::get('product_review/delete/{id}', 'ProductReviewController@destroy');

	Route::get('discount/categories', 'DiscountCategoryController@index');
	Route::post('discount/categories/update', 'DiscountCategoryController@update');
	Route::get('discount/products', 'DiscountProductController@index');
	Route::post('discount/products/update', 'DiscountProductController@update');

	Route::get('coupons', 'CouponController@index');
	Route::get('coupon/create', 'CouponController@create');
	Route::post('coupon/create', 'CouponController@store');
	Route::get('coupon/edit/{id}', 'CouponController@edit');
	Route::post('coupon/update', 'CouponController@update');
	Route::get('coupon/delete/{id}', 'CouponController@destroy');
	Route::get('coupon/show/{id}', 'CouponController@show');

	Route::get('orders', 'OrderController@orders');
	Route::get('order/detail/{id}', 'OrderController@detail');
	Route::get('order/delete/{id}', 'OrderController@destroy');
	Route::post('order/history/create', 'OrderHistoryController@store');

	Route::get('countries', 'CountryController@index');
	Route::get('country/create', 'CountryController@create');
	Route::post('country/create', 'CountryController@store');
	Route::get('country/edit/{id}', 'CountryController@edit');
	Route::post('country/update', 'CountryController@update');
	Route::get('country/delete/{id}', 'CountryController@destroy');

	Route::get('states', 'StateController@index');
	Route::get('state/create', 'StateController@create');
	Route::post('state/create', 'StateController@store');
	Route::get('state/edit/{id}', 'StateController@edit');
	Route::post('state/update', 'StateController@update');
	Route::get('state/delete/{id}', 'StateController@destroy');

	Route::get('districts', 'DistrictController@index');
	Route::get('district/create', 'DistrictController@create');
	Route::post('district/create', 'DistrictController@store');
	Route::get('district/edit/{id}', 'DistrictController@edit');
	Route::post('district/update', 'DistrictController@update');
	Route::get('district/delete/{id}', 'DistrictController@destroy');

	Route::get('pincodes', 'PincodeController@index');
	Route::get('pincode/create', 'PincodeController@create');
	Route::post('pincode/create', 'PincodeController@store');
	Route::get('pincode/edit/{id}', 'PincodeController@edit');
	Route::post('pincode/update', 'PincodeController@update');
	Route::get('pincode/delete/{id}', 'PincodeController@destroy');

	Route::get('locations', 'LocationController@index');
	Route::get('location/create', 'LocationController@create');
	Route::post('location/create', 'LocationController@store');
	Route::get('location/edit/{id}', 'LocationController@edit');
	Route::post('location/update', 'LocationController@update');
	Route::get('location/delete/{id}', 'LocationController@destroy');

	Route::get('users', 'UserController@index');
	Route::get('user/create', 'UserController@create');
	Route::post('user/create', 'UserController@store');
	Route::get('user/edit/{user_id}', 'UserController@edit');
	Route::get('user/delete/{user_id}', 'UserController@destroy');
	Route::post('user/update', 'UserController@update');
	Route::get('user/generate_api_token/{user_id}', 'UserController@generate_api_token');

	Route::get('user/{user_id}/addresses', 'UserAddressController@index');
	Route::get('user/{user_id}/address/create', 'UserAddressController@create');
	Route::post('user/address/create', 'UserAddressController@store');
	Route::get('user/address/primary/{addr_id}', 'UserAddressController@primary_addr');
	Route::get('user/address/edit/{addr_id}', 'UserAddressController@edit');
	Route::post('user/address/update', 'UserAddressController@update');
	Route::get('user/address/delete/{addr_id}', 'UserAddressController@destroy');

	Route::get('roles', 'RoleController@index');
	Route::get('role/create', 'RoleController@create');
	Route::post('role/create', 'RoleController@store');
	Route::get('role/edit/{user_id}', 'RoleController@edit');
	Route::post('role/update', 'RoleController@update');
	Route::get('role/delete/{user_id}', 'RoleController@destroy');

	Route::get('permissions', 'PermissionController@index');
	Route::get('permission/create', 'PermissionController@create');
	Route::post('permission/create', 'PermissionController@store');
	Route::get('permission/edit/{user_id}', 'PermissionController@edit');
	Route::post('permission/update', 'PermissionController@update');

	Route::get('role_permissions', 'RolePermissionController@index');
	Route::post('role_permissions/update', 'RolePermissionController@update');

	Route::get('pages', 'PageController@index');
	Route::get('page/create', 'PageController@create');
	Route::post('page/create', 'PageController@store');
	Route::get('page/edit/{user_id}', 'PageController@edit');
	Route::post('page/update', 'PageController@update');
	Route::get('page/delete/{user_id}', 'PageController@destroy');

	Route::get('slider', 'SliderController@index');
	Route::get('slide/create', 'SliderController@create');
	Route::post('slide/create', 'SliderController@store');
	Route::get('slide/edit/{id}', 'SliderController@edit');
	Route::post('slide/update', 'SliderController@update');
	Route::get('slide/delete/{id}', 'SliderController@destroy');

	Route::get('shipping_charge', 'ShippingChargeController@index');
	Route::post('shipping_charge/update', 'ShippingChargeController@update');
	Route::post('shipping_type/update', 'ShippingChargeController@shipping_type_update');
	Route::post('shipping_global/update', 'ShippingChargeController@shipping_global_update');
	Route::get('shipping_global/delete/{id}', 'ShippingChargeController@shipping_global_destroy');

	Route::get('shipping_slots', 'ShippingSlotController@index');
	Route::get('shipping_slot/create', 'ShippingSlotController@create');
	Route::post('shipping_slot/create', 'ShippingSlotController@store');
	Route::get('shipping_slot/edit/{id}', 'ShippingSlotController@edit');
	Route::post('shipping_slot/update', 'ShippingSlotController@update');
	Route::get('shipping_slot/delete/{id}', 'ShippingSlotController@destroy');
	
	Route::get('settings', 'SettingController@index');
	Route::post('settings/update', 'SettingController@update');
});

Route::post('ajax/get_country_states', 'AjaxController@get_country_states');
Route::post('ajax/get_state_districts', 'AjaxController@get_state_districts');
Route::post('ajax/get_district_pincodes', 'AjaxController@get_district_pincodes');
Route::post('ajax/get_pincode_locations', 'AjaxController@get_pincode_locations');
Route::get('ajax/product_add_attr_price', 'AjaxController@product_add_attr_price');
