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

Route::get('/run', function () {
	$output  = '<pre>';
    Artisan::call("migrate:rollback");
    $output .= Artisan::output();
    $output .= '<br>';

    Artisan::call("migrate");
    $output .= Artisan::output();
    $output .= '<br>';

    Artisan::call("db:seed");
    $output .= Artisan::output();

    return $output;
});

Auth::routes();


Route::get('template_mode_change', 'HomeController@template_mode_change');

Route::middleware(['auth'])->prefix('admin')->group(function(){
	Route::get('home', 'AdminController@index');
	Route::get('change_password', 'AdminController@change_password');
	Route::post('change_password', 'AdminController@change_password_do');

	Route::get('categories', 'CategoryController@index');
	Route::get('category/create', 'CategoryController@create');
	Route::post('category/create', 'CategoryController@store');
	Route::get('category/edit/{id}', 'CategoryController@edit');
	Route::get('category/locations/{category_id}', 'CategoryController@locations');
	Route::post('category/locations/update', 'CategoryController@locations_update');
	Route::get('category/attributes/{category_id}', 'CategoryController@attributes');
	Route::post('category/attributes/update', 'CategoryController@attributes_update');

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

	Route::get('product_reviews', 'ProductReviewController@index');
	Route::get('product_review/show/{id}', 'ProductReviewController@show');
	Route::get('product_review/delete/{id}', 'ProductReviewController@destroy');

	Route::get('discount/categories', 'DiscountCategoryController@index');
	Route::post('discount/categories/update', 'DiscountCategoryController@update');

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

	Route::get('user/{user_id}/addresses', 'UserAddressController@index');
	Route::get('user/{user_id}/address/create', 'UserAddressController@create');
	Route::post('user/address/create', 'UserAddressController@store');
	Route::get('user/address/primary/{addr_id}', 'UserAddressController@primary_addr');
	Route::get('user/address/edit/{addr_id}', 'UserAddressController@edit');
	Route::post('user/address/update', 'UserAddressController@update');

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
});

Route::post('ajax/get_country_states', 'AjaxController@get_country_states');
Route::post('ajax/get_state_locations', 'AjaxController@get_state_locations');
Route::post('ajax/get_location_pincode', 'AjaxController@get_location_pincode');
