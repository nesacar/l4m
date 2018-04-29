<?php

namespace App;

use App\Traits\SearchableTraits;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use File;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Request;
use DB;

class Product extends Model
{
    use SearchableTraits;

    protected $fillable = [
        'user_id', 'brand_id', 'collection_id', 'set_id', 'title', 'slug', 'short', 'body', 'body2', 'code', 'image', 'tmb', 'price',
        'price_outlet', 'views', 'amount', 'color', 'discount', 'sold', 'publish_at', 'publish'
    ];

    protected static $selectable = ['id', 'set_id', 'brand_id', 'title', 'slug', 'code', 'image', 'price', 'price_outlet', 'amount', 'discount'];

    protected static $searchable = ['filters', 'price'];

    protected static $paginate = 15;

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
    }

    public function setSlugAttribute($value){
        $this->attributes['slug'] = $this->attributes['slug']? str_slug($this->attributes['slug']) : str_slug($this->attributes['title']);
    }

    public function setPublishAttribute($value){
        $this->attributes['publish'] = $value?: false;
    }

    public function getTmbAttribute(){
        return \Imagecache::get($this->attributes['image'], '63x84')->src;
    }

    public static function base64UploadImage($product, $image){
        if(!is_object($product)) $product = self::find($product);
        if($product->image != null){
            File::delete($product->image);
        }
        $exploaded = explode(',', $image);
        $data = base64_decode($exploaded[1]);
        $filename = $product->slug . '-' . str_random(2) . '-' . $product->id . '.' . self::getExtension($image);
        $path = public_path('storage/uploads/products/');
        file_put_contents($path . $filename, $data);
        $product->image = 'storage/uploads/products/' . $filename;
        $product->update();
        return $product->image;
    }

    public static function getExtension($image)
    {
        $exploaded = explode(',', $image);
        return self::getBetween($exploaded[0], '/', ';');

    }

    public static function getBetween($content,$start,$end){
        $r = explode($start, $content);
        if (isset($r[1])){
            $r = explode($end, $r[1]);
            return $r[0];
        }
        return '';
    }

    public static function getHome($limit = 4){
        return Product::published()->inRandomOrder()->take($limit)->get();
    }

    public function getLink(){
        $str = 'shop/';
        if(count($this->category)>0){
            foreach ($this->category as $category){
                $str .= $category->slug . '/';
            }
        }
        $str .= $this->slug . '/' . $this->id;
        return url($str);
    }

    public static function getHomeLatest(){
        return Category::where('publish', 1)->where('parent', 0)->get()->map(function($category){
            $category->products4;
            return $category;
        });
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
        return $this->belongsToMany(Category::class);
    }

    public function attribute(){
        return $this->belongsToMany(Attribute::class);
    }

    public function photo(){
        return $this->hasMany(Photo::class);
    }

    public function tag(){
        return $this->belongsToMany(Tag::class);
    }

    public function shopBar(){
        return $this->belongsToMany(ShopBar::class)->withPivot('order');
    }
}
