<?php

namespace App\Http\Controllers;

use App\Block;
use App\Brand;
use App\BrandLink;
use App\Category;
use App\Customer;
use App\Gallery;
use App\Page;
use App\Post;
use App\Product;
use App\Seo;
use App\Setting;
use App\ShopBar;
use App\ShoppingCart;
use App\Theme;

class PagesController extends Controller
{
    protected $theme;
    protected $settings;

    public function __construct()
    {
        $this->theme = Theme::getTheme();
        $this->settings = Setting::get();
    }

    public function index()
    {
        $posts = Post::getHomePosts();
        $latestProducts = ShopBar::getLatest();
        $featuredProducts = ShopBar::getFeatured();
        $slider = Block::find(1)->box()->with('category')->where('boxes.publish', 1)->orderBy('boxes.order', 'ASC')->get();
        $categories = Category::where('parent', 0)->where('publish', 1)->orderBy('order', 'ASC')->get();
        $brands = Brand::getLogos();
        Seo::home($this->settings);
        return view('themes.' . $this->theme . '.pages.home', compact('latestProducts', 'featuredProducts', 'slider', 'posts', 'categories', 'brands'));
    }

    public function proba()
    {
//        $product = Product::first();
        //\Cart::destroy();
//        \Cart::add(['id' => $product->id, 'name' => $product->title, 'qty' => 1, 'price' => $product->price, 'options' => ['size' => 'small']]);
//        return $products = \Cart::content();
        //\Cart::store('nebojsart1409@yahoo.com');
        //\Session::forget('currency');
        return \Session::get('currency');
        return 'done2';
    }
}
