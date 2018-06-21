<?php

namespace App;

use App\Traits\SearchableProductTraits;
use App\Traits\UploudableImageTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use File;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Request;
//use DB;

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

    protected static $paginate = 15;

    protected static $simplePaginate = 16;

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

    public static function getHome($limit = 4){
        return Product::published()->inRandomOrder()->take($limit)->get();
    }

    public function getLink($category = false){
        if($category){
            return url($category->getLink() . '/' .  $this->slug . '/' . $this->id);
        }else{
            $str = 'shop/';
            if(count($this->category)>0){
                foreach ($this->category as $category){
                    $str .= $category->slug . '/';
                }
            }
            $str .= $this->slug . '/' . $this->id;
            return url($str);
        }
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

    public function sizes(){
        return $this->belongsToMany(Attribute::class)->where('property_id', 11);
    }

    public function scopeSame(){
        return $this->where('id', '<>', $this->id)->where('code', $this->code);
    }

    public function colors(){
        return $this->belongsToMany(Attribute::class)->where('property_id', 9);
    }
}
