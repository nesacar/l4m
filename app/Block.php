<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    protected $fillable = ['category_id', 'title', 'desc', 'publish'];

    public function box(){
        return $this->hasMany(Box::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }
}
