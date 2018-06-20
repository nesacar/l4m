<?php

namespace App\Http\Controllers\Api;

use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\UploadImageRequest;
use Illuminate\Http\Request;
use File;

class CategoriesController extends Controller
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
        $categories = Category::with('parentCategory')->orderBy('order', 'ASC')->paginate(50);

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

        //if(request('image')){ Category::base64UploadImage($category->id, request('image')); }

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
            'category' => $category,
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

        return response()->json([
            'category' => $category,
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
        if($category->image) File::delete($category->image);
        if($category->box_image) File::delete($category->box_image);
        $category->delete();

        return response()->json([
            'message' => 'deleted'
        ]);
    }

    public function uploadImage(UploadImageRequest $request, $id){
        $category = Category::find($id);
        $category->update(['image' => $category->storeImage('file')]);

        return response()->json([
            'image' => $category->image,
        ]);
    }

    public function uploadBoxImage(UploadImageRequest $request, $id){
        $category = Category::find($id);
        $category->update(['box_image' => $category->storeImage('file', 'box_image')]);

        return response()->json([
            'image' => $category->box_image,
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
     * List of top categories
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function topLists(){
        $categories = Category::where('publish', 1)->where('parent', 0)->orderBy('created_at', 'DESC')->get();

        return response()->json([
            'categories' => $categories,
            'lists' => $categories->pluck('title', 'id'),
        ]);
    }

    public function childrenLists(){
        $categories = Category::where('publish', 1)->where('parent', request('category'))->orderBy('created_at', 'DESC')->get();

        return response()->json([
            'categories' => $categories,
            'lists' => $categories->pluck('title', 'id'),
        ]);
    }

    /**
     * Three of categories
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function tree(){
        $categories = Category::tree(1);

        return response()->json([
            'categories' => $categories,
        ]);
    }

    /**
    * Category search
    *
    * @return \Illuminate\Http\JsonResponse
    */
    public function search(){
        $text = request('text');
        $parent = request('list')?: false;
        $categories = Category::with(['parentCategory' => function($query){
                $query->with('parentCategory');
            }])
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

    public function sort(){
        $categories = Category::tree();

        return response()->json([
            'categories' => $categories,
        ]);
    }

    public function saveOrder(){
        Category::orderCategories(request('categories'), 0);

        $categories = Category::tree();

        return response()->json([
            'categories' => $categories,
        ]);
    }
}
