<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BrandLink extends Model
{
    protected $fillable = ['brand_id', 'title', 'link', 'order', 'publish'];

    public function brand(){
        return $this->belongsTo(Brand::class);
    }
}
