<?php

namespace App\Http\Controllers;

use App\Category;
use App\MenuLink;
use App\Product;
use App\Seo;
use App\Set;
use App\Setting;
use App\Theme;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    protected $theme;
    protected $settings;

    public function __construct()
    {
        $this->theme = Theme::getTheme();
        $this->settings = Setting::get();
    }

    public function category($slug)
    {
        $category = Category::whereSlug($slug)->first();
        $data = Product::search($category);
        $properties = Category::getProperties($slug);
        Seo::shopCategory($category);
        $breadcrumb = $category->getBreadcrumb();
        Category::setPrimaryCategory($slug);
        $menu = MenuLink::getMenu();
        return view('themes.' . $this->theme . '.pages.shop', compact('category', 'data', 'properties', 'breadcrumb', 'menu'));
    }

    public function category2($slug1, $slug2)
    {
        $category = Category::whereSlug($slug2)->first();
        $data = Product::search($category);
        $properties = Category::getProperties($slug1);
        Seo::shopCategory($category);
        $breadcrumb = $category->getBreadcrumb();
        Category::setPrimaryCategory($slug1);
        $menu = MenuLink::getMenu();
        return view('themes.' . $this->theme . '.pages.shop', compact('category', 'data', 'properties', 'breadcrumb', 'menu'));
    }

    public function category3($slug1, $slug2, $slug3)
    {
        Category::setPrimaryCategory($slug1);
        $menu = MenuLink::getMenu();
        if(is_numeric($slug3)){
            $product = Product::withoutGlobalScope('attribute', 'category')->with(['category' => function($query){
                $query->with('children');
            }])->with(['photo' => function($query){
                $query->limit(3);
            }])->find($slug3);
            $category = Category::whereSlug($slug1)->first();
            $related = Product::getRelated($product, $category, $limit=6);
            Seo::shopProduct($product, $category);
            $breadcrumb = $product->getBreadcrumb();
            return view('themes.' . $this->theme . '.pages.product', compact('category', 'product', 'related', 'breadcrumb', 'menu'));
        }else{
            $category = Category::whereSlug($slug3)->first();
            $data = Product::search($category);
            $properties = Category::getProperties($slug1);
            Seo::shopCategory($category);
            $breadcrumb = $category->getBreadcrumb();
            return view('themes.' . $this->theme . '.pages.shop', compact('category', 'data', 'properties', 'breadcrumb', 'menu'));
        }
    }

    public function category4($slug1, $slug2, $slug3, $slug4)
    {
        Category::setPrimaryCategory($slug1);
        $menu = MenuLink::getMenu();
        if(is_numeric($slug4)){
            $product = Product::withoutGlobalScope('attribute', 'category')->with(['category' => function($query){
                $query->with('children');
            }])->with(['photo' => function($query){
                $query->limit(3);
            }])->find($slug4);
            $category = Category::whereSlug($slug2)->first();
            $related = Product::getRelated($product, $category, $limit=6);
            Seo::shopProduct($product, $category);
            $breadcrumb = $product->getBreadcrumb();
            return view('themes.' . $this->theme . '.pages.product', compact('category', 'product', 'related', 'breadcrumb', 'menu'));
        }else{
            $category = Category::whereSlug($slug4)->first();
            $data = Product::search($category);
            $properties = Category::getProperties($slug1);
            Seo::shopCategory($category);
            $breadcrumb = $category->getBreadcrumb();
            return view('themes.' . $this->theme . '.pages.shop', compact('category', 'data', 'properties', 'breadcrumb', 'menu'));
        }
    }
}
