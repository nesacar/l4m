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

// filemanager
Route::middleware('auth')->get('filemanager/show', 'FilemanagerController@index');

Route::get('/blog', function () {
  // tmp data
  $title = 'Luxury 4 Me';
  $items = [
    (object) [
      "img" => "img src1", 
      "title" => "WC Takes the Ingenieur Back to its Roots",
      "categorie" => "watches"
    ],
    (object) [
      "img" => "img src2", 
      "title" => "Rossato Home Collection:  Masterpieces of elegance conceived",
      "categorie" => "living"
    ],
    (object) [
      "img" => "img src3", 
      "title" => "Groove Innovative bed system",
      "categorie" => "living"
    ],
    (object) [
      "img" => "img src4", 
      "title" => "Tom Ford Spring line - Look Like a Movie Star",
      "categorie" => "fasion"
      ]
  ];

  return view('themes.l4m.pages.blog', compact('title', 'items'));
});

Route::get('/admin', function () {
    return view('layouts.admin-app');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
