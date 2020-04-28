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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();



Route::middleware(['auth'])->group(function(){
	Route::get('admin/home', 'AdminController@index');
	Route::get('admin/categories', 'CategoryController@index');
	Route::get('admin/category/create', 'CategoryController@create');
	Route::post('admin/category/create', 'CategoryController@store');
	Route::get('admin/category/edit/{id}', 'CategoryController@edit');
	Route::get('admin/category/locations/{category_id}', 'CategoryController@locations');
	Route::post('admin/category/locations/update', 'CategoryController@locations_update');
	Route::get('admin/category/attributes/{category_id}', 'CategoryController@attributes');
	Route::post('admin/category/attributes/update', 'CategoryController@attributes_update');

	Route::get('admin/attributes', 'AttributeController@index');
	Route::get('admin/attribute/create', 'AttributeController@create');
	Route::post('admin/attribute/create', 'AttributeController@store');
	Route::get('admin/attribute/edit/{id}', 'AttributeController@edit');
	Route::post('admin/attribute/update', 'AttributeController@update');
	Route::get('admin/attribute/delete/{id}', 'AttributeController@destroy');

	Route::get('admin/attr_options', 'AttrOptionController@index');
	Route::get('admin/attr_option/create', 'AttrOptionController@create');
	Route::post('admin/attr_option/create', 'AttrOptionController@store');
	Route::get('admin/attr_option/edit/{id}', 'AttrOptionController@edit');
	Route::post('admin/attr_option/update', 'AttrOptionController@update');
	Route::get('admin/attr_option/delete/{id}', 'AttrOptionController@destroy');

	Route::get('admin/products', 'ProductController@index');
	Route::get('admin/product/create', 'ProductController@create');
	Route::post('admin/product/create', 'ProductController@update');
	Route::get('admin/product/info/{id}', 'ProductController@edit');
	Route::post('admin/product/info/update', 'ProductController@info_update');
	Route::get('admin/product/details/{id}', 'ProductDetailController@edit');
	Route::post('admin/product/details/update', 'ProductDetailController@update');
	Route::get('admin/product/variants/{id}', 'ProductVariantController@edit');
	Route::post('admin/product/variants/update', 'ProductVariantController@update');
	Route::get('admin/product/images/{id}', 'ProductImageController@edit');
	Route::post('admin/product/images/update', 'ProductImageController@update');
	Route::get('admin/product/images/delete/{img_id}', 'ProductImageController@destroy');
	Route::get('admin/product/images/primary/{img_id}', 'ProductImageController@primary');

	Route::get('admin/countries', 'CountryController@index');
	Route::get('admin/country/create', 'CountryController@create');
	Route::post('admin/country/create', 'CountryController@store');
	Route::get('admin/country/edit/{id}', 'CountryController@edit');
	Route::post('admin/country/update', 'CountryController@update');
	Route::get('admin/country/delete/{id}', 'CountryController@destroy');

	Route::get('admin/states', 'StateController@index');
	Route::get('admin/state/create', 'StateController@create');
	Route::post('admin/state/create', 'StateController@store');
	Route::get('admin/state/edit/{id}', 'StateController@edit');
	Route::post('admin/state/update', 'StateController@update');
	Route::get('admin/state/delete/{id}', 'StateController@destroy');

	Route::get('admin/locations', 'LocationController@index');
	Route::get('admin/location/create', 'LocationController@create');
	Route::post('admin/location/create', 'LocationController@store');
	Route::get('admin/location/edit/{id}', 'LocationController@edit');
	Route::post('admin/location/update', 'LocationController@update');
	Route::get('admin/location/delete/{id}', 'LocationController@destroy');

	Route::get('admin/users', 'UserController@index');
	Route::get('admin/user/create', 'UserController@create');
	Route::post('admin/user/create', 'UserController@store');
	Route::get('admin/user/edit/{user_id}', 'UserController@edit');
	Route::get('admin/user/delete/{user_id}', 'UserController@destroy');
	Route::post('admin/user/update', 'UserController@update');

	Route::post('ajax/get_country_states', 'AjaxController@get_country_states');
});
