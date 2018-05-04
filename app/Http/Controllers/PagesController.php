<?php

namespace App\Http\Controllers;

use App\Attribute;
use App\Block;
use App\Blog;
use App\Cart;
use App\Category;
use App\Collection;
use App\Gallery;
use App\Page;
use App\Photo;
use App\Post;
use App\Product;
use App\Seo;
use App\Set;
use App\Setting;
use App\ShopBar;
use App\Theme;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

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
        $posts = Post::getLatest();
        $latestProducts = ShopBar::getLatest();
        $featuredProducts = ShopBar::getFeatured();
        $slider = Block::find(1)->box()->with('category')->where('boxes.publish', 1)->orderBy('boxes.order', 'ASC')->get();
        $categories = Category::where('parent', 0)->where('publish', 1)->orderBy('order', 'ASC')->get();
        Seo::home($this->settings);
        return view('themes.' . $this->theme . '.pages.home', compact('latestProducts', 'featuredProducts', 'slider', 'posts', 'categories'));
    }

    public function blog()
    {
        $posts = Post::getLatest();
        $mostView = Post::getMostView();
        $featuredProducts = ShopBar::getFeatured('blog');
        $slider = Block::find(1)->box()->with('category')->where('boxes.publish', 1)->orderBy('boxes.order', 'ASC')->get();
        $categories = Category::where('parent', 0)->where('publish', 1)->orderBy('order', 'ASC')->get();
        Seo::blog($this->settings);
        return view('themes.' . $this->theme . '.pages.blog', compact('featuredProducts', 'slider', 'posts', 'mostView', 'categories'));
    }

    public function blog2($slug){
        $category = Blog::whereSlug($slug)->first();
        $posts = Post::getLatest($category);
        $mostView = Post::getMostView();
        Seo::blogCategory(Setting::get(), $category);
        return view('themes.' . $this->theme . '.pages.blog-category', compact( 'posts', 'mostView', 'category'));
    }

    public function blog3($slug1, $slug2){
        $category = Blog::whereSlug($slug2)->first();
        $posts = Post::getLatest($category);
        $mostView = Post::getMostView();
        Seo::blogCategory(Setting::get(), $category);
        return view('themes.' . $this->theme . '.pages.blog-category', compact( 'posts', 'mostView', 'category'));
    }

    public function blog4($slug1, $slug2, $slug3){
        $category = Blog::whereSlug($slug1)->first();
        $posts = Post::getLatest($category);
        $post = Post::with(['tag', 'gallery'])->find($slug3);
        $post->increment('views');
        Seo::blogPost($post);
        return view('themes.' . $this->theme . '.pages.blog-post', compact( 'posts', 'post', 'category'));
    }

    public function blog5($slug1, $slug2, $slug3, $slug4){
        if(is_numeric($slug3)){
            $category = Blog::whereSlug($slug1)->first();
            $posts = Post::getLatest($category);
            $post = Post::with(['tag', 'gallery'])->find($slug3);
            $post->increment('views');
            Seo::blogPost($post);
            return view('themes.' . $this->theme . '.pages.blog-post', compact( 'posts', 'post', 'category'));
        }else{

        }
    }

    public function proba()
    {
//        $ids = [4,11,13];
//        return Product::withoutGlobalScopes()->whereHas('attribute', function($q) use($ids) {
//            $q->whereIn('attributes.id', $ids)
//                ->groupBy('products.id')
//                ->havingRaw('COUNT(DISTINCT attributes.id) = '.count($ids));
//        })->get();
        //Artisan::call('storage:link');
//        return $products = Product::withoutGlobalScope('attribute')->with(['category' => function($query){
//            $query->orderBy('parent', 'DESC')->first();
//        }])->orderBy('id', 'DESC')->paginate(50);
//        phpinfo();
//        return;
    }
}
