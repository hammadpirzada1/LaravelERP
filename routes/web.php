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

Route::group(['middleware' => ['auth']], function () {
	Route::view('dashboard', 'admin/home');
	Route::view('admin/home', 'admin/home');
	Route::resource('admin/product', 'ProductMasterController');
	Route::resource('admin/category', 'ProductCategoryController');
	Route::resource('admin/order', 'OrderMasterController');
	Route::resource('admin/warehouse', 'WarehouseController');
	Route::resource('admin/role', 'RoleController');
	Route::resource('admin/user', 'UserController');
	Route::resource('admin/purchase', 'PurchaseMasterController');
	Route::get('/cart', 'OrderMasterController@cart')->name('order.cart');
	Route::get('/addProducts', 'WarehouseController@addProducts')->name('warehouse.products');

});