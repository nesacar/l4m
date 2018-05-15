<?php

namespace App\Http\Controllers;

use App\Category;
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
        $category = Category::with('set')->whereSlug($slug)->first();
        $data = Product::search($category);
        $properties = Set::getProperties($category->set);
        Seo::shopCategory($category);
        return view('themes.' . $this->theme . '.pages.shop', compact('category', 'data', 'properties'));
    }

    public function category2($slug1, $slug2)
    {
        $category = Category::with('set')->whereSlug($slug2)->first();
        $data = Product::search($category);
        $properties = Set::getProperties($category->set);
        Seo::shopCategory($category);
        return view('themes.' . $this->theme . '.pages.shop', compact('category', 'data', 'properties'));
    }

    public function category3($slug1, $slug2, $slug3)
    {
        if(is_numeric($slug3)){
            $product = Product::withoutGlobalScope('attribute')->with('photo')->find($slug3);
            $category = Category::whereSlug($slug1)->first();
            $related = Product::getRelated($product, $category, $limit=6);
            Seo::shopProduct($product, $category);
            return view('themes.' . $this->theme . '.pages.product', compact('category', 'product', 'related'));
        }else{
            $category = Category::with('set')->whereSlug($slug3)->first();
            $data = Product::search($category);
            $properties = Set::getProperties($category->set);
            Seo::shopCategory($category);
            return view('themes.' . $this->theme . '.pages.shop', compact('category', 'data', 'properties'));
        }
    }

    public function category4($slug1, $slug2, $slug3, $slug4)
    {
        if(is_numeric($slug4)){
            $product = Product::withoutGlobalScope('attribute')->with('photo')->find($slug4);
            $category = Category::whereSlug($slug2)->first();
            $related = Product::getRelated($product, $category, $limit=6);
            Seo::shopProduct($product, $category);
            return view('themes.' . $this->theme . '.pages.product', compact('category', 'product', 'related'));
        }else{
            $category = Category::with('set')->whereSlug($slug4)->first();
            $data = Product::search($category);
            $properties = Set::getProperties($category->set);
            Seo::shopCategory($category);
            return view('themes.' . $this->theme . '.pages.shop', compact('category', 'data', 'properties'));
        }
    }
}
