<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Session;
use Illuminate\Database\Eloquent\Builder;

class Order extends Model
{
    protected $fillable = ['shopping_cart_id', 'product_id', 'price', 'total', 'qty', 'size', 'color', 'options'];

    protected static function boot(){
        parent::boot();

        static::addGlobalScope('product', function (Builder $builder) {
            $builder->with('product');
        });
    }

    public static function cartUpdate(){
        if(count(request('rowIds'))>0){
            for($i=0;$i<count(request('rowIds'));$i++){
                \Cart::update(request('rowIds')[$i], ['qty' => request('qty')[$i]]);
            }
        }
    }

    public function shoppingCart(){
        return $this->belongsTo(ShoppingCart::class);
    }

    public function product(){
        return $this->belongsTo(Product::class);
    }
}
