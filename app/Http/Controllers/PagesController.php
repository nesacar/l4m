<?php

namespace App\Http\Controllers;

use App\Attribute;
use App\Block;
use App\Box;
use App\Brand;
use App\BrandLink;
use App\Category;
use App\Client;
use App\Customer;
use App\Gallery;
use App\Helper;
use App\MenuLink;
use App\Page;
use App\Post;
use App\Product;
use App\Property;
use App\Seo;
use App\Set;
use App\Setting;
use App\ShopBar;
use App\ShoppingCart;
use App\Theme;
use App\User;

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
        $featuredProducts = ShopBar::getFeatured(session('category_id'), 'home');
        $latestProducts = ShopBar::getLatest(session('category_id'), 'home');
        $slider = Block::getSlider();
        $categories = Category::where(['parent' => session('category_id'), 'publish' => 1, 'featured' => 1])->orderBy('order', 'ASC')->get();
        $brands = Brand::getLogos();
        Seo::home($this->settings);
        $menu = MenuLink::getMenu();
        return view('themes.' . $this->theme . '.pages.home', compact('latestProducts', 'featuredProducts', 'slider', 'posts', 'categories', 'brands', 'menu'));
    }

    public function category($slug)
    {
        Category::setPrimaryCategory($slug);
        $posts = Post::getHomePosts();
        $featuredProducts = ShopBar::getFeatured(session('category_id'), 'home');
        $latestProducts = ShopBar::getLatest(session('category_id'), 'home');
        $slider = Block::getSlider();
        $categories = Category::where(['parent' => session('category_id'), 'publish' => 1, 'featured' => 1])->orderBy('order', 'ASC')->get();
        $brands = Brand::getLogos();
        Seo::home($this->settings);
        $menu = MenuLink::getMenu();
        return view('themes.' . $this->theme . '.pages.home', compact('latestProducts', 'featuredProducts', 'slider', 'posts', 'categories', 'brands', 'menu'));
//        Category::setPrimaryCategory($slug);
//        return redirect(MenuLink::getFirstChild($slug));
    }

    public function proba()
    {
        return ShoppingCart::first();
        //return Attribute::find(41)->product;
//        $product = Product::find(225);
//        return $product->colors()->first();
        //\Artisan::call('cache:clear');
//        $category = Category::find(76);
//        return $product = Product::find(459)->getLink($category);
        return 'done';
    }
}
