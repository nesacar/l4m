<?php

namespace App;

use App\Traits\UploudableImageTrait;
use Illuminate\Database\Eloquent\Model;
use File;

class Blog extends Model
{
    use UploudableImageTrait;

    protected $fillable = ['id', 'title', 'slug', 'short', 'order', 'parent', 'level', 'image', 'publish'];

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
