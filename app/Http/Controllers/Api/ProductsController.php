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
use App\Http\Requests\EditProductTableRequest;
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
use Illuminate\Support\Facades\Validator;

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
        // Check if there is filters in request
        isset($request->brand_id) ? $brand = $request->brand_id : $brand = false;
        isset($request->category_id) ? $category = $request->category_id : $category = false;
        isset($request->text) ? $search = $request->text : $search = false;

        $products = Product::with(['attribute.property']);

        if ($brand) {
            $products = $products->where('brand_id', $brand);
        }
        if ($category) {
            $products = $products->whereHas('category', function ($query) use ($category) {
                $query->where('id', $category);
            });
        }
        if ($search) {
            $products = $products->where('title', 'like', '%'.$search.'%')
                ->orWhere('code','like', '%'.$search.'%')
                ->orWhere('id','like', '%'.$search.'%');
        }

        $products = $products->orderBy('created_at', 'DESC')->paginate(10, ['*'], false, $request->page);
        // Convert products column names to work with frontend
        $products = Product::mappableFields($products);

        return response()->json($products);
    }

    /**
     * Create product table
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function tableCreate(Request $request)
    {
        // Validate input
        foreach ($request->get('fields') as $key => $product) {
            $validate = new Request([
                'sifra_artikla' => $product['sifra_artikla']['value'],
                'naziv' => $product['naziv']['value'],
                'dan_objave' => $product['dan_objave']['value'],
                'vreme_objave' => $product['vreme_objave']['value'],
                'kolicina' => $product['kolicina']['value'],
                'cena' => $product['cena']['value'],
                'opis' => $product['opis']['value'],
            ]);

            $this->validate($validate, [
                'sifra_artikla' => 'required|max:255',
                'naziv' => 'required|max:255',
                'dan_objave' => 'required|max:255',
                'vreme_objave' => 'required|max:255',
                'kolicina' => 'required|numeric',
                'cena' => 'required|numeric',
                'opis' => 'required',
            ]);
        }

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
                        $old->client_id = isset($client->id) ? $client->id : 1;
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
                        $new->client_id = isset($client->id) ? $client->id : 1;
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

    public function tableUpdate(EditProductTableRequest $request, $id)
    {
        if (is_numeric($id)) {

            $product = Product::find($id);

            if ($product) {
                // Get user which created product
                $user = User::find($product->user_id);
                // Get client
                $client = $user->client->first();

                // Fill product fields
                $product->user_id = $user->id;
                $product->client_id = isset($client->id) ? $client->id : 1;
                $product->brand_id = $request['brands']['value'];
                $product->collection_id = $request['collections']['value'];
                $product->title = $request['naziv']['value'];
                $product->short = $request['kratak_opis']['value'];
                $product->body = $request['opis']['value'];
                $product->body2 = $request['opis2']['value'];
                $product->code = $request['sifra_artikla']['value'];
                $product->price = $request['cena']['value'];
                $product->amount = $request['kolicina']['value'];
                $product->discount = $request['popust']['value'];
                $product->publish = $request['publikovanje']['value'];
                $product->publish_at = $request['dan_objave']['value'].' '.$request['vreme_objave']['value'];

                // Update product
                try {
                    $product->update();
                    // Update categories and attributes for product
                    $product->category()->sync($request['categories']['value']);
                    $product->attribute()->sync(Product::filterAttributes($request->all()));
                }
                catch (\Exception $e) {
                    // Catch error exception
                    return response()->json([
                        'error' => $e->getMessage(),
                    ], 500);
                }

                return response()->json([
                    'success' => 'radi'
                ], 200);
            }

        }
        return response()->json([
            'error' => 'Doslo je do greske prilikom update-a!',
        ], 500);
    }
}
