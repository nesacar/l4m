<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Block extends Model
{
    protected $fillable = ['category_id', 'title', 'desc', 'publish'];

    public static function getSlider(){
        return Cache::remember(session('category_id').'.sliders', Helper::getMinutesToTheNextHour(), function () {
            return self::where('category_id', session('category_id'))->first()->box()->where('boxes.publish', 1)->orderBy('boxes.order', 'ASC')->get();
        });
    }

    public function box(){
        return $this->hasMany(Box::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }
}
