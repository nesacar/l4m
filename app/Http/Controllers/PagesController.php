<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\Product;
use App\Property;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function proba(){
//        return $products = Product::with(['Category' => function ($query){
//            $query->get();
//        }, 'Brand', 'Collection'])->orderBy('.products.id', 'DESC')->paginate(50);
        return Property::with(['Set' => function($query){
            $query->where('sets.id', 1);
        }])->with(['Attribute' => function($query){
            $query->where('attributes.publish', 1)->orderBy('attributes.order', 'ASC');
        }])->where('properties.publish', 1)->orderBy('properties.order', 'ASC')->get();
    }
}
