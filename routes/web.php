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
      "img" => "https://pictures.kare-design.com/8/KARE-82772-250x250.jpg"
    ]
  ];
}

function getCategories () {
  return [
    (object)[ 'href' => 'fashion', 'text' => 'fashion', 'img' => 'https://www.luxlife.rs/chest/timg/1523975003_nike-air-jordan-1-louis-vuitton-1-963x580.jpg' ],
    (object)[ 'href' => 'jewelery', 'text' => 'watches & jewellery', 'img' => 'https://www.luxlife.rs/image.php/15.jpg?width=600&image=https://www.luxlife.rs/chest/gallery/15-najskupljih-rolex-modela/15.jpg' ],
    (object)[ 'href' => 'interior', 'text' => 'home & interior', 'img' => 'https://www.luxlife.rs/image.php/luksuz-hotel-odmor-99.jpg?width=600&image=https://www.luxlife.rs/chest/gallery/raskosno-odmaraliste-na-karibima/luksuz-hotel-odmor-99.jpg' ],
    (object)[ 'href' => 'dining', 'text' => 'fine dining', 'img' => 'https://www.luxlife.rs/chest/timg/1522240750_00.jpg' ]
  ];
}

Route::get('/', function () {
  // tmp data
  $title = 'Luxury 4 Me';
  $products = getProducts();

  return view('themes.l4m.pages.home', compact('title', 'products'));
});

// filemanager
Route::middleware('auth')->get('filemanager/show', 'FilemanagerController@index');

Route::get('/blog', function () {
  // tmp data
  $title = 'Luxury 4 Me - Blog';
  $items = getItems();
  $products = getProducts();
  $categories = getCategories();

  return view('themes.l4m.pages.blog', compact('title', 'items', 'products', 'categories'));
});

Route::get('/shop', function () {
  // tmp data
  $title = 'Luxury 4 Me - Shop';
  $items = getItems();
  $products = getProducts();

  return view('themes.l4m.pages.shop', compact('title', 'items', 'products'));
});

Route::get('/admin', function () {
    return view('layouts.admin-app');
});

Auth::routes();

Route::get('home', 'HomeController@index')->name('home');

Route::get('proba', 'PagesController@proba');
