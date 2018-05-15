<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Session;

class Order extends Model
{
    protected $fillable = ['customer_id', 'payment_id', 'coupon_id', 'price', 'tax', 'total', 'paid_at'];

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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer(){
        return $this->belongsTo(Customer::class);
    }
}
