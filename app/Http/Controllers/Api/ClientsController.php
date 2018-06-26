<?php

namespace App\Http\Controllers\Api;

use App\Brand;
use App\Category;
use App\Client;
use App\Http\Requests\CreateClientRequest;
use App\Http\Requests\UploadImageRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClientsController extends Controller
{


    /**
     * CollectionsController constructor.
     */
    public function __construct(){
        $this->middleware('auth:api');
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(){
        $clients = Client::with('user')->paginate(50);

        return response()->json([
            'clients' => $clients,
        ]);
    }

    /**
     * @param CreateClientRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateClientRequest $request){
        $client = Client::create(request()->except('image', 'cover'));
        $client->update(['image' => $client->storeImage(), 'cover' => $client->storeImage('cover', 'cover')]);

        $client->brand()->sync(request('brand_ids'));

        return response()->json([
            'client' => $client,
        ]);
    }

    /**
     * @param Client $client
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Client $client){
        $brands = Brand::select('id', 'title', 'short')->where('publish', 1)->orderBy('created_at', 'DESC')->get();

        return response()->json([
            'client' => $client->load('brand'),
            'brand_ids' => $client->brand()->select('id', 'title')->get(),
            'brands' => $brands,
        ]);
    }

    /**
     * @param CreateClientRequest $request
     * @param Client $client
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(CreateClientRequest $request, Client $client){
        $client->update(request()->except('image', 'cover'));
        $client->update(['image' => $client->storeImage(), 'cover' => $client->storeImage('cover', 'cover')]);

        $client->brand()->sync(request('brand_ids'));

        return response()->json([
            'client' => $client,
            'brand_ids' => $client->brand()->pluck('id')->toArray(),
        ]);
    }

    /**
     * @param Client $client
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Client $client){
        $client->delete();

        return response()->json([
            'message' => 'deleted',
        ]);
    }

    /**
     * @param UploadImageRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function uploadImage(UploadImageRequest $request, $id){
        $client = Client::find($id);
        if(request('cover')){
            $client->update(['cover' => $client->storeImage('cover', 'cover')]);

            return response()->json([
                'image' => $client->cover,
            ]);
        }else{
            $client->update(['image' => $client->storeImage('image')]);

            return response()->json([
                'image' => $client->image,
            ]);
        }
    }

    public function lists(){
        return response()->json([
            'clients' => Client::where('publish', 1)->with('user')->get(),
            'lists' => Client::where('publish', 1)->get(['title', 'id']),
        ]);
    }

    public function categories($id){
        $client = Client::find($id);

        return response()->json([
            'category_ids' => $client->category()->pluck('id'),
        ]);
    }

    public function categoriesUpdate($id){
        $client = Client::find($id);
        $client->category()->sync(request('client_id'));

        return response()->json([
            'category_ids' => request('client_id'),
        ]);
    }

    /**
     * Client search
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function search(){
        $text = request('text');
        $clients = Client::where(function ($query) use ($text){
                if($text != ''){
                    $query->where('name', 'like', '%'.$text.'%')->orWhere('slug', 'like', '%'.$text.'%');
                }
            })
            ->orderBy('created_at', 'DESC')->paginate(50);

        return response()->json([
            'clients' => $clients,
        ]);
    }
}
