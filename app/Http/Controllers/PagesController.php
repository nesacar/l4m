<?php

namespace App\Http\Controllers;

use App\Block;
use App\Category;
use App\Page;
use App\Post;
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

    public function brand() {
      return view('themes.' . $this->theme . '.pages.brand');
    }

    public function proba()
    {
        //return Order::fake();
        return 'done';
    }
}
