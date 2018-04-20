<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Set extends Model
{
    protected $fillable = ['title', 'slug', 'short', 'publish'];

    public function setSlugAttribute($value){
        $this->attributes['slug'] = str_slug($value);
    }

    public function getPublishAttribute($value){
        return $value? 'Da' : 'Ne';
    }

    public function property(){
        return $this->belongsToMany(Property::class);
    }

    public function product(){
        return $this->hasMany(Product::class);
    }
}
