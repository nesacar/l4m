<?php

namespace App\Http\Controllers\Api;

use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateShopBarRequest;
use App\Product;
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

        return response()->json([
            'shopBar' => $shopBar,
            'prod_ids' => $prodIds = Product::getCleanProductForShopBar($shopBar),
            'parent_category' => Category::select('id', 'title')->find($shopBar->parent_category_id),
            'category' => Category::select('id', 'title')->find($shopBar->category_id),
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

        $prodIds = Product::getCleanProductForShopBar($shopBar);

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
