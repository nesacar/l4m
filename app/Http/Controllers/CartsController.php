<?php

namespace App\Http\Controllers;

use App\Helper;
use App\Product;
use Illuminate\Http\Request;
use Session;

class CartsController extends Controller
{
    public function index(){
        return \Cart::identifier('nesacar')->content();
    }

    public function store(Product $product){
        \Cart::add('test', $product->title, 1, $product->price);
    }
}
