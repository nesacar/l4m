<?php

namespace App\Http\Controllers;

use App\Attribute;
use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\UploadImageRequest;
use App\Photo;
use App\Product;
use App\Set;
use Illuminate\Http\Request;
use File;

class ProductsController extends Controller
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
        $products = Product::with(['Category', 'Brand', 'Collection'])->orderBy('products.id', 'DESC')->paginate(50);

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

        if(request('image')) Product::base64UploadImage($product, request('image'));

        $product->category()->sync(request('cat_ids'));
        $product->attribute()->sync(request('att_ids'));
        $product->tag()->sync(request('tag_ids'));

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
        $attIds = $product->attribute()->pluck('attributes.id');
        $tagIds = $product->tag()->pluck('tags.id');
        $properties = Set::find($product->set_id)->property()->with('Attribute')->where('properties.publish', 1)->orderBy('properties.order', 'ASC')->get();

        return response()->json([
            'product' => $product,
            'cat_ids' => $catIds,
            'att_ids' => $attIds,
            'tag_ids' => $tagIds,
            'properties' => $properties,
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

        $product->category()->sync(request('cat_ids'));
        $product->attribute()->sync(request('att_ids'));
        $product->tag()->sync(request('tag_ids'));

        $properties = Set::find($product->set_id)->property()->with('Attribute')->where('properties.publish', 1)->orderBy('properties.order', 'ASC')->get();
        $catIds = $product->category()->pluck('categories.id');
        $attIds = $product->attribute()->pluck('attributes.id');
        $tagIds = $product->tag()->pluck('tags.id');

        return response()->json([
            'product' => $product,
            'cat_ids' => $catIds,
            'att_ids' => $attIds,
            'tag_ids' => $tagIds,
            'properties' => $properties,
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
    public function search(Request $request){
        $category = request('list');
        $text = request('text');

        $products = Product::with(['Category' => function($query) use ($category){
                if($category > 0){
                    $query->where('categories.id', $category);
                }
            }])
            ->with(['Brand' => function($query) use ($text){
                if(!empty($text)){
                    $query->where('brands.title', 'like', '%'.$text.'%');
                }
            }])->with('Collection')
            ->where(function ($query) use ($text){
                if(!empty($text)){
                    $query->where('products.title', 'like', '%'.$text.'%')->orWhere('products.slug', 'like', '%'.$text.'%')
                        ->orWhere('products.id', 'like', '%'.$text.'%')->orWhere('products.code', 'like', '%'.$text.'%');
                }
            })->orderBy('products.id', 'DESC')->paginate(50);

        return response()->json([
            'products' => $products
        ]);
    }

    public function gallery($id){
        $photos = Product::find($id)->photo;

        return response()->json([
            'photos' => $photos
        ]);
    }

    public function galleryUpdate($id){
        Photo::saveImage($id, request('file'));
        return 'done';
    }
}
