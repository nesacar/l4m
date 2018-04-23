<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use File;

class Product extends Model
{
    protected $fillable = [
        'user_id', 'brand_id', 'collection_id', 'set_id', 'title', 'slug', 'short', 'body', 'body2', 'code', 'image', 'tmb', 'price',
        'price_outlet', 'views', 'amount', 'color', 'discount', 'sold', 'publish_at', 'publish'
    ];

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

    public function setSlugAttribute($value){
        $this->attributes['slug'] = str_slug($value);
    }

//    public function getPublishAttribute($value){
//        return $value? 'Da' : 'Ne';
//    }

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
}
