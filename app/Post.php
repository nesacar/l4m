<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use File;
Use Carbon\Carbon;

class Post extends Model
{
    protected $fillable = ['user_id', 'blog_id', 'title', 'slug', 'short', 'body', 'views', 'image', 'publish_at', 'slider', 'publish'];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('blog', function (Builder $builder) {
            $builder->with(['blog' => function($query){
                $query->where('publish', 1)->orderBy('parent', 'ASC');
            }]);
        });
    }

    public static function base64UploadImage($post_id, $image){
        $post = self::find($post_id);
        if($post->image != null){
            File::delete($post->image);
        }
        $exploaded = explode(',', $image);
        $data = base64_decode($exploaded[1]);
        $filename = $post->slug . '-' . str_random(2) . '-' . $post->id . '.' . self::getExtension($image);
        $path = public_path('storage/uploads/posts/');
        file_put_contents($path . $filename, $data);
        $post->image = 'storage/uploads/posts/' . $filename;
        $post->update();
        return $post->image;
    }

    public static function getExtension($image)
    {
        $exploaded = explode(',', $image);
        return self::getBetween($exploaded[0], '/', ';');

    }

    public static function getBetween($content,$start,$end){
        $r = explode($start, $content);
        if (isset($r[1])){
            $r = explode($end, $r[1]);
            return $r[0];
        }
        return '';
    }

    public static function getSlider($limit = 3){
        return Post::where('slider', 1)->published()->take($limit)->get();
    }

    public static function getLatest($limit = 8){
        return Post::published()->take($limit)->get();
    }

    public static function getMostView($limit = 4){
        return Post::published()->orderBy('views', 'DESC')->take($limit)->get();
    }

    public function scopePublished($query){
        $query->where('posts.publish_at', '<=', Carbon::now()->format('Y-m-d H:00'))->where('posts.publish', 1)->orderBy('posts.publish_at', 'DESC');
    }

    public function getLink(){
        return url($this->blog->slug . '/' . $this->slug . '/' . $this->id);

    }

    public function setSlugAttribute($value){
        $this->attributes['slug'] = str_slug($value);
    }

    public function blog(){
        return $this->belongsTo(Blog::class);
    }

    public function tag(){
        return $this->belongsToMany(Tag::class);
    }
}
