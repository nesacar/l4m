<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\UploadImageRequest;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::select('id', 'title', 'publish', 'order', 'created_at')->with('parentCategory')->orderBy('order', 'ASC')->paginate(50);

        return response()->json([
            'categories' => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCategoryRequest $request)
    {
        $category = Category::create(request()->all());
        $category->slug = request('slug')?: request('title');
        $category->publish = request('publish')?: false;
        $category->update();

        if(request('image')){ Category::base64UploadImage($category->id, request('image')); }

        return response()->json([
            'category' => $category
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return response()->json([
            'category' => $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(CreateCategoryRequest $request, Category $category)
    {
        $category->update(request()->except('image'));
        $category->slug = request('slug')?: request('title');
        $category->publish = request('publish')?: false;
        $category->update();

        return response()->json([
            'category' => $category
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        if($category->image) File::delete();
        $category->delete();

        return response()->json([
            'message' => 'deleted'
        ]);
    }

    public function uploadImage(UploadImageRequest $request, $id){
        $image = Category::base64UploadImage($id, request('file'));

        return response()->json([
            'image' => $image
        ]);
    }

    /**
     * List of categories
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function lists(){
        $parent = request('parent')?: false;
        $categories = Category::where('publish', 1)
            ->where(function ($query) use ($parent){
                if($parent){
                    $query->where('parent', 0);
                }
            })->orderBy('created_at', 'DESC')->pluck('title', 'id')->prepend('Bez nad kategorije', 0);

        return response()->json([
            'categories' => $categories,
        ]);
    }

    /**
    * Posts search
    *
    * @return \Illuminate\Http\JsonResponse
    */
    public function search(){
        $text = request('text');
        $parent = request('list')?: false;
        $categories = Category::select('id', 'title', 'publish', 'created_at')->with('parentCategory')
            ->where(function ($query) use ($text){
                if($text != ''){
                    $query->where('title', 'like', '%'.$text.'%')->orWhere('slug', 'like', '%'.$text.'%');
                }
            })
            ->where(function ($query) use ($parent){
                if($parent){
                    $query->where('parent', $parent);
                }
            })
            ->orderBy('created_at', 'DESC')->paginate(50);

        return response()->json([
            'categories' => $categories,
        ]);
    }
}
