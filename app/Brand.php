<?php

namespace App;

use App\Traits\UploudableImageTrait;
use Illuminate\Database\Eloquent\Model;
use File;
use Illuminate\Database\Eloquent\Builder;

class Brand extends Model
{
    use UploudableImageTrait;

    protected $fillable = ['title', 'slug', 'short', 'body', 'order', 'logo', 'image', 'publish'];

    protected static function boot(){
        parent::boot();

        static::addGlobalScope('links', function (Builder $builder) {
            $builder->with('links');
        });
    }

    public function getBreadcrumb(){
        $str = '<nav aria-label="breadcrumb"><ol class="breadcrumb"><li class="breadcrumb-item"><a href="'. url('/') . '">Home</a></li><li class="breadcrumb-item"><a href="'. url('brendovi') . '">Brendovi</a></li>';

        $str .= '<li class="breadcrumb-item active" aria-current="page">' . $this->title . '</li></ol></nav>';

        return $str;
    }

    public function getLink(){
        return url('brendovi/' . $this->slug);
    }

    public static function getLogos(){
        return self::where('publish', 1)->where('logo', '<>', null)->where('logo', '<>', '')->get();
    }

    public function setSlugAttribute($value){
        $this->attributes['slug'] = $value? str_slug($value) : str_slug($this->attributes['title']);
    }

    public function setPublishAttribute($value){
        $this->attributes['publish'] = $value?: false;
    }

    public function collection(){
        return $this->hasMany(Collection::class);
    }

    public function product(){
        return $this->hasMany(Product::class);
    }

    public function post(){
        return $this->hasMany(Post::class);
    }

    public function slider(){
        return $this->hasMany(BrandImage::class);
    }

    public function links(){
        return $this->hasMany(BrandLink::class);
    }

    public function client(){
        return $this->belongsToMany(Client::class);
    }
}
