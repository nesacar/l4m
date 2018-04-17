<?php

namespace App\Http\Controllers;

use App\Blog;
use App\Http\Requests\CreateBlogRequest;
use Illuminate\Http\Request;
use File;

class BlogsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = Blog::select('id', 'title', 'publish', 'created_at')->orderBy('created_at', 'DESC')->paginate(50);

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
        $blog->slug = request('slug')? str_slug(request('slug')) : str_slug(request('title'));
        $blog->publish = request('publish')?: false;
        $blog->update();

        if(request('image')) Blog::base64UploadImage($blog->id, request('image'));

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
        return response()->json([
            'blog' => $blog
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
        $blog->slug = request('slug')? str_slug(request('slug')) : str_slug(request('title'));
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
        $image = Blog::base64UploadImage($id, request('image'));

        return response()->json([
            'image' => $image
        ]);
    }

    /**
     * Blog lists
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function lists(){
        $blogs = Blog::where('publish', 1)->orderBy('title', 'ASC')->pluck('title', 'id')->prepend('Bez kategorije', 0);

        return response()->json([
            'blogs' => $blogs
        ]);
    }
}
