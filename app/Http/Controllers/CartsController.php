<?php

namespace App\Http\Controllers;

use App\Product;
use App\ShoppingCart;
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
    }

    /**
     * @return \Illuminate\Contracts\Routing\ResponseFactory|string|\Symfony\Component\HttpFoundation\Response
     */
    public function index(){
        //Session::forget('cart');
        $data = ShoppingCart::getAll();
        return view('themes.' . $this->theme . '.pages.cart', compact('data'));
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

    /**
     * @param $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|string|\Symfony\Component\HttpFoundation\Response
     */
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

    public function countItems(){
        $oldCart = Session::has('cart')? Session::get('cart') : null;
        $cart = new ShoppingCart($oldCart);
        return count($cart->items);
    }

    public function totalPrice(){
        $oldCart = Session::has('cart')? Session::get('cart') : null;
        $cart = new ShoppingCart($oldCart);
        return $cart->totalPrice;
    }
}
