<?php

namespace App\Http\Controllers;

use App\Blog;
use App\Category;
use App\MenuLink;
use App\Post;
use App\Product;
use App\Seo;
use App\Setting;
use App\ShopBar;
use App\Theme;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class BlogsController extends Controller
{
    protected $theme;
    protected $settings;

    public function __construct()
    {
        $this->theme = Theme::getTheme();
        $this->settings = Setting::get();
    }

    public function blog()
    {
        $posts = Post::getLatest(false, false, 10);
        $mostView = Post::getMostView();
        $featuredProducts = ShopBar::getFeatured('blog');
        $slider = Post::getSlider();
        $categories = Category::where('parent', 0)->where('publish', 1)->orderBy('order', 'ASC')->get();
        Seo::blog($this->settings);
        $menu = MenuLink::getMenu();
        return view('themes.' . $this->theme . '.pages.blog.blog', compact('featuredProducts', 'slider', 'posts', 'mostView', 'categories', 'menu'));
    }

    public function blog2($slug){
        $category = Blog::whereSlug($slug)->first();
        $posts = Post::getLatest($category, false, 10);
        $mostView = Post::getMostView();
        $slider = Post::getSlider();
        Seo::blogCategory(Setting::get(), $category);
        $menu = MenuLink::getMenu();
        return view('themes.' . $this->theme . '.pages.blog.category', compact( 'posts', 'mostView', 'category', 'slider', 'menu'));
    }

    public function blog3($slug1, $slug2){
        $category = Blog::whereSlug($slug2)->first();
        $posts = Post::getLatest($category, false);
        $mostView = Post::getMostView();
        Seo::blogCategory(Setting::get(), $category);
        $menu = MenuLink::getMenu();
        return view('themes.' . $this->theme . '.pages.blog.category', compact( 'posts', 'mostView', 'category', 'menu'));
    }

    public function blog4($slug1, $slug2, $slug3){
        if(is_numeric($slug3)) {
            $category = Blog::whereSlug($slug1)->first();
            $post = Post::with(['tag', 'gallery'])->with(['product' => function($query){
                $query->withoutGlobalScope('attribute')->take(6)->inRandomOrder();
            }])->find($slug3);
            // Merge products in post
            $post = Product::relatedProductsByCategory($post, 6);
            $post->increment('views');
            $posts = $slug1 != 'info'? Post::getLatest($category, $post) : null;
            $mostView  = $slug1 != 'info'? Post::getMostView($category, $post) : null;
            Seo::blogPost($post);
            $breadcrumb = $post->getBreadcrumb();
            $menu = MenuLink::getMenu();
            return view('themes.' . $this->theme . '.pages.blog.post', compact('posts', 'post', 'category', 'breadcrumb', 'mostView', 'menu'));
        }else{
            return redirect('blog');
        }
    }

    public function blog5($slug1, $slug2, $slug3, $slug4){
        if(is_numeric($slug4)){
            $category = Blog::whereSlug($slug1)->first();
            $post = Post::with(['tag', 'gallery'])->with(['product' => function($query){
                $query->withoutGlobalScope('attribute')->take(6)->inRandomOrder();
            }])->find($slug3);
            $post->increment('views');
            $posts = $slug2 != 'info'? Post::getLatest($category, $post) : null;
            $mostView  = $slug2 != 'info'? Post::getMostView($category, $post) : null;
            Seo::blogPost($post);
            $breadcrumb = $post->getBreadcrumb();
            $menu = MenuLink::getMenu();
            return view('themes.' . $this->theme . '.pages.blog.post', compact( 'posts', 'post', 'category', 'breadcrumb', 'mostView', 'menu'));
        }else{
            return redirect('blog');
        }
    }
}
