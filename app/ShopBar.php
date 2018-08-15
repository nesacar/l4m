<?php

namespace App;

use App\Events\ShopBarCreatedUpdated;
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
        // Trigger shop-bar create/update event after sync in case if overriding products is needed.
        event(new ShopBarCreatedUpdated($this));
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

    /**
     * Update shop-bar products with latest products based on shop-bar category
     * Update will occur only if shop-bar have column 'latest' set to 1
     *
     * @param string $template
     */
    public function syncShopBarLatestProducts($template = 'home')
    {
        // Get shopBars for $parent category
        $shopBars = $this->where('template', $template)
            ->orderBy('order', 'ASC')
            ->get();

        // Loop through each shop-bar and take 4 products based on shop-bar category
        foreach ($shopBars as $shopBar) {

            // If shopBar has "latest" column set to 1, get latest products based on shop-bar category
            // It will also override existing products for this shop-bar
            if ($shopBar->latest) {

                // Get products for iterating shop-bar
                $products = Product::withoutGlobalScopes()
                    ->whereHas('category', function ($query) use ($shopBar) {
                        // Select product based on his category
                        $query->where('id', $shopBar->category_id);
                    })
                    ->orderBy('created_at', 'DESC')
                    ->take(4)
                    ->get(['id']);

                // Convert products collection into array of products ids
                $productsIds = $products->pluck('id')->toArray();

                /**
                 * Prepare pivot data which will be send with products ids.
                 * In this case this is order column, which value increases by 1 on every product for shop-bar id.
                 */
                $pivotData = [];
                foreach ($productsIds as $key => $productsId)
                {
                    $pivotData[] = ['order' => ++$key];
                }
                // Merge pivot data into product ids array
                $productsIds = array_combine($productsIds, $pivotData);

                /**
                 * Finally, sync pivot shop_bar-product table with iterating shop_bar id and products ids
                 */
                $shopBar->product()->sync($productsIds);
            }

        }
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
