<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    protected $fillable = ['set_id', 'title', 'slug', 'order', 'extra', 'publish'];

    public function setSlugAttribute($value){
        $this->attributes['slug'] = str_slug($value);
    }

    public function set(){
        return $this->belongsToMany(Set::class);
    }

    public function attribute(){
        return $this->hasMany(Attribute::class);
    }
}
