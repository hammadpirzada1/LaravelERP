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
	Route::view('dashboard', 'admin/index');
	Route::view('home', 'admin/index');
	Route::resource('product', 'ProductMasterController');
	Route::resource('category', 'ProductCategoryController');
	Route::resource('order', 'OrderMasterController');
	Route::resource('warehouse', 'WarehouseController');
	Route::resource('role', 'RoleController');
	Route::resource('user', 'UserController');
	Route::get('/cart', 'OrderMasterController@cart')->name('order.cart');
});