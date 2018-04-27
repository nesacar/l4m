<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    protected $fillable = ['set_id', 'title', 'slug', 'order', 'extra', 'publish'];

    protected $with = ['attribute'];

    public function setSlugAttribute($value){
        $this->attributes['slug'] = str_slug($this->attributes['title']);
    }

    public function setPublishAttribute($value){
        $this->attributes['publish'] = $value?: false;
    }

//    public function getPublishAttribute($value){
//        return $value? 'Da' : 'Ne';
//    }

    public function set(){
        return $this->belongsToMany(Set::class);
    }

    public function attribute(){
        return $this->hasMany(Attribute::class);
    }
}
