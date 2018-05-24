<?php

namespace App\Http\Controllers;

use App\Setting;
use App\Theme;
use Illuminate\Http\Request;

class ClientsController extends Controller
{
    protected $theme;
    protected $settings;

    public function __construct()
    {
        $this->theme = Theme::getTheme();
        $this->settings = Setting::get();
    }
}
