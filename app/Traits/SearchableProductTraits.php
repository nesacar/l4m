<?php

namespace App\Traits;

use App\Attribute;
use App\Category;
use App\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use DB;
use Session;

trait SearchableProductTraits
{

    protected static function search($category = false, $brand  = false, $client = false, $discount = false)
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

        if($client){
            $products->clientFilter($client->id);
        }

        if($discount){
            $products->discountFilter();
        }

        $products = $products->select('*', DB::raw("CASE WHEN price_outlet THEN price_outlet ELSE price END as totalPrice"))
            ->published()->orderByRaw(DB::raw('totalPrice') . ' DESC')->groupBy('id');

        $productIds = $products->pluck('id')->toArray();

        if($products->first() != null){
            $min = self::getPass() ? request('price')[0] : 0;
            $max = self::getPass() ? request('price')[1] : $products->first()->totalPrice;
        }else{
            $min = self::getPass() ? request('price')[0] : 0;
            $max = self::getPass() ? request('price')[1] : 0;
        }


        if($category){
            $range = $category->product()->select('products.id', 'products.price', 'products.price_outlet', DB::raw("CASE WHEN products.price_outlet THEN products.price_outlet ELSE products.price END as totalPrice"))
                ->withoutGlobalScopes()->published()->orderByRaw(DB::raw('totalPrice') . ' DESC')->value('totalPrice');
        }else{
            $range = Product::select('products.id', 'products.price', 'products.price_outlet', DB::raw("CASE WHEN products.price_outlet THEN products.price_outlet ELSE products.price END as totalPrice"))
                ->withoutGlobalScopes()->published()->orderByRaw(DB::raw('totalPrice') . ' DESC')->value('totalPrice');
        }

        return [
            'products' => self::query()->select('products.*', DB::raw("CASE WHEN price_outlet THEN price_outlet ELSE price END as totalPrice"))->with('photo')->withoutGlobalScope('attribute')->whereIn('id', $productIds)->sort(request('sort'))->paginate(self::$paginate),
            'attIds' => Attribute::whereHas('product', function ($q) use ($productIds) {
                $q->whereIn('products.id', $productIds);
            })->groupBy('attributes.id')->pluck('attributes.id')->toArray(),
            'min' => (int) ($min / Session::get('currency')->exchange_rate),
            'max' => (int) ($max / Session::get('currency')->exchange_rate),
            'range' => (int) ($range / Session::get('currency')->exchange_rate) + 1,
            'count' => count($productIds)
        ];

    }

    protected static function simpleSearch($category = false, $brand  = false, $client = false, $discount = false){
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

        if($client){
            $products->clientFilter($client->id);
        }

        if($discount){
            $products->discountFilter();
        }

        $products = $products->select('products.id', 'products.price')->published()->orderBy('products.price', 'DESC')->groupBy('products.id')->get(['products.id', 'products.price']);
        $productIds = $products->pluck('id')->toArray();

        return self::query()->select('products.*', DB::raw("CASE WHEN price_outlet THEN price_outlet ELSE price END as totalPrice"))
            ->withoutGlobalScope('attribute')->with('photo')->whereIn('id', $productIds)->sort(request('sort'))->paginate(self::$simplePaginate);

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

    public function scopeClientFilter(Builder $query, $client_id)
    {
        return $query->where('products.client_id', $client_id);
    }

    public function scopeDiscountFilter(Builder $query)
    {
        return $query->where('products.discount', '>', 0);
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
        if (count($price) == 2) return $query->havingRaw(DB::raw('totalPrice') . ' BETWEEN ' . ($price[0]) . ' AND ' . ($price[1]));
    }

    public static function getPass()
    {
        return request('price') && count(request('price') == 2);
    }
}