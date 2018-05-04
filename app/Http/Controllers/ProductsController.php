<?php

namespace App\Http\Controllers;

use App\Attribute;
use App\Http\Requests\ChangeProductCodeRequest;
use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\UploadImageRequest;
use App\Photo;
use App\Product;
use App\Set;
use Carbon\Carbon;
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
        $products = Product::withoutGlobalScope('attribute')->with(['category' => function($query){
            $query->orderBy('parent', 'DESC')->first();
        }])->orderBy('id', 'DESC')->paginate(50);

        $products->map(function($product){ $product->edit = false; return $product; } );

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
        $array = request()->all();
        $array['image'] = null;
        $product = Product::create($array);

        if(request('image')) Product::base64UploadImage($product->id, request('image'));

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
        $catIds = $product->category->pluck('id');
        $attIds = $product->attribute->pluck('id');
        $tagIds = $product->tag->pluck('id');
        $properties = Set::find($product->set_id)->property()->with('attribute')->where('properties.publish', 1)->orderBy('properties.order', 'ASC')->get();

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
        $product->update(request()->all());
        $product->category()->sync(request('cat_ids'));
        $product->attribute()->sync(request('att_ids'));
        $product->tag()->sync(request('tag_ids'));

        $properties = Set::find($product->set_id)->property()->with('Attribute')->where('properties.publish', 1)->orderBy('properties.order', 'ASC')->get();
        $catIds = $product->category->pluck('id');
        $attIds = $product->attribute->pluck('id');
        $tagIds = $product->tag->pluck('id');

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

        $products = Product::withoutGlobalScope('attribute')->select('products.*')->join('category_product', 'products.id', '=', 'category_product.product_id')->join('categories', 'category_product.category_id', '=', 'categories.id')
            ->where(function($query) use ($category){
                if($category > 0){
                    $query->where('categories.id', $category);
                }
            })
            ->where(function ($query) use ($text){
                if(!empty($text)){
                    $query->where('products.title', 'like', '%'.$text.'%')->orWhere('products.slug', 'like', '%'.$text.'%')
                        ->orWhere('products.id', 'like', '%'.$text.'%')->orWhere('products.code', 'like', '%'.$text.'%');
                }
            })->groupBy('products.id')->orderBy('products.id', 'DESC')->paginate(50);

        $products->map(function($product){ $product->edit = false; return $product; } );

        return response()->json([
            'products' => $products
        ]);
    }

    /**
     * Get gallery images
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function gallery($id){
        $photos = Product::find($id)->photo;

        return response()->json([
            'photos' => $photos
        ]);
    }

    /**
     * Update gallery image
     *
     * @param $id
     * @return string
     */
    public function galleryUpdate($id){
        Photo::saveImage($id, request('file'));
        return 'done';
    }

    /**
     * Product list
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function lists(){
        $products = Product::withoutGlobalScopes()->select('products.id', 'products.code', 'products.publish_at', 'products.image')
            ->where('products.publish', 1)->orderBy('products.title', 'ASC')->get();

        return response()->json([
            'products' => $products
        ]);
    }

    /**
     * Clone product
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function cloneProduct($id){
        $product = Product::find($id);
        $product->load('photo', 'tag');
        $product->code = "clone-".$product->id;
        $product->image = null;
        $product->views = 0;
        $product->sold = 0;
        $product->publish_at = Carbon::now();
        $newProduct = $product->replicate();
        $newProduct->push();

        $newProduct->edit = false;

        $newProduct->category()->sync($product->category()->pluck('categories.id'));
        $newProduct->attribute()->sync($product->attribute()->pluck('attributes.id'));
        $newProduct->tag()->sync($product->tag()->pluck('tags.id'));

        return response()->json([
            'product' => $newProduct
        ]);
    }

    /**
     * @param ChangeProductCodeRequest $request
     * @param $id
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function code(ChangeProductCodeRequest $request, $id){
        $product = Product::find($id);
        $product->update(['code' => request('code')]);

        return response()->json([
            'product' => $product
        ]);
    }
}
