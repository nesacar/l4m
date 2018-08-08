<?php

namespace App\Http\Controllers\Api;

use App\Attribute;
use App\Brand;
use App\Category;
use App\Client;
use App\Collection;
use App\Http\Controllers\Controller;
use App\Http\Requests\ChangeProductCodeRequest;
use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\UploadImageRequest;
use App\Photo;
use App\Product;
use App\Property;
use App\Set;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use File;
use DB;

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
        if(auth()->user()->isAdmin()){
            $products = Product::withoutGlobalScope('attribute')->with(['category' => function($query){
                $query->orderBy('parent', 'DESC')->first();
            }])->orderBy('id', 'DESC')->paginate(50);
        }else{
            $clientIds = auth()->user()->client()->pluck('id');
            $products = Product::whereIn('client_id', $clientIds)->withoutGlobalScope('attribute')->with(['category' => function($query){
                $query->orderBy('parent', 'DESC')->first();
            }])->orderBy('id', 'DESC')->paginate(50);
        }

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
        $product = Product::create(request()->except('image', 'client_id'));
        if(empty(request('client_id'))) $product->update(['client_id' => Client::getClientId()]);

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
        if(!auth()->user()->isAdmin() && !in_array($product->client_id, auth()->user()->client()->pluck('id')->toArray())){
            return response([
                'error' => 'unauthorized'
            ], 401);
        }
        $catIds = $product->category->pluck('id');
        $attIds = $product->attribute->pluck('id');
        $tags = DB::table('tags')->select('tags.id', 'tags.title')->join('product_tag', 'tags.id', '=', 'product_tag.tag_id')
            ->where('product_tag.product_id', $product->id)->get();
        $properties = Property::getPropertyByCategories($catIds);

        return response()->json([
            'product' => $product,
            'cat_ids' => $catIds,
            'att_ids' => $attIds,
            'tags' => $tags,
            'clients' => Client::select('id', 'title')->find($product->client_id),
            'brands' => Brand::select('id', 'title')->find($product->brand_id),
            'collection_ids' => Collection::select('id', 'title')->find($product->collection_id),
            'properties' => $properties,
            'collections' => Collection::select('id', 'title')->where('brand_id', $product->brand_id)->where('publish', 1)->orderBy('created_at', 'DESC')->get(),
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
        $product->update(request()->except('image', 'client_id'));
        if(empty(request('client_id'))) $product->update(['client_id' => Client::getClientId()]);

        $product->category()->sync(request('cat_ids'));
        $product->attribute()->sync(request('att_ids'));
        $product->tag()->sync(request('tag_ids'));

        $catIds = $product->category->pluck('id');
        $attIds = $product->attribute->pluck('id');
        $tagIds = $product->tag->pluck('id');
        $properties = Property::getPropertyByCategories($catIds);

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
        if(!auth()->user()->isAdmin() && !in_array($product->client_id, auth()->user()->client()->pluck('id')->toArray())){
            return response([
                'error' => 'unauthorized'
            ], 401);
        }

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
        $product = Product::find($id);
        $product->update(['image' => $product->storeImage('file')]);

        return response()->json([
            'image' => $product->image
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
        Product::find($id)->storeGallery();
        return 'done';
    }

    /**
     * Product list
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function lists(){
        if(request('category')>0){
            $products = Category::find(request('category'))->product()->withoutGlobalScope('attribute')->withoutGlobalScope('brand')->select('products.id', 'products.code', 'products.publish_at', 'products.image')
                ->where('products.publish', 1)->orderBy('products.publish_at', 'DESC')->get();
        }else{
            $products = Product::withoutGlobalScope('attribute')->withoutGlobalScope('brand')->select('products.id', 'products.code', 'products.publish_at', 'products.image')
                ->where('products.publish', 1)->orderBy('products.publish_at', 'DESC')->get();
        }

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

    /**
     * Return filtered list of products,
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function tableList(Request $request)
    {
        return Product::with('attribute.property')->orderBy('created_at', 'DESC')->paginate(10);
    }

    /**
     * Get column properties for given set
     *
     * @param null $set_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function table($set_id = null)
    {
        $setProperties = Set::with('property')->find($set_id);
        return response()->json([
            'setProperties' => $setProperties->property
        ]);
    }

    public function tableCreate(Request $request)
    {
        $oldCount = 0;
        $newCount = 0;
        // If there is any product rows in request
        if (count($request->fields)) {

            // Get user
            $user = User::find($request->user_id);
            // Get client
            $client = $user->client->first();
            foreach ($request->fields as $product) {

                if ($product['sifra_artikla']['value']) {
                    // Get product if exist
                    $old = Product::where('code', $product['sifra_artikla']['value'])->first();
                    if (!empty($old)) {
                        // Update existed product
                        //$oldProduct->update($request->all());
                        $old->user_id = $user->id;
                        $old->client_id = $client->id;
                        $old->brand_id = $product['brands']['value'];
                        $old->collection_id = $product['collections']['value'];
                        $old->title = $product['naziv']['value'];
                        $old->short = $product['kratak_opis']['value'];
                        $old->body = $product['opis']['value'];
                        $old->body2 = $product['opis2']['value'];
                        $old->code = $product['sifra_artikla']['value'];
                        $old->price = $product['cena']['value'];
                        $old->amount = $product['kolicina']['value'];
                        $old->discount = $product['popust']['value'];
                        $old->publish = $product['publikovanje']['value'];
                        $old->publish_at = $product['dan_objave']['value'].' '.$product['vreme_objave']['value'];

                        // Update product
                        $old->update();
                        // Update categories and attributes for product
                        $old->category()->sync($product['categories']['value']);
                        $old->attribute()->sync(Product::filterAttributes($product));

                        $oldCount++;
                    }
                    else {
                        // If there isnt' product with that code, create new
                        $new = new Product();
                        $new->user_id = $user->id;
                        $new->client_id = $client->id;
                        $new->brand_id = $product['brands']['value'];
                        $new->collection_id = $product['collections']['value'];
                        $new->title = $product['naziv']['value'];
                        $new->short = $product['kratak_opis']['value'];
                        $new->body = $product['opis']['value'];
                        $new->body2 = $product['opis2']['value'];
                        $new->code = $product['sifra_artikla']['value'];
                        $new->price = $product['cena']['value'];
                        $new->amount = $product['kolicina']['value'];
                        $new->discount = $product['popust']['value'] ? $product['popust']['value'] : 0;
                        $new->publish = $product['publikovanje']['value'];

                        // Create new product
                        $new->save();
                        // Link categories and attributes for product
                        $new->category()->sync($product['categories']['value']);
                        $new->attribute()->sync(Product::filterAttributes($product));

                        $newCount++;
                    }

                }

            }

            return response()->json([
                'new' => $newCount,
                'old' => $oldCount,
            ]);

        }
    }
}
