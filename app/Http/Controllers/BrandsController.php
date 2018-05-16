<?php

namespace App\Http\Controllers;

use App\Brand;
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
        $brand = Brand::whereSlug($slug)->with('product')->with(['slider' => function($query){
            $query->select('brand_id', 'file_path as slider');
        }])->first();
        $breadcrumb = $brand->getBreadcrumb();
        return view('themes.' . $this->theme . '.pages.brand', compact('brand', 'breadcrumb'));
    }
}
