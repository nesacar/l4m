<?php

namespace App\Http\Controllers\Api;

use App\Blog;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateBlogRequest;
use Illuminate\Http\Request;
use File;

class BlogsController extends Controller
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
        $blogs = Blog::with('parentBlog')->orderBy('created_at', 'DESC')->paginate(50);

        return response()->json([
            'blogs' => $blogs
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateBlogRequest $request)
    {
        $blog = Blog::create(request()->except('image'));
        $blog->slug = request('slug')?: request('title');
        $blog->publish = request('publish')?: false;
        $blog->update();

        return response()->json([
            'blog' => $blog
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {
        $blogs = Blog::where('publish', 1)->where('parent', 0)->orderBy('created_at', 'DESC')->get();

        return response()->json([
            'blog' => $blog,
            'blogs' => $blogs,
            'parent' => Blog::select('id', 'title')->find($blog->parent),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(CreateBlogRequest $request, Blog $blog)
    {
        $blog->update(request()->all());
        $blog->slug = request('slug')?: request('title');
        $blog->publish = request('publish')?: false;
        $blog->update();

        return response()->json([
            'blog' => $blog
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
        if($blog->image) File::delete($blog->image);
        $blog->delete();

        return response()->json([
            'message' => 'deleted'
        ]);
    }

    /**
     * Upload blog image
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function uploadImage($id){
        $blog = Blog::find($id);
        $blog->update(['image' => $blog->storeImage('file')]);

        return response()->json([
            'image' => $blog->image
        ]);
    }

    /**
     * List of blogs
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function lists(){
        $parent = request('parent')?: false;
        $blogs = Blog::where('publish', 1)
            ->where(function ($query) use ($parent){
                if($parent){
                    $query->where('parent', 0);
                }
            })->orderBy('created_at', 'DESC')->get();

        return response()->json([
            'blogs' => $blogs,
            'lists' => $blogs->pluck('title', 'id'),
        ]);
    }
}
