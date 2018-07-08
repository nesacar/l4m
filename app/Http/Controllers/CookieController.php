<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class CookieController extends Controller
{
    public function index(){
        return unserialize(Cookie::get('products'));
    }

    public function add($id){
        $array = Cookie::get('products')? unserialize(Cookie::get('products')): [];
        $array[] = $id;
        $array = array_unique($array, $id);
        Cookie::queue('products', serialize($array), 60 * 24 * 180); //6 meseci

        return response([
            'message' => 'done'
        ], 200);
    }

    public function remove($id){
        $array = Cookie::get('products')? unserialize(Cookie::get('products')): [];
        if (in_array($id, $array)) {
            unset($array[array_search($id,$array)]);
        }
        Cookie::queue('products', serialize($array), 60 * 24 * 180); //6 meseci

        return response([
            'message' => 'done'
        ], 200);
    }
}
