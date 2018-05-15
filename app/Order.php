<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Session;
use Illuminate\Database\Eloquent\Builder;

class Order extends Model
{
    protected $fillable = ['customer_id', 'payment_id', 'coupon_id', 'price', 'tax', 'total', 'paid', 'paid_at'];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('product', function (Builder $builder) {
            $builder->with('product');
        });

        static::addGlobalScope('customer', function (Builder $builder) {
            $builder->with(['customer' => function($query){
                $query->with('user');
            }]);
        });
    }

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

    public static function fake(){
        $product1 = Product::first();
        $product2 = Product::skip(1)->first();
        $order = self::create([
            'payment_id' => Payment::first()->id,
            'customer_id' => Customer::first()->id,
            'price' => (int) $product1->totalPrice * 2 + (int) $product2->totalPrice,
            'tax' => 0,
            'total' => (int) $product1->totalPrice * 2 + (int) $product2->totalPrice,
        ]);

        $order->product()->sync([]);

        $order->product()->attach([
            $product1->id => ['qty' => 2],
            $product2->id => ['qty' => 1]
        ]);

    }

    public function customer(){
        return $this->belongsTo(Customer::class);
    }

    public function payment(){
        return $this->belongsTo(Payment::class);
    }

    public function product(){
        return $this->belongsToMany(Product::class)->withPivot('qty');
    }
}
