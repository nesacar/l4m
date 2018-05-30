<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

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

    public static function getLatest($template="home"){
        return Cache::remember('najnoviji', Helper::getMinutesToTheNextHour(), function () use ($template) {
            return self::where('template', $template)->where('desc', 'Najnoviji')->orderBy('order', 'ASC')->with(['category' => function($query){
                $query->withoutGlobalScopes();
            }])->with(['product' => function($query){
                $query->withoutGlobalScope('attribute')->orderBy('pivot_order', 'ASC');
            }])->get();
        });
    }

    public static function getFeatured($template="home"){
        return Cache::remember('istaknuti', Helper::getMinutesToTheNextHour(), function () use ($template) {
            return self::where('template', $template)->where('desc', 'Istaknuti')->orderBy('order', 'ASC')->with(['category' => function($query){
                $query->withoutGlobalScopes();
            }])->with(['product' => function($query){
                $query->withoutGlobalScope('attribute')->orderBy('pivot_order', 'ASC');
            }])->get();
        });
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
