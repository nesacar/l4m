<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use File;

class Blog extends Model
{
    protected $table = 'blogs';

    protected $fillable = ['id', 'title', 'slug', 'short', 'order', 'parent', 'level', 'image', 'publish'];

    public static function base64UploadImage($blog_id, $image){
        $blog = self::find($blog_id);
        if($blog->image != null){
            File::delete($blog->image);
        }
        $exploaded = explode(',', $image);
        $data = base64_decode($exploaded[1]);
        $filename = $blog->slug . '-' . str_random(2) . '-' . $blog->id . '.' . self::getExtension($image);
        $path = public_path('storage/uploads/blogs/');
        file_put_contents($path . $filename, $data);
        $blog->image = 'storage/uploads/blogs/' . $filename;
        $blog->update();
        return $blog->image;
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

    public function getLink(){
        return url('blog/' . $this->slug . '/');
    }

    public function setSlugAttribute($value){
        $this->attributes['slug'] = str_slug($value);
    }

    public function parentBlog() {
        return $this->hasOne(Blog::class, 'id', 'parent');
    }

    public function children() {
        return $this->hasMany(Blog::class, 'parent', 'id');
    }

    public function post(){
        return $this->hasMany(Post::class);
    }
}
