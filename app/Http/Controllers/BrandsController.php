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

    public function show($slug){
        $brand = Brand::whereId(29)->with('image', 'product')->first();
        return view('themes.' . $this->theme . '.pages.brand', compact('brand'));
    }
}
