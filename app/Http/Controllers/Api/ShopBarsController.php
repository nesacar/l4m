<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateShopBarRequest;
use App\ShopBar;
use Illuminate\Http\Request;
use DB;

class ShopBarsController extends Controller
{
    public function __construct(){
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shopBars = ShopBar::with('category')->orderBy('id', 'DESC')->paginate(50);

        return response()->json([
            'shopBars' => $shopBars
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateShopBarRequest $request)
    {
        $shopBar = ShopBar::create(request()->all());

        $shopBar->sync();

        return response()->json([
            'shopBar' => $shopBar
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ShopBar  $shopBar
     * @return \Illuminate\Http\Response
     */
    public function show(ShopBar $shopBar)
    {
        $prodIds = DB::table('product_shop_bar')->where('product_shop_bar.shop_bar_id', $shopBar->id)->orderBy('order', 'ASC')->pluck('product_shop_bar.product_id');

        return response()->json([
            'shopBar' => $shopBar,
            'prod_ids' => $prodIds,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ShopBar  $shopBar
     * @return \Illuminate\Http\Response
     */
    public function update(CreateShopBarRequest $request, ShopBar $shopBar)
    {
        $shopBar->update(request()->all());

        $shopBar->sync();

        $prodIds = DB::table('product_shop_bar')->where('product_shop_bar.shop_bar_id', $shopBar->id)->orderBy('order', 'ASC')->pluck('product_shop_bar.product_id');

        return response()->json([
            'shopBar' => $shopBar,
            'prod_ids' => $prodIds,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ShopBar  $shopBar
     * @return \Illuminate\Http\Response
     */
    public function destroy(ShopBar $shopBar)
    {
        $shopBar->delete();

        return response()->json([
            'message' => 'Deleted'
        ]);
    }
}
