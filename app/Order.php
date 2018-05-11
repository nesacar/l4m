<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Session;

class Order extends Model
{
    public function getOrder(){
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
}
