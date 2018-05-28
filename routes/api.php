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

Route::get('users/logout', 'Api\UsersController@logout');
Route::get('users/get-users', 'Api\UsersController@getUsers');
Route::post('users/change-password', 'Api\UsersController@changePassword');
Route::resource('users', 'Api\UsersController');
Route::get('users/{id}/client', 'Api\UsersController@clientByUser');
Route::post('users/{id}/image', 'Api\UsersController@uploadImage');

Route::get('settings/{id}/edit', 'Api\SettingsController@edit');
Route::put('settings/{id}', 'Api\SettingsController@update');

Route::resource('themes', 'Api\ThemesController');
Route::post('themes/{id}/image', 'Api\ThemesController@uploadImage');

Route::resource('menus', 'Api\MenusController');

Route::get('menu-links/lists', 'Api\MenuLinksController@lists');
Route::resource('menu-links', 'Api\MenuLinksController');
Route::get('menu-links/{id}/sort', 'Api\MenuLinksController@sort');
Route::post('menu-links/{id}/image', 'Api\MenuLinksController@uploadImage');
Route::post('menu-links/{id}/order', 'Api\MenuLinksController@saveOrder');

Route::get('blogs/lists', 'Api\BlogsController@lists');
Route::resource('blogs', 'Api\BlogsController');
Route::post('blogs/{id}/image', 'Api\BlogsController@uploadImage');

Route::post('posts/search', 'Api\PostsController@search');
Route::get('posts/lists', 'Api\PostsController@lists');
Route::resource('posts', 'Api\PostsController');
Route::post('posts/{id}/products', 'Api\PostsController@products');
Route::post('posts/{id}/image', 'Api\PostsController@uploadImage');
Route::post('posts/{id}/gallery', 'Api\PostsController@galleryUpdate');
Route::get('posts/{id}/gallery', 'Api\PostsController@gallery');

Route::post('tags/search', 'Api\TagsController@search');
Route::get('tags/lists', 'Api\TagsController@lists');
Route::resource('tags', 'Api\TagsController');

Route::get('brands/lists', 'Api\BrandsController@lists');
Route::resource('brands', 'Api\BrandsController');
Route::post('brands/{id}/image', 'Api\BrandsController@uploadImage');
Route::post('brands/{id}/logo-image', 'Api\BrandsController@uploadLogoImage');
Route::get('brands/{id}/gallery', 'Api\BrandsController@gallery');
Route::post('brands/{id}/gallery', 'Api\BrandsController@uploadGallery');
Route::post('brands/{id}/remove-gallery', 'Api\BrandsController@removeGalleryImage');

Route::get('brand-links/{id}', 'Api\BrandLinksController@show');
Route::post('brand-links/{brand}', 'Api\BrandLinksController@store');
Route::put('brand-links/{id}', 'Api\BrandLinksController@update');
Route::delete('brand-links/{id}', 'Api\BrandLinksController@destroy');

Route::get('collections/lists', 'Api\CollectionsController@lists');
Route::resource('collections', 'Api\CollectionsController');
Route::post('collections/{id}/image', 'Api\CollectionsController@uploadImage');

Route::get('sets/lists', 'Api\SetsController@lists');
Route::resource('sets', 'Api\SetsController');

Route::get('properties/lists', 'Api\PropertiesController@lists');
Route::get('properties/{id}/set', 'Api\PropertiesController@listsBySet');
Route::post('properties/categories', 'Api\PropertiesController@listsByCategories');
Route::resource('properties', 'Api\PropertiesController');

Route::post('attributes/search', 'Api\AttributesController@search');
Route::get('attributes/lists', 'Api\AttributesController@lists');
Route::resource('attributes', 'Api\AttributesController');

Route::post('categories/search', 'Api\CategoriesController@search');
Route::get('categories/lists', 'Api\CategoriesController@lists');
Route::get('categories/tree', 'Api\CategoriesController@tree');
Route::resource('categories', 'Api\CategoriesController');
Route::post('categories/{id}/image', 'Api\CategoriesController@uploadImage');
Route::post('categories/{id}/clients', 'Api\CategoriesController@clients');
Route::post('categories/{id}/boxImage', 'Api\CategoriesController@uploadBoxImage');

Route::post('products/search', 'Api\ProductsController@search');
Route::get('products/lists', 'Api\ProductsController@lists');
Route::resource('products', 'Api\ProductsController');
Route::post('products/{id}/image', 'Api\ProductsController@uploadImage');
Route::post('products/{id}/clone', 'Api\ProductsController@cloneProduct');
Route::post('products/{id}/code', 'Api\ProductsController@code');
Route::post('products/{id}/gallery', 'Api\ProductsController@galleryUpdate');
Route::get('products/{id}/gallery', 'Api\ProductsController@gallery');

Route::post('photos/{id}/destroy', 'Api\PhotosController@destroy');

Route::post('galleries/{id}/destroy', 'Api\GalleriesController@destroy');

Route::get('blocks/lists', 'Api\BlocksController@lists');
Route::resource('blocks', 'Api\BlocksController');

Route::resource('boxes', 'Api\BoxesController');
Route::post('boxes/{id}/image', 'Api\BoxesController@uploadImage');
Route::post('boxes/{id}/smallImage', 'Api\BoxesController@uploadSmallImage');

Route::resource('shop-bars', 'Api\ShopBarsController');

Route::resource('subscribers', 'Api\SubscribersController');

Route::put('customers/{id}/edit/{user}', 'Api\CustomersController@updateCustomer');
Route::resource('customers', 'Api\CustomersController');

Route::resource('shopping-carts', 'Api\ShoppingCartsController');

Route::resource('currencies', 'Api\CurrenciesController');

Route::get('clients/lists', 'Api\ClientsController@lists');
Route::resource('clients', 'Api\ClientsController');
Route::post('clients/{id}/image', 'Api\ClientsController@uploadImage');
Route::get('clients/{id}/categories', 'Api\ClientsController@categories');
Route::post('clients/{id}/categories', 'Api\ClientsController@categoriesUpdate');