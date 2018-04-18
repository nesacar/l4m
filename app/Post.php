<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use File;
Use Carbon\Carbon;

class Post extends Model
{
    protected $table = 'posts';

    protected $fillable = ['id', 'user_id', 'blog_id', 'title', 'slug', 'short', 'body', 'image', 'datum', 'publish_at', 'publish'];

    protected $dates = ['publish_at'];

    public static function base64UploadImage($post_id, $image){
        $post = self::find($post_id);
        if($post->image != null){
            File::delete($post->image);
        }
        $exploaded = explode(',', $image);
        $data = base64_decode($exploaded[1]);
        $filename = time() . '-' . $post->id . '.jpg';
        $path = public_path('storage/uploads/posts/');
        file_put_contents($path . $filename, $data);
        $post->image = 'storage/uploads/posts/' . $filename;
        $post->update();
        return $post->image;
    }

    public static function getLatest($limit=3, $product_id = false){
        return self::select('posts.id', 'posts.title', 'posts.slug', 'posts.short', 'posts.image', 'posts.publish_at', 'products.slug as product_slug', 'products.id as product_id', \DB::raw('count(testimonials.id) as count'))
            ->join('products', 'posts.product_id', '=', 'products.id')->join('testimonials', 'products.id', '=', 'testimonials.product_id')
            ->where(function ($query) use ($product_id){
                if($product_id){
                    $query->where('posts.product_id', $product_id);
                }
            })
            ->published()->groupBy('posts.id')->take($limit)->get();
    }

    public static function getLatestPaginate($limit=8, $product_id = false){
        return self::select('posts.id', 'posts.title', 'posts.slug', 'posts.short', 'posts.image', 'posts.publish_at', 'products.slug as product_slug', 'products.id as product_id', \DB::raw('count(testimonials.id) as count'))
            ->join('products', 'posts.product_id', '=', 'products.id')->join('testimonials', 'products.id', '=', 'testimonials.product_id')
            ->where(function ($query) use ($product_id){
                if($product_id){
                    $query->where('posts.product_id', $product_id);
                }
            })
            ->published()->groupBy('posts.id')->paginate($limit);
    }

    public static function getNext($post){
        //return Cache::remember('settings', 60*24, function () use ($post) {
        return self::where('product_id', $post->product_id)->where('publish_at', '<', $post->publish_at)->orderBy('publish_at', 'DESC')->first();
        //});
    }

    public static function getPrev($post){
        //return Cache::remember('settings', 60*24, function () use ($post) {
        return self::where('product_id', $post->product_id)->where('publish_at', '<', $post->publish_at)->orderBy('publish_at', 'ASC')->first();
        //});
    }

    public static function getPost($post_id){
        return self::select('posts.id', 'posts.title', 'posts.slug', 'posts.body', 'posts.image', 'posts.publish_at', 'products.slug as product_slug', 'products.id as product_id')
            ->join('products', 'posts.product_id', '=', 'products.id')->where('posts.id', $post_id)->first();
    }

    public function scopePublished($query){
        $query->where('posts.publish_at', '<=', (new \Carbon\Carbon()))->where('posts.publish', 1)->orderBy('posts.publish_at', 'DESC');
    }

    public function blog(){
        return $this->belongsTo(Blog::class);
    }
}
