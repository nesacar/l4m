<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Product;
use App\Setting;
use App\Theme;
use Illuminate\Http\Request;

class BrandsController extends Controller
{
    protected $theme;
    protected $settings;

    public function __construct()
    {
        $this->theme = Theme::getTheme();
        $this->settings = Setting::get();
    }

    public function index(){
        return 'in progress';
    }

    public function show($slug){
        $brand = Brand::whereSlug($slug)->with(['slider' => function($query){
            $query->select('brand_id', 'file_path as slider');
        }])->first();
        $products = Product::simpleSearch(false, $brand);
        $breadcrumb = $brand->getBreadcrumb();
        return view('themes.' . $this->theme . '.pages.brand', compact('brand', 'breadcrumb', 'products'));
    }
}
