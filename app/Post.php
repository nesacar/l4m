<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use File;
Use Carbon\Carbon;

class Post extends Model
{
    protected $fillable = ['user_id', 'blog_id', 'title', 'slug', 'short', 'body', 'views', 'image', 'publish_at', 'slider', 'publish'];

    protected $appends = ['date', 'time', 'link'];

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
        $filename = str_slug($post->title) . '-' . str_random(2) . '-' . $post->id . '.' . self::getExtension($image);
        $path = Helper::generateImageFolder('storage/uploads/posts/');
        file_put_contents($path['folderPath'] . '/' . $filename, $data);
        $post->update(['image' => 'storage/uploads/posts/' . $path['folder'] . '/' . $filename]);
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
        return self::where('slider', 1)->published()->take($limit)->get();
    }

    public static function getLatest($category = false, $limit = 7){
        if($category){
            return $category->post()->published()->paginate($limit);
        }else{
            return self::published()->paginate($limit);
        }
    }

    public static function getMostView($limit = 4){
        return self::published()->orderBy('views', 'DESC')->take($limit)->get();
    }

    public static function getHomePosts($limit = 3){
        return self::published()->limit($limit)->get();
    }

    public function scopePublished($query){
        $query->where('posts.publish_at', '<=', Carbon::now()->format('Y-m-d H:00'))->where('posts.publish', 1)->orderBy('posts.publish_at', 'DESC');
    }

    public function getLink(){
        if($this->blog){
            return url('blog/' . $this->blog->slug . '/' . $this->slug . '/' . $this->id);
        }else{
            return '#';
        }
    }

    public function setSlugAttribute($value){
        $this->attributes['slug'] = $value? str_slug($value) : str_slug($this->attributes['title']);
    }

    public function setPublishAttribute($value){
        $this->attributes['publish'] = $value?: false;
    }

    public function setPublishAtAttribute($value){
        $this->attributes['publish_at'] = Carbon::parse($value)->format('Y-m-d H:00:00');
    }

    public function getDateAttribute(){
        return Carbon::parse($this->attributes['publish_at'])->format('Y-m-d');
    }

    public function getTimeAttribute(){
        return Carbon::parse($this->attributes['publish_at'])->format('H:00:00');
    }

    public function getLinkAttribute(){
        return $this->getLink();
    }

    public function blog(){
        return $this->belongsTo(Blog::class);
    }

    public function tag(){
        return $this->belongsToMany(Tag::class);
    }

    public function gallery(){
        return $this->hasMany(Gallery::class);
    }
}
