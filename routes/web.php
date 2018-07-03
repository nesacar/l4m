<?php

// filemanager
Route::middleware('admin')->get('filemanager/show', 'FilemanagerController@index');

Route::get('/', 'PagesController@index');

Route::get('brendovi', 'BrandsController@index');
Route::get('brendovi/{slug}', 'BrandsController@show');

Route::post('subscribe', 'SubscribersController@subscribe')->name('subscribe');
Route::post('unSubscribe/{verification}', 'SubscribersController@unSubscribe');

Route::get('/admin', function () {
    return view('layouts.admin-app');
});

// Vladan: user
Route::get('user/profile', 'VladanController@profile');
Route::get('user/orders', 'VladanController@orders');

// Checkout steps.

Route::get('placanje/adresa-slanja', 'CheckoutController@step1');
Route::post('placanje/adresa-slanja', 'CheckoutController@step1Update')->name('checkout.step1');

Route::get('placanje/nacin-slanja', 'CheckoutController@step2');
Route::post('placanje/nacin-slanja', 'CheckoutController@step2Update')->name('checkout.step2');

Route::get('placanje/nacin-placanja', 'CheckoutController@step3');
Route::post('placanje/nacin-placanja', 'CheckoutController@step3Update')->name('checkout.step3');

Route::get('placanje/potvrda-porudzbine', 'CheckoutController@step4');
Route::post('placanje/potvrda-porudzbine', 'CheckoutController@step4Update')->name('checkout.step4');

Route::get('placanje/kraj', 'CheckoutController@step5');

Route::post('nova-adresa', 'ProfilesController@createAddress')->name('create.address');

Route::get('profile/{registration}/confirmation', 'ProfilesController@emailConfirmation');
Route::get('profile', 'ProfilesController@profile');

// /Checkout steps.

Route::get('register', 'CustomersController@register');
Auth::routes();

//Route::get('home', 'HomeController@index')->name('home');

Route::get('proba', 'PagesController@proba');

Route::get('shop/{slug}', 'PagesController@category');
Route::get('shop/{slug1}/{slug2}', 'ShopController@category2');
Route::get('shop/{slug1}/{slug2}/{slug3}', 'ShopController@category3');
Route::get('shop/{slug1}/{slug2}/{slug3}/{slug4}', 'ShopController@category4');
Route::get('shop/{slug1}/{slug2}/{slug3}/{slug4}/{slug5}', 'ShopController@category5');

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
Route::post('korpa/update', 'CartsController@update')->name('cart.update');

Route::get('logovanje', 'CustomersController@login');
Route::get('registracija', 'CustomersController@register');

Route::get('{slug}', 'ClientsController@home');
Route::get('{slug}/o-nama', 'ClientsController@about');
Route::get('{slug}/shop', 'ClientsController@shop');
Route::get('{slug}/akcije', 'ClientsController@action');
Route::get('{slug}/blog', 'ClientsController@blog');
