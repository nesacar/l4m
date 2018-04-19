<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    protected $fillable = ['property_id', 'title', 'slug', 'order', 'extra', 'publish'];

    public function setSlugAttribute($value){
        $this->attributes['slug'] = str_slug($value);
    }

    public function getPublishAttribute($value){
        return $value? 'Da' : 'Ne';
    }

    public function property(){
        return $this->belongsTo(Property::class);
    }
}
