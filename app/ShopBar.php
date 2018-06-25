<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Cache;

class ShopBar extends Model
{
    protected $fillable = ['parent_category_id', 'category_id', 'title', 'desc', 'template', 'order', 'order', 'latest', 'publish'];

    public function sync(){
        $this->product()->sync([]);

        $index = 0;
        if(count(request('prod_ids'))){
            foreach (request('prod_ids') as $id){
                $this->product()->attach($id, ['order' => ++$index]);
            }
        }
    }

    public static function getLatest($parent, $template="home"){
        $parent = $parent?: 5;
        return Cache::remember($parent.'.najnoviji', Helper::getMinutesToTheNextHour(), function () use ($template, $parent) {
            return self::where('template', $template)->where('desc', 'Najnoviji')->where('parent_category_id', $parent)
                ->orderBy('order', 'ASC')->with(['category' => function($query){
                    $query->withoutGlobalScopes();
                }])->with(['product' => function($query){
                    $query->withoutGlobalScope('attribute')->orderBy('pivot_order', 'ASC');
                }])->get();
        });
    }

    public static function getFeatured($parent, $template="home"){
        $parent = $parent?: 5;
        return Cache::remember($parent.'.istaknuti', Helper::getMinutesToTheNextHour(), function () use ($template, $parent) {
            return self::where('template', $template)->where('desc', 'Istaknuti')->where('parent_category_id', $parent)
                ->orderBy('order', 'ASC')->with(['category' => function($query){
                $query->withoutGlobalScopes();
            }])->with(['product' => function($query){
                $query->withoutGlobalScope('attribute')->orderBy('pivot_order', 'ASC');
            }])->get();
        });
    }

    public function setPublishAttribute($value){
        $this->attributes['publish'] = $value ?: false;
    }

    public function setLatestAttribute($value){
        $this->attributes['latest'] = $value ?: false;
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function parent_category(){
        return $this->belongsTo(Category::class, 'parent_category_id');
    }

    public function product(){
        return $this->belongsToMany(Product::class)->withPivot('order');
    }
}
