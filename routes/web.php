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

function getItems () {
  return [
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
}

function getProducts () {
  return [
    (object)[
      "name" => "balmoral",
      "brand" => "Chesterfield",
      "price" => 500,
      "img" => "https://pictures.kare-design.com/8/KARE-83143-250x250.jpg",
      "discount" => 10
    ],
    (object)[
      "name" => "bluza consuella",
      "brand" => "BOSS",
      "price" => 595,
      "img" => "https://pictures.kare-design.com/8/KARE-83090-250x250.jpg"
    ],
    (object)[
      "name" => "skirt",
      "brand" => "BOSS",
      "price" => 500,
      "img" => "https://pictures.kare-design.com/8/KARE-83292-250x250.jpg"
    ],
    (object)[
      "name" => "kaput w casilie",
      "brand" => "BOSS",
      "price" => 595,
      "img" => "https://pictures.kare-design.com/8/KARE-83092-250x250.jpg"
    ]
  ];
}

Route::get('/', function () {
    return view('welcome');
});

// filemanager
Route::middleware('auth')->get('filemanager/show', 'FilemanagerController@index');

Route::get('/blog', function () {
  // tmp data
  $title = 'Luxury 4 Me';
  $items = getItems();
  $products = getProducts();

  return view('themes.l4m.pages.blog', compact('title', 'items', 'products'));
});

Route::get('/admin', function () {
    return view('layouts.admin-app');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
