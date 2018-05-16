<?php

namespace App;

use App\Traits\UploudableImageTrait;
use Illuminate\Database\Eloquent\Model;
use File;

class Brand extends Model
{
    use UploudableImageTrait;

    protected $fillable = ['title', 'slug', 'short', 'body', 'order', 'logo', 'image', 'publish'];

    public function setSlugAttribute($value){
        $this->attributes['slug'] = str_slug($value);
    }

    public function collection(){
        return $this->hasMany(Collection::class);
    }

    public function product(){
        return $this->hasMany(Product::class);
    }

    public function post(){
        return $this->hasMany(Post::class);
    }

    public function image(){
        return $this->hasMany(BrandImage::class);
    }
}
