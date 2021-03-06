<?php

namespace App;

use App\Traits\UploudableImageTrait;
use Illuminate\Database\Eloquent\Model;
use File;

class Collection extends Model
{
    use UploudableImageTrait;

    protected $fillable = ['brand_id', 'title', 'slug', 'short', 'body', 'order', 'image', 'publish'];

    public function setSlugAttribute($value){
        $this->attributes['slug'] = $value? str_slug($value) : str_slug($this->attributes['title']);
    }

    public function brand(){
        return $this->belongsTo(Brand::class);
    }

    public function product(){
        return $this->hasMany(Product::class);
    }
}
