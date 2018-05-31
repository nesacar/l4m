<?php

namespace App\Http\Controllers;

use App\MenuLink;
use App\Theme;
use Illuminate\Http\Request;

class CustomersController extends Controller
{
    protected $theme;
    protected $settings;

    public function __construct()
    {
        $this->theme = Theme::getTheme();
        $this->middleware('auth', ['except' => ['login', 'register']]);
    }

    public function register(){
        $menu = MenuLink::getMenu();
        return view('themes.' . $this->theme . '.pages.auth.registration', compact('menu'));
    }

    public function login(){
        $menu = MenuLink::getMenu();
        return view('themes.' . $this->theme . '.pages.auth.login', compact('menu'));
    }
}
