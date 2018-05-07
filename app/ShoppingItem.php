<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShoppingItem extends Model
{
    protected $fillable = ['code', 'title', 'qty', 'price', 'options'];

    public function cart(){
        return $this->belongsToMany(Cart::class);
    }
}
