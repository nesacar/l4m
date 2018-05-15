<?php

namespace App\Http\Controllers\Api;

use App\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrdersController extends Controller
{
    /**
     * OrdersController constructor.
     */
    public function __construct(){
        $this->middleware('auth:api');
    }

    public function index()
    {
        $orders = Order::with('customer')->withCount('product')->orderBy('orders.id', 'DESC')->paginate(50);

        return response()->json([
            'orders' => $orders
        ]);
    }

    public function show(Order $order){
        return response()->json([
            'order' => $order,
        ]);
    }

}
