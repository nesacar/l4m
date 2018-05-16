<?php

namespace App;

use App\Traits\UploudableImageTrait;
use Illuminate\Database\Eloquent\Model;
use File;
use Illuminate\Database\Eloquent\Builder;

class Category extends Model
{
    use UploudableImageTrait;

    protected $fillable = ['title', 'slug', 'seoTitle', 'seoKeywords', 'seoShort', 'order', 'parent', 'level', 'image', 'box_image', 'publish'];

//    protected static function boot(){
//        parent::boot();
//
//        static::addGlobalScope('children', function (Builder $builder) {
//            $builder->with(['children' => function($query){
//                $query->where('publish', 1)->orderBy('parent', 'ASC');
//            }]);
//        });
//    }

    public function getLink(){
        $str = 'shop/' . $this->slug . '/';
        if(count($this->children)>0){
            foreach ($this->children as $category){
                $str .= $category->slug . '/';
            }
        }
        return url($str);
    }

    public function getBreadcrumb(){
        $str = '<nav aria-label="breadcrumb"><ol class="breadcrumb"><li class="breadcrumb-item"><a href="'. url('/') . '">Home</a></li>';

        if(count($this->children)>0){
            foreach ($this->children as $category){
                $str .= '<li class="breadcrumb-item"><a href="' . $category->getLink() . '">' . $category->title . '</a></li>';
            }
        }

        $str .= '<li class="breadcrumb-item active" aria-current="page">' . $this->title . '</li></ol></nav>';

        return $str;
    }

    public static function getFooterCategories(){
        return self::where('parent', 0)->where('publish', 1)->orderBy('order', 'ASC')->get();
    }

    public function setSlugAttribute($value){
        $this->attributes['slug'] = str_slug($value);
    }

    public function setPublishAttribute($value){
        $this->attributes['publish'] = $value?: false;
    }

    public static function tree() {
        return static::with(implode('.', array_fill(0, 1, 'children')))->where('parent', 0)->get();
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
}
