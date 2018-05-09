<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

class Attribute extends Model
{
    protected $fillable = ['property_id', 'title', 'slug', 'order', 'extra', 'publish'];

    public function setSlugAttribute($value){
        $this->attributes['slug'] = str_slug($this->attributes['title']);
    }

    public function setPublishAttribute($value){
        $this->attributes['publish'] = $value?: false;
    }

//    public function getPublishAttribute($value){
//        return $value? 'Da' : 'Ne';
//    }

    public function property(){
        return $this->belongsTo(Property::class);
    }

    public function product(){
        return $this->belongsToMany(Product::class);
    }


    public function link(){
        return $this->belongsToMany(MenuLink::class);
    }
}
