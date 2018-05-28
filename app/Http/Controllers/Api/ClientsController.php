<?php

namespace App\Http\Controllers\Api;

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
        return response()->json([
            'client' => $client->load('brand'),
            'brand_ids' => $client->brand()->pluck('id')->toArray(),
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
        $clients = Client::with('user')->get();

        return response()->json([
            'clients' => $clients,
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
}
