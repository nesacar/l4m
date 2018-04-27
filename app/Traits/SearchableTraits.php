<?php

namespace App\Traits;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

trait SearchableTraits
{

    protected static function search($category=false){
        $products = self::query()->withoutGlobalScope('attribute');
        foreach(request()->all() as $key => $attribute){
            if(in_array($key, self::$searchable)){
                $products->$key($attribute);
            }
        }
        if($category){ $products->categoryFilter($category->id); }

        return $products->select(self::$selectable)->published()->paginate(self::$paginate);
    }

    public function scopeFilters(Builder $query, $ids){
        return $query->join('attribute_product', 'products.id', '=', 'attribute_product.product_id')
            ->whereIn('attribute_product.attribute_id', $ids);
    }

    public function scopeCategoryFilter(Builder $query, $category_id){
        return $query->join('category_product', 'products.id', '=', 'category_product.product_id')
            ->where('category_product.category_id', $category_id);
    }

    public function scopeSort(Builder $query, $sort){
        $query->getQuery()->orders = null;
        if($sort == 1){
            $query->orderBy('publish_at', 'DESC');
        }elseif($sort == 2){
            $query->orderBy('price', 'ASC');
        }elseif($sort == 3){
            $query->orderBy('price', 'DESC');
        }
        return $query;
    }

    public function scopePublished($query){
        return $query->where('publish', 1)->where('publish_at', '<=', Carbon::now()->format('Y-m-d H:00'));
    }

    public function scopePrice(Builder $query, $price){
        if(count($price) == 2) return $query->whereBetween('price', [$price[0], $price[1]]);
    }
}