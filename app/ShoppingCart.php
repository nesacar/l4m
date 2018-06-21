<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class ShoppingCart extends Model
{
    protected static $price = 0;
    protected static $total = 0;

    protected $fillable = ['customer_id', 'payment_id', 'coupon_id', 'shipping_id', 'address_id', 'price', 'tax', 'total', 'paid', 'paid_at'];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot(){
        parent::boot();

        static::addGlobalScope('customer', function (Builder $builder) {
            $builder->with(['customer' => function($query){
                $query->withoutGlobalScope('address');
            }]);
        });

        static::addGlobalScope('payment', function (Builder $builder) {
            $builder->with('payment');
        });

        static::addGlobalScope('order', function (Builder $builder) {
            $builder->with('order');
        });

        static::deleting(function($cart){
            $cart->order->each->delete();
        });
    }

    public static function store(){
        if(!empty(\Cart::content())){
            $shoppingCart = ShoppingCart::create([
                'customer_id' => auth()->user()->customer->id,
                'payment_id' => session('payment'),
                'address_id' => session('address'),
                'shipping_id' => session('shipping'),
            ]);
            foreach (\Cart::content() as $product){

                Order::create([
                    'shopping_cart_id' => $shoppingCart->id,
                    'product_id' => $product->id,
                    'price' => $product->price,
                    'total' => $product->total,
                    'qty' => $product->qty,
                    'size' => $product->options->has('size')? $product->options->size : null,
                    'color' => $product->options->has('color')? $product->options->color : null,
                ]);

                self::$price += $product->price;
                self::$total += $product->total;
            }
            $shoppingCart->update(['price' => self::$price, 'total' => self::$total]);
            \Cart::destroy();
            session()->forget(['address', 'shipping', 'payment']);
            return true;
        }
        return false;
    }

    public static function getIds(){
        $res = [];
        if(!empty(\Cart::content())){
            foreach (\Cart::content() as $product){
                $res[] = $product->id;
            }
        }
        return $res;
    }

    public function order(){
        return $this->hasMany(Order::class);
    }

    public function customer(){
        return $this->belongsTo(Customer::class);
    }

    public function payment(){
        return $this->belongsTo(Payment::class);
    }

    public function address(){
        return $this->belongsTo(Address::class);
    }

    public function shipping(){
        return $this->belongsTo(Shipping::class);
    }
}
