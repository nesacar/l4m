<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Session;
use Illuminate\Database\Eloquent\Builder;

class Order extends Model
{
    protected $fillable = ['shopping_cart_id', 'product_id', 'price', 'total', 'qty', 'size', 'color', 'options'];

    public function shoppingCart(){
        return $this->belongsTo(ShoppingCart::class);
    }

    public function product(){
        return $this->belongsToMany(Product::class)->withPivot('qty');
    }
}
