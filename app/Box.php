<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Box extends Model
{
    protected $fillable = ['block_id', 'title', 'subtitle', 'button', 'link', 'image', 'order', 'publish'];

    public function setSlugAttribute($value){
        $this->attributes['slug'] = str_slug($value);
    }

    public function block(){
        return $this->belongsTo(Block::class);
    }
}
