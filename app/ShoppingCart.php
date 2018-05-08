<?php

namespace App;

use Session;

class ShoppingCart{

    public $items = null;
    public $totalQty = 0;
    public $totalPrice = 0;

    /**
     * Cart constructor.
     * @param $oldCart
     */
    public function __construct($oldCart){
        if($oldCart){
            $this->items = $oldCart->items;
            $this->totalQty = $oldCart->totalQty;
            $this->totalPrice = $oldCart->totalPrice;
        }
    }

    /**
     * @param $item
     * @param $id
     */
    public function add($item, $id){
        $storedItem = ['qty' => 0, 'price' => $item->price, 'item' => $item];
        if($this->items){
            if(array_key_exists($id, $this->items)){
                $storedItem = $this->items[$id];
            }
        }
        $storedItem['qty']++;
        $storedItem['price'] = $item->price * $storedItem['qty'];
        $this->items[$id] = $storedItem;

        $this->totalQty++;
        $this->totalPrice += $item->price;
    }

    /**
     * @param $item
     * @param $id
     */
    public function reduceByOne($id){
        $this->items[$id]['qty']--;
        $this->items[$id]['price'] -= $this->items[$id]['item']['price'];
        $this->totalQty--;
        $this->totalPrice -= $this->items[$id]['item']['price'];

        if($this->items[$id]['qty'] <= 0){
            unset($this->items[$id]);
        }
    }

    /**
     * @param $id
     */
    public function removeItem($id){
        $this->totalQty -= $this->items[$id]['qty'];
        $this->totalPrice -= $this->items[$id]['price'];
        unset($this->items[$id]);
    }

    public static function getIds(){
        $oldCart = Session::has('cart')? Session::get('cart') : null;
        $cart = new ShoppingCart($oldCart);
        $res = collect([]);
        if(count($cart->items) > 0){
            foreach ($cart->items as $key => $product){
                $res->prepend(['id' => $key]);
            }
        }
        return $res;
    }
}
