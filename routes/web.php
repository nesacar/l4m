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
      "categorie" => "watches",
      "href" => "#"
    ],
    (object) [
      "img" => "img src2", 
      "title" => "Rossato Home Collection:  Masterpieces of elegance conceived",
      "categorie" => "living",
      "href" => "#"
    ],
    (object) [
      "img" => "img src3", 
      "title" => "Groove Innovative bed system",
      "categorie" => "living",
      "href" => "#"
    ],
    (object) [
      "img" => "img src4", 
      "title" => "Tom Ford Spring line - Look Like a Movie Star",
      "categorie" => "fasion",
      "href" => "#"
      ]
  ];
}

function getProducts () {
  return [
    (object)[
      "title" => "balmoral",
      "brand" => (object)[ "title" => "Chesterfield"],
      "price" => 500,
      "image" => "https://pictures.kare-design.com/8/KARE-83143-250x250.jpg",
      "discount" => 10,
      "price_outlet" => 450
    ],
    (object)[
      "title" => "bluza consuella",
      "brand" => (object)[ "title" => "BOSS"],
      "price" => 595,
      "image" => "https://pictures.kare-design.com/8/KARE-83090-250x250.jpg",
    ],
    (object)[
      "title" => "skirt",
      "brand" => (object)[ "title" => "BOSS"],
      "price" => 500,
      "image" => "https://pictures.kare-design.com/8/KARE-83292-250x250.jpg",
    ],
    (object)[
      "title" => "kaput w casilie",
      "brand" => (object)[ "title" => "BOSS"],
      "price" => 595,
      "image" => "https://pictures.kare-design.com/8/KARE-82772-250x250.jpg",
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

function getCarouselData () {
  return [
    (object)[
      'label' => 'travel',
      'img' => 'https://images.pexels.com/photos/189296/pexels-photo-189296.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260',
      'title' => 'Bentley - Inspired by the Finest Luxury Yachts',
      'desc' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Nihil corrupti consectetur facere impedit.'
    ],
    (object)[
      'label' => 'travel',
      'img' => 'https://images.pexels.com/photos/380285/pexels-photo-380285.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260',
      'title' => 'Bentley - Inspired by the Finest Luxury Yachts',
      'desc' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Nihil corrupti consectetur facere impedit.'
    ],
    (object)[
      'label' => 'travel',
      'img' => 'https://images.pexels.com/photos/271795/pexels-photo-271795.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260',
      'title' => 'Bentley - Inspired by the Finest Luxury Yachts',
      'desc' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Nihil corrupti consectetur facere impedit.'
    ],
  ];
}

//Route::get('/', function () {
//  // tmp data
//  $title = 'Luxury 4 Me';
//  $products = getProducts();
//  $carouselData = getCarouselData();
//
//  return view('themes.l4m.pages.home', compact('title', 'products', 'carouselData'));
//});

// filemanager
Route::middleware('auth')->get('filemanager/show', 'FilemanagerController@index');

Route::get('/', 'PagesController@index');
Route::get('blog', 'PagesController@blog');

//Route::get('/blog', function () {
//  // tmp data
//  $theme = 'l4m';
//  $title = 'Luxury 4 Me - Blog';
//  $items = getItems();
//  $products = getProducts();
//  $categories = getCategories();
//  $carouselData = $slider = getCarouselData();
//
//  return view('themes.l4m.pages.blog', compact('title', 'items', 'products', 'categories', 'carouselData', 'theme', 'slider'));
//});

Route::get('/shop', function () {
  // tmp data
  $title = 'Luxury 4 Me - Shop';
  $products = \App\Product::paginate(20);

  return view('themes.l4m.pages.shop', compact('title', 'products'));
});

Route::get('/product', function () {
  $title = 'Product';
  $product = \App\Product::first();
  $products = \App\Product::paginate(4);

  return view('themes.l4m.pages.product', compact('title', 'product', 'products'));
});

Route::get('/admin', function () {
    return view('layouts.admin-app');
});

Auth::routes();

Route::get('home', 'HomeController@index')->name('home');

Route::get('proba', 'PagesController@proba');
