<?php

namespace App\Http\Controllers;

use App\Product;
use App\ShoppingCart;
use Illuminate\Http\Request;
use Session;

class CartsController extends Controller
{

    /**
     * @return \Illuminate\Contracts\Routing\ResponseFactory|string|\Symfony\Component\HttpFoundation\Response
     */
    public function index(){
        //Session::forget('cart');

        if(Session::has('cart')){
            $oldCart = Session::has('cart')? Session::get('cart') : null;
            $cart = new ShoppingCart($oldCart);

            return response([
                'products' => $cart->items,
                'totalQty' => $cart->totalQty,
                'totalPrice' => $cart->totalPrice,
            ], 200);
        }
        return 'cart is empty';
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function store($id){
        $product = Product::withoutGlobalScope('attribute')->find($id);
        $oldCart = Session::has('cart')? Session::get('cart') : null;
        $cart = new ShoppingCart($oldCart);
        $cart->add($product, $product->id);

        Session::put('cart', $cart);

        return response([
            'message' => 'added'
        ], 200);
    }

    public function reduceByOne($id){
        $oldCart = Session::has('cart')? Session::get('cart') : null;
        $cart = new ShoppingCart($oldCart);
        $cart->reduceByOne($id);

        if(count($cart->items) > 0){
            Session::put('cart', $cart);
        }else{
            Session::forget('cart');
        }

        if(Session::has('cart')){
            return response([
                'products' => $cart->items,
                'totalQty' => $cart->totalQty,
                'totalPrice' => $cart->totalPrice,
            ], 200);
        }else{
            return 'cart is empty';
        }
    }

    public function removeItem($id){
        $oldCart = Session::has('cart')? Session::get('cart') : null;
        $cart = new ShoppingCart($oldCart);
        $cart->removeItem($id);

        if(count($cart->items) > 0){
            Session::put('cart', $cart);
        }else{
            Session::forget('cart');
        }

        if(Session::has('cart')){
            return response([
                'products' => $cart->items,
                'totalQty' => $cart->totalQty,
                'totalPrice' => $cart->totalPrice,
            ], 200);
        }else{
            return 'cart is empty';
        }
    }
}
