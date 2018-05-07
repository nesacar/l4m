<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model{

    protected $fillable = ['instance', 'customer_id', 'payment_id', 'total', 'paid'];

    protected $items;

    public function __construct(array $items = [])
    {
        $this->items = $items;
    }

    /**
     * Adding item to the cart
     *
     * @param $item
     */
    public static function add($item){
        self::$items[] = $item;
    }

    /**
     * Removing item from the cart
     * @param $code
     */
    public static function remove($code){
        self::$items->filter(function($item) use ($code){
            return $item->code != $code;
        });
    }

    public function content(){
        return $this->items;
    }

    /**
     * Related connection to the item
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function item(){
        return $this->hasMany(ShoppingItem::class);
    }
}
