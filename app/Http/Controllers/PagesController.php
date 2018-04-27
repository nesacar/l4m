<?php

namespace App\Http\Controllers;

use App\Block;
use App\Category;
use App\Post;
use App\Product;
use App\Property;
use App\Setting;
use App\ShopBar;
use App\Tag;
use App\Theme;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    protected $theme;

    public function __construct(){
        $this->theme = Theme::getTheme();
    }

    public function index(){
        $posts = Post::getLatest();
        $mostView = Post::getMostView();
        $products = Product::getHomeLatest();
        $slider = Block::find(1)->box()->with('category')->where('boxes.publish', 1)->orderBy('boxes.order', 'ASC')->get();
        $categories = Category::where('parent', 0)->where('publish', 1)->orderBy('order', 'ASC')->get();

        return view('themes.'.$this->theme.'.pages.home', compact('products', 'slider', 'posts', 'mostView', 'categories'));
    }

    public function blog(){
        $posts = Post::getLatest();
        $mostView = Post::getMostView();
        $products = Product::getHome();
        $slider = Block::find(1)->box()->with('category')->where('boxes.publish', 1)->orderBy('boxes.order', 'ASC')->get();
        $categories = Category::where('parent', 0)->where('publish', 1)->orderBy('order', 'ASC')->get();

        return view('themes.'.$this->theme.'.pages.blog', compact('products', 'slider', 'posts', 'mostView', 'categories'));
    }

    public function proba(){
        $shopBar = ShopBar::first();
        $shopBar['prod_ids'] = \DB::table('product_shop_bar')->where('product_shop_bar.shop_bar_id', $shopBar->id)->orderBy('order', 'ASC')->pluck('product_shop_bar.product_id');
        return $shopBar;
    }
}
