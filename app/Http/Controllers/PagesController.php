<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\Product;
use App\Property;
use App\Setting;
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
        $slider = Post::getSlider();
        $categories = Category::where('parent', 0)->where('publish', 1)->orderBy('order', 'ASC')->get();

        return view('themes.'.$this->theme.'.pages.home', compact('products', 'slider', 'posts', 'mostView', 'categories'));
    }

    public function blog(){
        $posts = Post::getLatest();
        $mostView = Post::getMostView();
        $products = Product::getHome();
        $slider = Post::getSlider();
        $categories = Category::where('parent', 0)->where('publish', 1)->orderBy('order', 'ASC')->get();

        return view('themes.'.$this->theme.'.pages.blog', compact('products', 'slider', 'posts', 'mostView', 'categories'));
    }

    public function proba(){
        return Category::first()->product;
    }
}
