<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('users/logout', 'UsersController@logout');
Route::get('users/get-users', 'UsersController@getUsers');
Route::post('users/change-password', 'UsersController@changePassword');
Route::resource('users', 'UsersController');
Route::post('users/{id}/image', 'UsersController@uploadImage');

Route::get('settings/{id}/edit', 'SettingsController@edit');
Route::put('settings/{id}', 'SettingsController@update');

Route::resource('themes', 'ThemesController');
Route::post('themes/{id}/image', 'ThemesController@uploadImage');

Route::resource('menus', 'MenusController');

Route::get('menu-links/lists', 'MenuLinksController@lists');
Route::resource('menu-links', 'MenuLinksController');
Route::get('menu-links/{id}/sort', 'MenuLinksController@sort');
Route::post('menu-links/{id}/order', 'MenuLinksController@saveOrder');

Route::get('blogs/lists', 'BlogsController@lists');
Route::resource('blogs', 'BlogsController');
Route::post('blogs/{id}/image', 'BlogsController@uploadImage');

Route::post('posts/search', 'PostsController@search');
Route::get('posts/lists', 'PostsController@lists');
Route::resource('posts', 'PostsController');
Route::post('posts/{id}/image', 'PostsController@uploadImage');

Route::post('tags/search', 'TagsController@search');
Route::get('tags/lists', 'TagsController@lists');
Route::resource('tags', 'TagsController');

Route::get('brands/lists', 'BrandsController@lists');
Route::resource('brands', 'BrandsController');
Route::post('brands/{id}/image', 'BrandsController@uploadImage');
Route::post('brands/{id}/logo-image', 'BrandsController@uploadLogoImage');

Route::get('collections/lists', 'CollectionsController@lists');
Route::resource('collections', 'CollectionsController');
Route::post('collections/{id}/image', 'CollectionsController@uploadImage');

Route::get('sets/lists', 'SetsController@lists');
Route::resource('sets', 'SetsController');

Route::get('properties/lists', 'PropertiesController@lists');
Route::get('properties/{id}/set', 'PropertiesController@listsBySet');
Route::resource('properties', 'PropertiesController');

Route::post('attributes/search', 'AttributesController@search');
Route::get('attributes/lists', 'AttributesController@lists');
Route::resource('attributes', 'AttributesController');

Route::post('categories/search', 'CategoriesController@search');
Route::get('categories/lists', 'CategoriesController@lists');
Route::get('categories/tree', 'CategoriesController@tree');
Route::resource('categories', 'CategoriesController');
Route::post('categories/{id}/image', 'CategoriesController@uploadImage');

Route::post('products/search', 'ProductsController@search');
Route::get('products/lists', 'ProductsController@lists');
Route::resource('products', 'ProductsController');
Route::post('products/{id}/image', 'ProductsController@uploadImage');
Route::post('products/{id}/clone', 'ProductsController@cloneProduct');
Route::post('products/{id}/code', 'ProductsController@code');
Route::post('products/{id}/gallery', 'ProductsController@galleryUpdate');
Route::get('products/{id}/gallery', 'ProductsController@gallery');

Route::post('photos/{id}/destroy', 'PhotosController@destroy');

Route::post('galleries/{id}/destroy', 'GalleriesController@destroy');

Route::get('blocks/lists', 'BlocksController@lists');
Route::resource('blocks', 'BlocksController');

Route::resource('boxes', 'BoxesController');
Route::post('boxes/{id}/image', 'BoxesController@uploadImage');

Route::resource('shop-bars', 'ShopBarsController');

Route::resource('subscribers', 'SubscribersController');