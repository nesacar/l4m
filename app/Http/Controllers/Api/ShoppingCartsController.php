<?php

namespace App\Http\Controllers\Api;

use App\Order;
use App\ShoppingCart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShoppingCartsController extends Controller
{
    /**
     * OrdersController constructor.
     */
    public function __construct(){
        $this->middleware('auth:api');
    }

    public function index()
    {
        $shoppingCarts = ShoppingCart::orderBy('id', 'DESC')->paginate(50);

        return response()->json([
            'shoppingCarts' => $shoppingCarts,
        ]);
    }

    public function show($id){
        $shoppingCart = ShoppingCart::find($id);
        return response()->json([
            'shoppingCart' => $shoppingCart,
        ]);
    }

}
