<?php

namespace App\Http\Controllers\Api;

use App\Collection;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCollectionRequest;
use App\Http\Requests\UploadImageRequest;
use Illuminate\Http\Request;
use File;

class CollectionsController extends Controller
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
    public function index()
    {
        $collections = Collection::select('collections.id', 'collections.title', 'collections.publish', 'collections.created_at', 'brands.title as brand')
            ->join('brands', 'collections.brand_id', '=', 'brands.id')->orderBy('collections.created_at', 'DESC')->paginate(50);

        return response()->json([
            'collections' => $collections
        ]);
    }


    /**
     * @param CreateCollectionRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateCollectionRequest $request)
    {
        $collection = Collection::create(request()->except('image'));

        return response()->json([
            'collection' => $collection
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Collection  $collection
     * @return \Illuminate\Http\Response
     */
    public function show(Collection $collection)
    {
        return response()->json([
            'collection' => $collection
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Collection  $collection
     * @return \Illuminate\Http\Response
     */
    public function update(CreateCollectionRequest $request, Collection $collection)
    {
        $collection->update(request()->except('image'));

        return response()->json([
            'collection' => $collection
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Collection  $collection
     * @return \Illuminate\Http\Response
     */
    public function destroy(Collection $collection)
    {
        if($collection->image) File::delete($collection->image);
        $collection->delete();

        return response()->json([
            'message' => 'deleted',
        ]);
    }

    /**
     * Upload brand image
     *
     * @param UploadImageRequest $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function uploadImage(UploadImageRequest $request, $id){
        $collection = Collection::find($id);
        $collection->update(['image' => $collection->storeImage('file')]);

        return response()->json([
            'image' => $collection->image,
        ]);
    }

    /**
     * List of posts
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function lists(){
        $brand_id = request('brand_id');
        $collections = Collection::select('id', 'title', 'short')
            ->where(function($query) use ($brand_id){
                if($brand_id){
                    $query->where('brand_id', $brand_id);
                }
            })
            ->where('publish', 1)->orderBy('created_at', 'DESC')->get();

        return response()->json([
            'collections' => $collections,
        ]);
    }
}
