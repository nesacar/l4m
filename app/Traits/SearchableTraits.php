<?php

namespace App\Traits;

use App\Attribute;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use DB;

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

        if(in_array('filters', self::$searchable)){
            $filteredIds = $products->select('id')->published()->pluck('id');
            $att_ids = Attribute::select('attributes.id')->join('attribute_product', 'attributes.id', '=', 'attribute_product.attribute_id')
                ->whereIn('attribute_product.product_id', $filteredIds)->groupBy('attributes.id')->pluck('attributes.id')->toArray();

            return array(
                'att_ids' => $att_ids,
                'products' => $products->select(array_merge(self::$selectable, [DB::raw('count(*) as broj')]))->published()->groupBy('products.id')->paginate(self::$paginate),
            );
        }
        return $products->select(self::$selectable)->published()->groupBy('products.id')->paginate(self::$paginate);
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