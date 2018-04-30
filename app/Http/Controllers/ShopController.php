<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use App\Set;
use App\Theme;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    protected $theme;

    public function __construct()
    {
        $this->theme = Theme::getTheme();
    }

    public function category($slug)
    {
        $category = Category::whereSlug($slug)->first();
        $data = Product::search($category);
        $properties = Set::first()->property;

        return view('themes.' . $this->theme . '.pages.shop', compact('category', 'data', 'properties'));
    }

    public function category2($slug1, $slug2)
    {
        $category = Category::whereSlug($slug2)->first();
        $data = Product::search($category);
        $properties = Set::first()->property;

        return view('themes.' . $this->theme . '.pages.shop', compact('category', 'data', 'properties'));
    }

    public function category3($slug1, $slug2, $slug3)
    {
        if(is_numeric($slug3)){
            $product = Product::withoutGlobalScope('attribute')->with('photo')->find($slug3);
            $category = Category::whereSlug($slug1)->first();
            $related = Product::getRelated($product, $category, $limit=6);
            return view('themes.' . $this->theme . '.pages.product', compact('category', 'product', 'related'));
        }else{
            $category = Category::whereSlug($slug3)->first();
            $data = Product::search($category);
            $properties = Set::first()->property;

            return view('themes.' . $this->theme . '.pages.shop', compact('category', 'data', 'properties'));
        }
    }
}
