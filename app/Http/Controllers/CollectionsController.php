<?php

namespace App\Http\Controllers;

use App\Collection;
use App\Http\Requests\CreateCollectionRequest;
use App\Http\Requests\UploadImageRequest;
use Illuminate\Http\Request;
use File;

class CollectionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCollectionRequest $request)
    {
        $collection = Collection::create(request()->except('image'));
        $collection->slug = request('slug')?: request('title');
        $collection->publish = request('publish')?: false;
        $collection->update();

        if(request('image')){ Collection::base64UploadImage($collection->id, request('image')); }

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
        $collection->slug = request('slug')?: request('title');
        $collection->publish = request('publish')?: false;
        $collection->update();

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
            'message' => 'deleted'
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
        $image = Collection::base64UploadImage($id, request('file'));

        return response()->json([
            'image' => $image
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
