<?php

namespace App\Http\Controllers;

use App\Block;
use App\Category;
use App\Post;
use App\Product;
use App\ShopBar;
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
        $latestProducts = ShopBar::getLatest();
        $featuredProducts = ShopBar::getFeatured();
        $slider = Block::find(1)->box()->with('category')->where('boxes.publish', 1)->orderBy('boxes.order', 'ASC')->get();
        $categories = Category::where('parent', 0)->where('publish', 1)->orderBy('order', 'ASC')->get();

        return view('themes.'.$this->theme.'.pages.home', compact('latestProducts', 'featuredProducts', 'slider', 'posts', 'mostView', 'categories'));
    }

    public function blog(){
        $posts = Post::getLatest();
        $mostView = Post::getMostView();
        $featuredProducts = ShopBar::getFeatured('blog');
        $slider = Block::find(1)->box()->with('category')->where('boxes.publish', 1)->orderBy('boxes.order', 'ASC')->get();
        $categories = Category::where('parent', 0)->where('publish', 1)->orderBy('order', 'ASC')->get();

        return view('themes.'.$this->theme.'.pages.blog', compact('featuredProducts', 'slider', 'posts', 'mostView', 'categories'));
    }

    public function shopCategory($slug){
        $category = Category::whereSlug($slug)->first();
        $products = $category->product()->paginate(15);

        return view('themes.'.$this->theme.'.pages.shop', compact('category', 'products'));
    }

    public function proba(){
        return Product::search();
    }
}
