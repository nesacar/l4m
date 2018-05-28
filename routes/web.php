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

Route::get('brendovi', 'BrandsController@index');
Route::get('brendovi/{slug}', 'BrandsController@show');

Route::post('subscribe', 'SubscribersController@subscribe')->name('subscribe');
Route::post('unSubscribe/{verification}', 'SubscribersController@unSubscribe');

Route::get('/admin', function () {
    return view('layouts.admin-app');
});

Route::get('/client/about', function() {
  return view('themes.l4m.pages.client.about');
});

Route::get('/client/shop', function() {
  return view('themes.l4m.pages.client.shop');
});

Route::get('/client/akcije', function() {
  return view('themes.l4m.pages.client.akcije');
});

Route::get('/client/blog', function() {
  return view('themes.l4m.pages.client.blog');
});

Route::get('/brands', function() {
  return view('themes.l4m.pages.brands');
});

Route::get('/registration', function() {
  return view('themes.l4m.pages.registration');
});

Auth::routes();

//Route::get('home', 'HomeController@index')->name('home');

Route::get('proba', 'PagesController@proba');

Route::get('shop/{slug}', 'ShopController@category');
Route::get('shop/{slug1}/{slug2}', 'ShopController@category2');
Route::get('shop/{slug1}/{slug2}/{slug3}', 'ShopController@category3');
Route::get('shop/{slug1}/{slug2}/{slug3}/{slug4}', 'ShopController@category4');

Route::get('blog', 'BlogsController@blog');
Route::get('blog/{slug1}', 'BlogsController@blog2');
Route::get('blog/{slug1}/{slug2}', 'BlogsController@blog3');
Route::get('blog/{slug1}/{slug2}/{slug3}', 'BlogsController@blog4');
Route::get('blog/{slug1}/{slug2}/{slug3}/{slug4}', 'BlogsController@blog5');

/** CART **/
Route::get('korpa', 'CartsController@index');
Route::post('korpa', 'CartsController@getIds');
Route::post('korpa/{id}/add', 'CartsController@add');
Route::post('korpa/{id}/remove', 'CartsController@remove');
Route::get('korpa/store', 'CartsController@store');

Route::get('{slug}', 'ClientsController@home');
Route::get('{slug}/o-nama', 'ClientsController@about');
Route::get('{slug}/shop', 'ClientsController@shop');
Route::get('{slug}/akcije', 'ClientsController@action');
Route::get('{slug}/blog', 'ClientsController@blog');
