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
Route::get('/shop','OrderController@index')->name('shop.index');

Route::get('/shop_display_seeds','OrderController@display_seeds')->name('order.display_seed');
Route::post('/seed_details','OrderController@seed_details')->name('order.seed_details');
