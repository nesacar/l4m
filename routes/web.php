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

Route::get('/blog', function () {
  // tmp data
  $title = 'Luxury 4 Me';
  $items = [
    (object) ["img" => "img src1", "title" => "tile title1" ],
    (object) ["img" => "img src2", "title" => "tile title2" ],
    (object) ["img" => "img src3", "title" => "tile title3" ],
    (object) ["img" => "img src4", "title" => "tile title4" ]
  ];

  return view('themes.l4m.pages.blog', compact('title', 'items'));
});

Route::get('/admin', function () {
    return view('layouts.admin-app');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
