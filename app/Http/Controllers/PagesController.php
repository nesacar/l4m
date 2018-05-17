<?php

namespace App\Http\Controllers;

use App\Block;
use App\Brand;
use App\Category;
use App\Gallery;
use App\Page;
use App\Post;
use App\Product;
use App\Seo;
use App\Setting;
use App\ShopBar;
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
        Seo::home($this->settings);
        return view('themes.' . $this->theme . '.pages.home', compact('latestProducts', 'featuredProducts', 'slider', 'posts', 'categories'));
    }

    public function proba()
    {
        $array = array('Product' => 'photo');
        $product =  new Product();
        $reflection = new \ReflectionClass($product);
        //dd($reflection->getShortName());
        $string = (string) $array[$reflection->getShortName()];
        dd($string);
        $className = get_class($product->$string()->getRelated());
        dd(new $className);
        return 'done';
    }
}
