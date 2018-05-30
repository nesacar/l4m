<?php

namespace App\Http\Controllers;

use App\Brand;
use App\MenuLink;
use App\Product;
use App\Seo;
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
        $brands = Brand::where('logo', '<>', null)->where('publish', 1)->orderBy('order', 'ASC')->get();
        $menu = MenuLink::getMenu();
        return view('themes.' . $this->theme . '.pages.brand.brands', compact('brands', 'menu'));
    }

    public function show($slug){
        $brand = Brand::whereSlug($slug)->with(['slider' => function($query){
            $query->select('brand_id', 'file_path as slider');
        }])->first();
        $products = Product::simpleSearch(false, $brand);
        $breadcrumb = $brand->getBreadcrumb();
        Seo::shopBrand($this->settings, $brand);
        $menu = MenuLink::getMenu();
        return view('themes.' . $this->theme . '.pages.brand.brand', compact('brand', 'breadcrumb', 'products', 'menu'));
    }
}
