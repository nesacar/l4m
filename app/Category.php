<?php

namespace App;

use App\Traits\CacheQueryBuilder;
use App\Traits\UploudableImageTrait;
use Illuminate\Database\Eloquent\Model;
use File;
use Illuminate\Database\Eloquent\Builder;

class Category extends Model
{
    use UploudableImageTrait;

    protected $fillable = ['title', 'slug', 'seoTitle', 'seoKeywords', 'seoShort', 'order', 'parent', 'level', 'image', 'box_image', 'featured', 'publish'];

    private $categories = [];

    protected static function boot(){
        parent::boot();

        static::addGlobalScope('parentCategory', function (Builder $builder) {
            $builder->with(['parentCategory' => function($query){
                $query->where('publish', 1);
            }]);
        });
    }

    public function getLink(){
        $str = '';
        if(!empty($parent = $this->parentCategory)){
            $str = $parent->slug . '/';
            if(!empty($parent2 = $parent->parentCategory)){
                $str = $parent2->slug . '/' . $str;
                if(!empty($parent3 = $parent2->parentCategory)){
                    $str = $parent3->slug . '/' . $str;
                }
            }
        }
        $str = 'shop/' . $str . $this->slug . '/';
        return url($str);
    }

    public function getBreadcrumb(){
        $str = '';
        if(!empty($parent = $this->parentCategory)){
            $str = '<li class="breadcrumb-item"><a href="' . $parent->getLink() . '">' . $parent->title . '</a></li>' . $str;
            if(!empty($parent2 = $parent->parentCategory)){
                $str = '<li class="breadcrumb-item"><a href="' . $parent2->getLink() . '">' . $parent2->title . '</a></li>' . $str;
                if(!empty($parent3 = $parent2->parentCategory)){
                    $str = '<li class="breadcrumb-item"><a href="' . $parent3->getLink() . '">' . $parent3->title . '</a></li>' . $str;
                }
            }
        }

        $str = '<nav aria-label="breadcrumb"><ol class="breadcrumb"><li class="breadcrumb-item"><a href="'. url('/') . '">Home</a></li>' . $str . '<li class="breadcrumb-item active" aria-current="page">' . $this->title . '</li></ol></nav>';

        return $str;
    }

    public static function orderCategories($links, $parent = 0, $level = 1, $order = 0){
        if(count($links)>0){
            foreach ($links as $link){
                $old = self::find($link['id']);
                if(!empty($old) && ($old->parent != $parent || $old->order != ++$order || $old->level != $level)){
                    $old->update(['parent' => $parent, 'order' => $order, 'level' => $level]);
                }
                if(!empty($link['children'])){
                    self::orderCategories($link['children'], $link['id'], $level+1);
                }
            }
        }
    }

    public static function getFooterCategories(){
        return self::where('parent', 0)->where('publish', 1)->orderBy('order', 'ASC')->get();
    }

    public static function getProperties($slug){
        $category = self::whereSlug($slug)->first();
        if(!empty($category)){
            return $category->property()->where('properties.publish', 1)->orderBy('properties.order', 'ASC')->get();
        }
        return [];
    }

    public function setSlugAttribute($value){
        $this->attributes['slug'] = $value? str_slug($value) : str_slug($this->attributes['title']);
    }

    public function setFeaturedAttribute($value){
        $this->attributes['featured'] = $value?: false;
    }

    public function setPublishAttribute($value){
        $this->attributes['publish'] = $value?: false;
    }

    public static function tree($parent = 0) {
        return static::with(implode('.', array_fill(0, 3, 'children')))->where('parent', $parent)
            ->orderBy('order', 'ASC')->get();
    }

    public function getCategories($parent_id = 0)
    {
        $str = '-';
        $categories = self::tree($parent_id);

        if (isset($categories)) {

            foreach ($categories as $category) {

                $this->categories[] = [
                    'id' => $category->id,
                    'title' => str_repeat($str, $category->level) . ' ' . $category->title
                ];

                if ($category->children()) {
                    // call recursive
                    $this->getCategories($category->id);
                }
            }

        }
        return $this->categories;
    }

    public static function setPrimaryCategory($slug){
        if(\Session::has('primary')){
            if(\Session::get('primary') != $slug){
                $category = Category::where('slug', $slug)->first();
                \Session::put('primary', $slug);
                \Session::put('category_id', $category->id);
            }
        }else{
            \Session::put('primary', $slug);
        }
    }

    public function scopePublished($query)
    {
        $query->where('publish', 1);
    }

    public function scopeFeatured($query)
    {
        $query->where('featured', 1);
    }

    public function parentCategory() {
        return $this->hasOne(Category::class, 'id', 'parent');
    }

    public function children() {
        return $this->hasMany(Category::class, 'parent', 'id');
    }

    public function product(){
        return $this->belongsToMany(Product::class);
    }

    public function products4(){
        return $this->belongsToMany(Product::class)->limit(4);
    }

    public function shopBar(){
        return $this->hasMany(ShopBar::class);
    }

    public function set(){
        return $this->belongsToMany(Set::class);
    }

    public function client(){
        return $this->belongsToMany(Client::class);
    }

    public function property(){
        return $this->belongsToMany(Property::class);
    }

    public function block(){
        return $this->hasMany(Block::class);
    }

    public function brand(){
        return $this->belongsToMany(Brand::class);
    }
}
