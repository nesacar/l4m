<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['title', 'slug', 'publish'];

    public static function filter($array = []){
        if(count($array)>0){
            $res = [];
            $tagsIds = self::pluck('id')->toArray();
            foreach ($array as $item){
                if(in_array($item, $tagsIds)){
                    $res[] = $item;
                }
            }
            return $res;
        }
    }

    public function setSlugAttribute($value){
        $this->attributes['slug'] = str_slug($value);
    }

    public function post(){
        return $this->belongsToMany(Post::class);
    }

    public function product(){
        return $this->belongsToMany(Product::class);
    }
}
