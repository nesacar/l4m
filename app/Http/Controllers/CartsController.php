<?php

namespace App\Http\Controllers;

use App\Product;
use App\ShoppingCartOld;
use App\Theme;
use Illuminate\Http\Request;
use Session;

class CartsController extends Controller
{
    protected $theme;
    protected $settings;

    public function __construct()
    {
        $this->theme = Theme::getTheme();
        //$this->middleware('auth');
    }

    /**
     * Return current cart
     */
    public function index(){
        return view('themes.' . $this->theme . '.pages.cart');
    }

    public function store(){
        $res = \Cart::store();
        return redirect('/')->with('message', 'Korpa je sačuvana');
    }
}
