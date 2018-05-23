<?php

namespace App\Traits;

use App\Attribute;
use App\Category;
use App\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use DB;

trait SearchableProductTraits
{

    protected static function search($category = false, $brand  = false)
    {
        $products = self::query()->withoutGlobalScopes();
        foreach (request()->all() as $key => $attribute) {
            if (in_array($key, self::$searchable)) {
                $products->$key($attribute);
            }
        }
        if ($category) {
            $products->categoryFilter($category->id);
        }

        if($brand){
            $products->brandFilter($brand->id);
        }

        $products = $products->select('products.id', 'products.price')->published()->orderBy('products.price', 'DESC')->groupBy('products.id')->get(['products.id', 'products.price']);
        $productIds = $products->pluck('id')->toArray();

        $min = self::getPass() ? request('price')[0] : 0;
        $max = self::getPass() ? request('price')[1] : $products->first()? $products->first()->price : 0;

        $range = $category? $category->product()->published()->orderBy('price', 'DESC')->value('price') : Product::published()->orderBy('price', 'DESC')->value('price');

        return [
            'products' => self::query()->select('products.*', DB::raw("CASE WHEN price_outlet THEN price_outlet ELSE price END as totalPrice"))->withoutGlobalScope('attribute')->whereIn('id', $productIds)->sort(request('sort'))->paginate(self::$paginate),
            'attIds' => Attribute::whereHas('product', function ($q) use ($productIds) {
                $q->whereIn('products.id', $productIds);
            })->groupBy('attributes.id')->pluck('attributes.id')->toArray(),
            'min' => (int)$min,
            'max' => (int)$max,
            'range' => $range,
            'count' => count($productIds)
        ];

    }

    protected static function simpleSearch($category = false, $brand  = false)
    {
        $products = self::query()->withoutGlobalScopes();
        foreach (request()->all() as $key => $attribute) {
            if (in_array($key, self::$searchable)) {
                $products->$key($attribute);
            }
        }
        if ($category) {
            $products->categoryFilter($category->id);
        }

        if($brand){
            $products->brandFilter($brand->id);
        }

        $products = $products->select('products.id', 'products.price')->published()->orderBy('products.price', 'DESC')->groupBy('products.id')->get(['products.id', 'products.price']);
        $productIds = $products->pluck('id')->toArray();

        return self::query()->select('products.*', DB::raw("CASE WHEN price_outlet THEN price_outlet ELSE price END as totalPrice"))
            ->withoutGlobalScope('attribute')->whereIn('id', $productIds)->sort(request('sort'))->paginate(self::$simplePaginate);

    }

    public function scopeFilters(Builder $query, $ids)
    {
        return $query->whereHas('attribute', function ($q) use ($ids) {
            $q->whereIn('attributes.id', $ids)
                ->groupBy('products.id')
                ->havingRaw('COUNT(DISTINCT attributes.id) = ' . count($ids));
        });
    }

    public function scopeCategoryFilter(Builder $query, $category_id)
    {
        return $query->join('category_product', 'products.id', '=', 'category_product.product_id')
            ->where('category_product.category_id', $category_id);
    }

    public function scopeBrandFilter(Builder $query, $brand_id)
    {
        return $query->where('products.brand_id', $brand_id);
    }

    public function scopeSort(Builder $query, $sorting)
    {
        $sort = is_numeric($sorting) ? $sorting : 1;
        $query->getQuery()->orders = null;
        if ($sort == 1) {
            $query->orderBy('publish_at', 'DESC');
        } elseif ($sort == 2) {
            $query->orderBy('totalPrice', 'ASC');
        } elseif ($sort == 3) {
            $query->orderBy('totalPrice', 'DESC');
        }
        return $query;
    }

    public function scopePublished($query)
    {
        return $query->where('publish', 1)->where('publish_at', '<=', Carbon::now()->format('Y-m-d H:00'));
    }

    public function scopePrice(Builder $query, $price)
    {
        if (count($price) == 2) return $query->whereBetween('price', [$price[0], $price[1]]);
    }

    public static function getPass()
    {
        return request('price') && count(request('price') == 2);
    }
}