<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\UploadImageRequest;
use App\Product;
use Illuminate\Http\Request;
use File;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with(['Category', 'Brand', 'Collection'])->orderBy('.products.id', 'DESC')->paginate(50);

        return response()->json([
            'products' => $products
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateProductRequest $request)
    {
        $product = Product::create(request()->except('image'));
        $product->slug = request('slug')?: request('title');
        $product->publish = request('publish')?: false;
        $product->update();

        if(request('image')){ Product::base64UploadImage($product, request('image')); }

        $product->category()->sync(request('category_id'));

        return response()->json([
            'product' => $product
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $catIds = $product->category()->pluck('categories.id');

        return response()->json([
            'product' => $product,
            'catIds' => $catIds,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(CreateProductRequest $request, Product $product)
    {
        $product->update(request()->except('image'));
        $product->slug = request('slug')?: request('title');
        $product->publish = request('publish')?: false;
        $product->update();

        $product->category()->sync(request('category_id'));

        $catIds = $product->category()->pluck('categories.id');

        return response()->json([
            'product' => $product,
            'catIds' => $catIds,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        if($product->image) File::delete($product->image);
        $product->delete();

        return response()->json([
            'message' => 'deleted'
        ]);
    }

    /**
     * Upload image
     *
     * @param UploadImageRequest $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function uploadImage(UploadImageRequest $request, $id){
        $image = Product::base64UploadImage($id, request('file'));

        return response()->json([
            'image' => $image
        ]);
    }

    /**
     * Posts search
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function search(){
        $category = request('list');
        $text = request('text');

        $products = Product::with('Category', function($query) use ($text,$category){
            $query->where('categories.parent', 0);
                if($text != ''){
                    $query->where('categories.title', 'like', '%'.$text.'%')->orWhere('products.slug', 'like', '%'.$text.'%');
                }
                if($category > 0){
                    $query->where('categories.id', $category);
                }
            })
            ->with('Brand', function($query) use ($text){
                if($text != ''){
                    $query->where('brands.title', 'like', '%'.$text.'%');
                }
            })->with('Collection')
            ->where(function ($query) use ($text){
                if($text != ''){
                    $query->where('products.title', 'like', '%'.$text.'%')->orWhere('products.slug', 'like', '%'.$text.'%')
                        ->orWhere('products.id', 'like', '%'.$text.'%')->orWhere('products.code', 'like', '%'.$text.'%');
                }
            })->orderBy('products.id', 'DESC')->paginate(50);

        return response()->json([
            'products' => $products
        ]);
    }
}
