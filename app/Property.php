<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Property extends Model
{
    protected $fillable = ['title', 'slug', 'order', 'extra', 'publish'];

    //protected $with = ['attribute'];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('attribute', function (Builder $builder) {
            $builder->with(['attribute' => function($query){
                $query->where('publish', 1)->orderBy('title', 'ASC');
            }]);
        });
    }

    public static function getPropertyByCategories($ids=false){
        if($ids){
            return self::with('attribute')
                ->join('category_property', 'properties.id', '=', 'category_property.property_id')
                ->whereIn('category_property.category_id', $ids)->groupBy('properties.id')
                ->orderBy('properties.title', 'ASC')->get();
        }else{
            return [];
        }
    }

    public function setSlugAttribute($value){
        $this->attributes['slug'] = str_slug($this->attributes['title']);
    }

    public function setPublishAttribute($value){
        $this->attributes['publish'] = $value?: false;
    }

    public function set(){
        return $this->belongsToMany(Set::class);
    }

    public function attribute(){
        return $this->hasMany(Attribute::class)->orderBy('order', 'ASC');
    }

    public function category(){
        return $this->belongsToMany(Category::class);
    }
}
