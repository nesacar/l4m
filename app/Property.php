<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    protected $fillable = ['title', 'slug', 'order', 'extra', 'publish'];

    public function setSlugAttribute($value){
        $this->attributes['slug'] = str_slug($value);
    }
}
