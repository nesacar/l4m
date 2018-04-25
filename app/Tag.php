<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['title', 'slug', 'publish'];

    public function setSlugAttribute($value){
        $this->attributes['slug'] = str_slug($value);
    }

    public function post(){
        return $this->belongsToMany(Post::class);
    }

    public function product(){
        return $this->belongsToMany(Product::class);
    }
}
