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

// filemanager
Route::middleware('auth')->get('filemanager/show', 'FilemanagerController@index');

Route::get('/', 'PagesController@index');

Route::post('subscribe', 'SubscribersController@subscribe')->name('subscribe');
Route::post('unSubscribe/{verification}', 'SubscribersController@unSubscribe');

Route::get('/admin', function () {
    return view('layouts.admin-app');
});

Auth::routes();

Route::get('home', 'HomeController@index')->name('home');

Route::get('proba', 'PagesController@proba');

Route::get('shop/{slug}', 'ShopController@category');
Route::get('shop/{slug1}/{slug2}', 'ShopController@category2');
Route::get('shop/{slug1}/{slug2}/{slug3}', 'ShopController@category3');
Route::get('shop/{slug1}/{slug2}/{slug3}/{slug4}', 'ShopController@category4');

Route::get('blog', 'PagesController@blog');
Route::get('blog/{slug1}', 'PagesController@blog2');
Route::get('blog/{slug1}/{slug2}', 'PagesController@blog3');
Route::get('blog/{slug1}/{slug2}/{slug3}', 'PagesController@blog4');
Route::get('blog/{slug1}/{slug2}/{slug3}/{slug4}', 'PagesController@blog5');

/** CART **/
Route::get('korpa', 'CartsController@index');
Route::get('korpa/{product}', 'CartsController@store');
Route::get('korpa/{product}/one', 'CartsController@reduceByOne');
Route::get('korpa/{product}/all', 'CartsController@removeItem');

Route::get('lista-zelja', 'WishListsController@index');
Route::get('lista-zelja/{product}', 'WishListsController@store');
