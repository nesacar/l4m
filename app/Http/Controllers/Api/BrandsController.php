<?php

namespace App\Http\Controllers\Api;

use App\Brand;
use App\BrandImage;
use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateBrandRequest;
use App\Http\Requests\UploadImageRequest;
use Illuminate\Http\Request;
use File;

class BrandsController extends Controller
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
        $brands = Brand::select('id', 'title', 'publish', 'created_at')->orderBy('created_at', 'DESC')->paginate(50);

        return response()->json([
            'brands' => $brands
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateBrandRequest $request)
    {
        $brand = Brand::create(request()->except('image', 'logo'));

        $brand->category()->sync(request('category_ids'));

        return response()->json([
            'brand' => $brand
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        $categories = Category::where('publish', 1)->where('parent', 0)->orderBy('created_at', 'DESC')->get();
        $images = $brand->slider()->get();

        return response()->json([
            'brand' => $brand,
            'category_ids' => $brand->category()->pluck('id'),
            'categories' => $categories,
            'images' => $images,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(CreateBrandRequest $request, Brand $brand)
    {
        $brand->update(request()->except('image', 'logo'));

        $brand->category()->sync(request('category_ids'));

        return response()->json([
            'brand' => $brand->load('links'),
            'category_ids' => $brand->category()->pluck('id'),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        if($brand->image) File::delete($brand->image);
        $brand->delete();

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
        $brand = Brand::find($id);
        $brand->update(['image' => $brand->storeImage('file')]);

        return response()->json([
            'image' => $brand->image,
        ]);
    }

    /**
     * Upload brand image
     *
     * @param UploadImageRequest $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function uploadLogoImage(UploadImageRequest $request, $id){
        $brand = Brand::find($id);
        $brand->update(['logo' => $brand->storeImage('file', 'logo')]);

        return response()->json([
            'image' => $brand->logo,
        ]);
    }

    /**
     * List of posts
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function lists(){
        $brands = Brand::select('id', 'title')->where('publish', 1)->orderBy('created_at', 'DESC')->get(['title', 'id']);

        return response()->json([
            'brands' => $brands,
        ]);
    }

    public function gallery($id){
        $images = Brand::find($id)->slider()->get();

        return response()->json([
            'images' => $images,
        ]);
    }

    public function uploadGallery($id){
        Brand::find($id)->storeGallery();
        return 'done';
    }

    public function removeGalleryImage($brand_image){
        $photo = BrandImage::find($brand_image);
        File::delete($photo->file_path);

        $photo->delete();

        return response()->json([
            'message' => 'done'
        ]);
    }

    /**
     * Brand search
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function search(){
        $text = request('text');
        $brands = Brand::where(function ($query) use ($text){
                if($text != ''){
                    $query->where('title', 'like', '%'.$text.'%')->orWhere('slug', 'like', '%'.$text.'%');
                }
            })
            ->orderBy('created_at', 'DESC')->paginate(50);

        return response()->json([
            'brands' => $brands,
        ]);
    }
}
