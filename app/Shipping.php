<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    protected $fillable = ['title', 'desc', 'order', 'publish'];

    public function shoppingCart(){
        return $this->hasMany(ShoppingCart::class);
    }
}
