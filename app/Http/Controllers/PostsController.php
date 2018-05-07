<?php

namespace App\Http\Controllers;

use App\Gallery;
use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\UploadImageRequest;
use App\Post;
use Illuminate\Http\Request;
use Carbon\Carbon;
use File;

class PostsController extends Controller
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
        $posts = Post::select('posts.*')->with(['blog', 'product'])->orderBy('posts.publish_at', 'DESC')->paginate(50);

        return response()->json([
            'posts' => $posts
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePostRequest $request)
    {
        $post = Post::create(request()->except('image', 'slider'));

        if(request('tag_ids')) $post->tag()->sync(request('tag_ids'));
        if(request('product_ids')) $post->product()->sync(request('product_ids'));

        if(request('image')){ Post::base64UploadImage($post->id, request('image')); }
        if(request('slider')){ Post::base64UploadSliderImage($post->id, request('slider')); }

        return response()->json([
            'post' => $post
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $postIds = $post->tag()->pluck('tags.id');
        $productIds = $post->product()->pluck('products.id');

        return response()->json([
            'post' => $post,
            'tag_ids' => $postIds,
            'product_ids' => $productIds,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(CreatePostRequest $request, Post $post)
    {
        $post->update(request()->except('image', 'slider'));

        $post->tag()->sync(request('tag_ids'));
        $post->product()->sync(request('product_ids'));

        $postIds = $post->tag()->pluck('tags.id');
        $productIds = $post->product()->pluck('products.id');

        return response()->json([
            'post' => $post,
            'tag_ids' => $postIds,
            'product_ids' => $productIds,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if($post->image) File::delete($post->image);
        if($post->slider) File::delete($post->slider);
        $post->delete();

        return response()->json([
            'message' => 'deleted'
        ]);
    }

    public function uploadImage(UploadImageRequest $request, $id){
        if(request('slider')){
            $image = Post::base64UploadSliderImage($id, request('file'));
        }else{
            $image = Post::base64UploadImage($id, request('file'));
        }

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
        $posts = Post::select('id', 'title', 'short', 'image')->where('publish', 1)->orderBy('created_at', 'DESC')->get();

        return response()->json([
            'posts' => $posts,
        ]);
    }

    /**
     * Posts search
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function search(){
        $blog = request('list');
        $text = request('text');
        $posts = Post::select('posts.*')->with('blog')->where(function ($query) use ($blog){
                if($blog > 0){
                    $query->where('posts.blog_id', $blog);
                }
            })
            ->where(function ($query) use ($text){
                if($text != ''){
                    $query->where('posts.title', 'like', '%'.$text.'%')->orWhere('posts.slug', 'like', '%'.$text.'%');
                }
            })
            ->orderBy('posts.publish_at', 'DESC')->groupBy('posts.id')->paginate(50);

        return response()->json([
            'posts' => $posts,
        ]);
    }

    /**
     * Get gallery images
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function gallery($id){
        $photos = Post::find($id)->gallery;

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
        Gallery::saveImage($id, request('file'));
        return 'done';
    }

    public function products($id){
        $post = Post::find($id);
        $post->product()->sync(request('product_ids'));

        return response()->json([
            'post' => $post,
            'product_ids' => $post->product()->pluck('products.id'),
        ], 200);
    }
}
