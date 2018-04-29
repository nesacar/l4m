<?php

namespace App\Traits;

use App\Attribute;
use App\Category;
use App\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

trait SearchableProductTraits
{

    protected static function search($category = false)
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

        $products = $products->select('products.id', 'products.price')->published()->orderBy('products.price', 'DESC')->groupBy('products.id')->get(['products.id', 'products.price']);
        $productIds = $products->pluck('id')->toArray();

        $min = self::getPass() ? request('price')[0] : 0;
        $max = self::getPass() ? request('price')[1] : $products->first()->price;

        $range = $category? $category->product()->published()->orderBy('price', 'DESC')->value('price') : Product::published()->orderBy('price', 'DESC')->value('price');

        return [
            'products' => self::query()->withoutGlobalScope('attribute')->whereIn('id', $productIds)->sort(request('sort'))->paginate(self::$paginate),
            'attIds' => Attribute::whereHas('product', function ($q) use ($productIds) {
                $q->whereIn('products.id', $productIds);
            })->groupBy('attributes.id')->pluck('attributes.id')->toArray(),
            'min' => (int)$min,
            'max' => (int)$max,
            'range' => $range,
            'count' => count($productIds)
        ];

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

    public function scopeSort(Builder $query, $sorting)
    {
        $sort = is_numeric($sorting) ? $sorting : 1;
        $query->getQuery()->orders = null;
        if ($sort == 1) {
            $query->orderBy('publish_at', 'DESC');
        } elseif ($sort == 2) {
            $query->orderBy('price', 'ASC');
        } elseif ($sort == 3) {
            $query->orderBy('price', 'DESC');
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