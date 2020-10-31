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

Route::get('/', 'HomeController@index')->name('index');
Route::post('/view_cart_data','HomeController@view_cart_data')->name('home.view_cart_data');

Route::get('/shop','OrderController@index')->name('shop.index');
Route::get('/cart','OrderController@cart')->name('cart.index');
Route::get('/shop_display_seeds','OrderController@display_seeds')->name('order.display_seed');

Route::post('/seed_details','OrderController@seed_details')->name('order.seed_details');
Route::post('/add_to_cart','OrderController@add_to_cart')->name('order.add_to_cart');
Route::get('/view_cart_data','OrderController@view_cart_data')->name('order.view_cart_data');

Route::get('/checkout','OrderController@checkout')->name('checkout.index'); 