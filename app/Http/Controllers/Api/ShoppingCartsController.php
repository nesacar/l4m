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
        $shoppingCarts = ShoppingCart::with('customer')->orderBy('id', 'DESC')->paginate(50);

        return response()->json([
            'shoppingCarts' => $shoppingCarts,
        ]);
    }

    public function show($id){
        $shoppingCart = ShoppingCart::with('shipping')->with('address')->find($id);

        return response()->json([
            'shoppingCart' => $shoppingCart,
        ]);
    }

    public function destroy($id){
        $cart = ShoppingCart::find($id);
        $cart->delete();

        return response()->json([
            'message' => 'done',
        ]);
    }

}
