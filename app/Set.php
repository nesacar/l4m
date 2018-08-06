<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Set extends Model
{
    protected $fillable = ['title', 'slug', 'short', 'publish'];

    public static function getProperties($sets){
        return Property::select('properties.*')->join('property_set', 'properties.id', '=', 'property_set.property_id')
            ->whereIn('property_set.set_id', $sets->pluck('id'))->where('properties.publish', 1)->orderBy('properties.order', 'ASC')->get();
    }

    public function setSlugAttribute($value){
        $this->attributes['slug'] = str_slug($value);
    }

    public function filter($array = [])
    {
        if(count($array)>0){
            return array_column($array, 'id');
        }
    }

//    public function getPublishAttribute($value){
//        return $value? 'Da' : 'Ne';
//    }

    public function property(){
        return $this->belongsToMany(Property::class);
    }

    public function product(){
        return $this->hasMany(Product::class);
    }

    public function category(){
        return $this->belongsToMany(Category::class);
    }
}
