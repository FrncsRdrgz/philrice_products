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
Route::get('/logout', 'Auth\LoginController@logout')->name('logout' );
Auth::routes();

Route::group(['middleware' => 'auth'], function(){
	Route::get('/', 'HomeController@index')->name('index');
	Route::post('/view_cart_data','HomeController@view_cart_data')->name('home.view_cart_data');

	Route::get('/shop','ShopController@index')->name('shop.index');

	Route::get('/shop_display_seeds','ShopController@display_seeds')->name('order.display_seed');

	Route::post('/seed_details','ShopController@seed_details')->name('order.seed_details');
	Route::post('/add_to_cart','ShopController@add_to_cart')->name('order.add_to_cart');


	Route::get('/cart','CartController@index')->name('cart.index');
	Route::get('/view_cart_data','CartController@view_cart_data')->name('cart.view_cart_data');
	Route::get('/get_shipping_addresses','CartController@get_shipping_addresses');
	Route::get('/get_active_address','CartController@active_address');
	Route::get('/set_active_address/{id}','CartController@set_active_address');
	Route::post('/municipalities','CartController@municipalities');
	Route::post('/save_address','CartController@save_address');
	Route::post('/change_quantity','CartController@change_quantity');
	Route::post('/delete_cart_item','CartController@delete_cart_item');
	Route::post('/proceed_reservation','CartController@proceed_reservation');

	Route::get('/order','MyOrderController@index');
	Route::get('/getOrders','MyOrderController@getOrders');
	Route::get('/checkout','CheckoutController@checkout')->name('checkout.index'); 

});

