<?php

namespace App;

use App\Events\ProductCreated;
use App\Traits\SearchableProductTraits;
use App\Traits\UploudableImageTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use File;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Request;
//use DB;
use Illuminate\Support\Facades\Cache;

class Product extends Model
{
    use SearchableProductTraits, UploudableImageTrait;

    protected $fillable = [
       'client_id', 'user_id', 'brand_id', 'collection_id', 'title', 'slug', 'short', 'body', 'body2', 'code', 'code_addition', 'image', 'price',
        'price_outlet', 'views', 'amount', 'color', 'water', 'diameter', 'discount', 'sold', 'publish_at', 'publish'
    ];

    //protected $dates = ['publish_at'];

    protected $appends = ['date', 'time', 'link', 'tmb', 'totalPrice'];

    protected static $selectable = ['id', 'brand_id', 'title', 'slug', 'code', 'image', 'price', 'price_outlet', 'amount', 'discount'];

    protected static $searchable = ['filters', 'price'];

    // Sinisa - Changed shop listing from 15 to 12 products per page.
    protected static $paginate = 12;

    protected static $simplePaginate = 16;

    protected static $colorId = 9;

    protected static $mappable = [
        'title' => 'naziv',
        'code' => 'sifra_artikla',
        'publish' => 'publikovanje',
        'amount' => 'kolicina',
        'price' => 'cena',
        'discount' => 'popust',
        'short' => 'kratak_opis',
        'body' => 'opis',
        'body2' => 'opis2',
    ];

    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'created' => ProductCreated::class,
    ];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot(){
        parent::boot();

        static::addGlobalScope('category', function (Builder $builder) {
            $builder->with(['category' => function($query){
                $query->where('publish', 1)->orderBy('parent', 'ASC');
            }]);
        });

        static::addGlobalScope('brand', function (Builder $builder) {
            $builder->with(['brand' => function($query){
                $query->where('publish', 1)->orderBy('order', 'ASC');
            }]);
        });

        static::addGlobalScope('attribute', function (Builder $builder) {
            $builder->with(['attribute' => function($query){
                $query->where('publish', 1)->orderBy('order', 'ASC')->pluck('id');
            }]);
        });

        static::addGlobalScope('photo', function (Builder $builder) {
            $builder->with('photo');
        });
    }

    public function setSlugAttribute($value){
        $this->attributes['slug'] = $value? str_slug($value) : str_slug($this->attributes['title']);
    }

    public function setPublishAttribute($value){
        $this->attributes['publish'] = $value?: false;
    }

    public function setPublishAtAttribute($value){
        if($value) $this->attributes['publish_at'] = Carbon::parse($value)->format('Y-m-d H:00:00');
    }

    public function getTmbAttribute(){
        return $this->image? \Imagecache::get($this->attributes['image'], '63x84')->src : '';
    }

    public function getBrandsAttribute()
    {
        return $this->brand_id;
    }

    public function getCollectionsAttribute()
    {
        return $this->collection_id;
    }

    public function getCategoriesAttribute()
    {
        return $this->category()->pluck('id');
    }

    public function getDanObjaveAttribute()
    {
        $publish_at = $this->publish_at;
        $date = explode(' ', $publish_at);
        return $date[0];
    }

    public function getVremeObjaveAttribute()
    {
        $publish_at = $this->publish_at;
        $time = explode(' ', $publish_at);
        return $time[1];
    }

    public static function getHome($limit = 4){
        return Product::published()->inRandomOrder()->take($limit)->get();
    }

    public function getLink($category = false){
        /*if($category){
            return url($category->getLink() . '/' .  $this->slug . '/' . $this->id);
        }else{*/
            $str = 'shop/';
            if(count($this->category)>0){

                $categories = $this->removeDuplicate($this->category);

                foreach ($categories as $category) {
                    $str .= $category->slug . '/';
                }
            }
            $str .= $this->slug . '/' . $this->id;
            return url($str);
        /*}*/
    }

    /**
     * Remove duplicated categories from collection
     *
     * @param $categories
     * @return mixed
     */
    protected function removeDuplicate($categories)
    {
        return $categories->unique('slug')->unique('parent');
    }

    public function getBreadcrumb($slug){
        $str = '<nav aria-label="breadcrumb"><ol class="breadcrumb"><li class="breadcrumb-item"><a href="'. url('/') . '">Home</a></li>';
        $level = -1;
        if(count($this->category)>0){
            foreach ($this->category as $category){
                if(($level == -1 && $category->slug == $slug) || $level != -1){
                    if($level != $category->level){
                        $level = $category->level;
                        $str .= '<li class="breadcrumb-item"><a href="' . $category->getLink() . '">' . $category->title . '</a></li>';
                    }
                }
            }
        }

        $str .= '<li class="breadcrumb-item active" aria-current="page">' . $this->title . '</li></ol></nav>';

        return $str;
    }

    public static function filter($array = []){
        if(count($array)>0){
            return array_column($array, 'id');
        }
    }

    /**
     * Filter only fields with attributes from all form fields in request
     *
     * @param $product
     * @return array
     */
    public static function filterAttributes($product)
    {
        // Filter array keys with prefix "dynamic_"
        $array = array_map(function ($product, $key) {
            if (preg_match('/dynamic_/', $key) && $product['value'] != -1) {
                return $product['value'];
            }
        }, $product, array_keys($product));

         /* Since we also map other elements including attributes,
            all elements will have null value except attributes.
            Passing this array through the array_filter will remove elements with empty values.
         */
        return array_filter($array);
    }

    /**
     * Rename class properties with names from $mappable
     *
     * @param $products
     * @return mixed
     */
    public static function mappableFields($products) {
        foreach ($products as $product) {
            // Get array with indexes from product attributes
            $keys = array_keys($product->attributes);

            foreach ($keys as $key) {
                // Check if there is key in $mappable array which corresponding to iterating key
                if (array_key_exists($key, self::$mappable)) {

                    $map = self::$mappable[$key];
                    // Append product with renamed properties
                    $product->$map = $product->$key;
                }
            }
            // ReAppend product with drop-down select and time-date picker properties
            $product->setAppends(['brands', 'collections', 'categories', 'dan_objave', 'vreme_objave']);
            // Append product with dynamic properties
            self::mapDynamicFields($product);
        }
        return $products;
    }

    /**
     * Rename class properties with dynamic properties (with dynamic_ prefix).
     *
     * @param $product
     * @return mixed
     */
    public static function mapDynamicFields($product)
    {
        // Loop through product attributes to find property_id for attribute
        foreach ($product->attribute as $attribute) {
            // Get property name
            $propertyName = Property::find($attribute->property_id)->slug;
            // Define dynamic field name with prefix "dynamic_"
            $dynamicFieldName = 'dynamic_'.$propertyName;
            // Append dynamic property to product
            $product->$dynamicFieldName = $attribute->id;
        }
        return $product;
    }

    public static function getHomeLatest(){
        return Category::where('publish', 1)->where('parent', 0)->get()->map(function($category){
            $category->products4;
            return $category;
        });
    }

    public static function getRelated($product, $category, $limit=6){
        $products = Product::where('brand_id', $product->brand_id)->where('id', '<>', $product->id)->withoutGlobalScope('attribute')->with('photo')->published()->inRandomOrder()->limit($limit)->get();
        if(count($products)>3){
            return $products;
        }else{
            return $category->product()->where('products.id', '<>', $product->id)->withoutGlobalScope('attribute')->with('photo')->published()->inRandomOrder()->limit($limit)->get();
        }
    }

    /**
     * Get related products by category
     *
     * @param $post
     * @param $products_num
     * @param bool $parent
     * @return mixed
     */
    public static function relatedProductsByCategory($post, $products_num, $parent = false)
    {
        // If post have category and have products less than defined number, get related products by category
        if ($post->category_id && count($post->product) < $products_num) {

            $relatedProducts = Product::withoutGlobalScope('attribute')
                ->publish()->whereHas('category', function ($query) use ($post, $parent) {

                    // If there isn't products for category, get parent category
                if ($parent) {

                    if ($post->category->parentCategory) {
                        $query->where('id', $post->category->parentCategory->id);
                    }
                    else {
                        // If there isn't parent category, return products fetched so far
                        return $post;
                    }
                }
                else {
                    $query->where('id', $post->category_id);
                }
            })
                ->take($products_num - count($post->product))
                ->inRandomOrder()->get();

            // Merge products into post
            foreach ($relatedProducts as $product) {
                $post->product->push($product);
            }

            // If post have products less than defined number
            if (count($post->product) < $products_num) {
                // run recursive
                self::relatedProductsByCategory($post, $products_num, true);
            }
        }
        return $post;
    }

    public function getDateAttribute(){
        return Carbon::parse($this->publish_at)->format('Y-m-d');
    }

    public function getTimeAttribute(){
        return Carbon::parse($this->publish_at)->format('H:00:00');
    }

    public function getLinkAttribute(){
        return $this->getLink($this->category->first());
    }

    public function getTotalPriceAttribute(){
        return ($this->price_outlet != null || $this->price_outlet) != 0 ? $this->price_outlet: $this->price;
    }

    public function sizes(){
        return $this->belongsToMany(Attribute::class)->where('property_id', 11);
    }

    public function scopeSame(){
        return Cache::remember($this->id.'.colors', Helper::getMinutesToTheNextHour(), function () {
            return $this->query()->with(['attribute' => function($query){
                $query->select('id', 'title', 'extra')->where('property_id', self::$colorId)->first();
            }])->where('id', '<>', $this->id)->where('code', $this->code)->get();
        });
    }

    public function scopePublish($query)
    {
        return $query->where('publish', 1);
    }

    public function colors(){
        return $this->belongsToMany(Attribute::class)->where('property_id', self::$colorId);
    }

    public function checkColor(){
        $res = false;
        if(count($this->attribute)>0){
            foreach ($this->attribute as $attribute){
                if($attribute->property_id == self::$colorId){
                    $res = true;
                }
            }
        }
        return $res;
    }

    public function getColor(){
        $res = false;
        if(count($this->attribute)>0){
            foreach ($this->attribute as $attribute){
                if($attribute->property_id == self::$colorId){
                    $res = $attribute;
                }
            }
        }
        return $res;
    }

    public static function getCleanProductForShopBar($shopBar){
        $res = [];
        $values = \DB::table('product_shop_bar')->where('product_shop_bar.shop_bar_id', $shopBar->id)->orderBy('order', 'ASC')->get();
        if(count($values)>0){
            foreach ($values as $value){
                $res[] = \DB::table('products')->where('id', $value->product_id)->get(['id', 'code as title']);
            }
        }
        return $res;
    }

    public function brand(){
        return $this->belongsTo(Brand::class);
    }

    public function collection(){
        return $this->belongsTo(Collection::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function set(){
        return $this->belongsTo(Set::class);
    }

    public function category(){
        return $this->belongsToMany(Category::class)->orderBy('parent', 'ASC');
    }

    public function attribute(){
        return $this->belongsToMany(Attribute::class);
    }

    public function photo(){
        return $this->hasMany(Photo::class)->take(3);
    }

    public function tag(){
        return $this->belongsToMany(Tag::class);
    }

    public function shopBar(){
        return $this->belongsToMany(ShopBar::class)->withPivot('order');
    }

    public function post(){
        return $this->belongsToMany(Post::class);
    }

    public function order(){
        return $this->hasMany(Order::class);
    }

    public function client(){
        return $this->belongsTo(Client::class);
    }
}
