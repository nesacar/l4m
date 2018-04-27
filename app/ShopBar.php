<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class ShopBar extends Model
{
    protected $fillable = ['category_id', 'title', 'desc', 'template', 'order', 'order', 'publish'];

    public function sync(){
        $this->product()->sync([]);

        $index = 0;
        if(count(request('prod_ids'))){
            foreach (request('prod_ids') as $id){
                $this->product()->attach($id, ['order' => ++$index]);
            }
        }
    }

    public static function getLatest(){
        return self::with('category')->where('template', 'home')->where('desc', 'Latest')->orderBy('order', 'ASC')->with(['product' => function($query){
            $query->orderBy('pivot_order', 'ASC');
        }])->get();
    }

    public static function getFeatured(){
        return self::with('category')->where('template', 'home')->where('desc', 'Featured')->orderBy('order', 'ASC')->with(['product' => function($query){
            $query->orderBy('pivot_order', 'ASC');
        }])->get();
    }

    public function setPublishAttribute($value){
        $this->attributes['publish'] = $value ?: false;
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function product(){
        return $this->belongsToMany(Product::class)->withPivot('order');
    }
}
