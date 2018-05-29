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

    public static function getAttributeIdsByCategories($ids){
        if($ids){
            return self::join('properties', 'attributes.property_id', '=', 'properties.id')
                ->join('category_property', 'properties.id', '=', 'category_property.property_id')
                ->whereIn('category_property.category_id', $ids)->groupBy('attributes.id')
                ->orderBy('properties.title', 'ASC')->pluck('attributes.id');
        }else{
            return [];
        }
    }

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
