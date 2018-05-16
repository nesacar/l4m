<?php

namespace App\Http\Controllers;

use App\Block;
use App\Blog;
use App\Menu;
use App\MenuLink;
use App\Order;
use App\Product;
use App\ShoppingCart;
use App\Category;
use App\Page;
use App\Post;
use App\Seo;
use App\Setting;
use App\ShopBar;
use App\Theme;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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

    public function blog()
    {
        $posts = Post::getLatest(false, 10);
        $mostView = Post::getMostView();
        $featuredProducts = ShopBar::getFeatured('blog');
        $slider = Post::getSlider();
        $categories = Category::where('parent', 0)->where('publish', 1)->orderBy('order', 'ASC')->get();
        Seo::blog($this->settings);
        return view('themes.' . $this->theme . '.pages.blog', compact('featuredProducts', 'slider', 'posts', 'mostView', 'categories'));
    }

    public function blog2($slug){
        $category = Blog::whereSlug($slug)->first();
        $posts = Post::getLatest($category, 10);
        $mostView = Post::getMostView();
        $slider = Post::getSlider();
        Seo::blogCategory(Setting::get(), $category);
        return view('themes.' . $this->theme . '.pages.blog-category', compact( 'posts', 'mostView', 'category', 'slider'));
    }

    public function blog3($slug1, $slug2){
        $category = Blog::whereSlug($slug2)->first();
        $posts = Post::getLatest($category);
        $mostView = Post::getMostView();
        Seo::blogCategory(Setting::get(), $category);
        return view('themes.' . $this->theme . '.pages.blog-category', compact( 'posts', 'mostView', 'category'));
    }

    public function blog4($slug1, $slug2, $slug3){
        if(is_numeric($slug3)) {
            $category = Blog::whereSlug($slug1)->first();
            $posts = Post::getLatest($category);
            $post = Post::with(['tag', 'gallery', 'product'])->find($slug3);
            $post->increment('views');
            $products = Post::getRelatedProducts($post);
            Seo::blogPost($post);
            $breadcrumb = $post->getBreadcrumb();
            return view('themes.' . $this->theme . '.pages.blog-post', compact('posts', 'post', 'category', 'products', 'breadcrumb'));
        }else{

        }
    }

    public function blog5($slug1, $slug2, $slug3, $slug4){
        if(is_numeric($slug4)){
            $category = Blog::whereSlug($slug1)->first();
            $posts = Post::getLatest($category);
            $post = Post::with(['tag', 'gallery', 'product'])->find($slug4);
            $post->increment('views');
            $products = Post::getRelatedProducts($post);
            Seo::blogPost($post);
            $breadcrumb = $post->getBreadcrumb();
            return view('themes.' . $this->theme . '.pages.blog-post', compact( 'posts', 'post', 'category', 'products', 'breadcrumb'));
        }else{

        }
    }

    public function proba()
    {
        //return Order::fake();
        return 'done';
    }
}
