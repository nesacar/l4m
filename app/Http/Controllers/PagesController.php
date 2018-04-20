<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\Product;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function proba(){
//        return $products = Product::with(['Category' => function ($query){
//            $query->get();
//        }, 'Brand', 'Collection'])->orderBy('.products.id', 'DESC')->paginate(50);
        return Product::with(['Category', 'Brand', 'Collection'])->orderBy('.products.id', 'DESC')->paginate(50);
    }
}
