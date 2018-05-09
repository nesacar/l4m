<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use File;

class Brand extends Model
{
    protected $fillable = ['title', 'slug', 'short', 'body', 'order', 'logo', 'image', 'publish'];

    public static function base64UploadImage($brand_id, $image){
        $brand = self::find($brand_id);
        if($brand->image != null){
            File::delete($brand->image);
        }

        $exploaded = explode(',', $image);
        $data = base64_decode($exploaded[1]);
        $filename = $brand->slug . '-' . str_random(2) . '-' . $brand->id . '.' . self::getExtension($image);
        $path = Helper::generateImageFolder('uploads/brands/');
        file_put_contents($path['fullFolderPath'] . '/' . $filename, $data);
        $brand->image = 'storage/uploads/brands/' . $path['folder'] . '/' . $filename;
        $brand->update();
        return $brand->image;
    }

    public static function base64UploadLogoImage($brand_id, $image){
        $brand = self::find($brand_id);
        if($brand->logo != null){
            File::delete($brand->logo);
        }

        $exploaded = explode(',', $image);
        $data = base64_decode($exploaded[1]);
        $filename = $brand->slug . '-' . str_random(2) . '-' . $brand->id . '.' . self::getExtension($image);
        $path = public_path('storage/uploads/brands/logo/');
        file_put_contents($path . $filename, $data);
        $brand->logo = 'storage/uploads/brands/logo/' . $filename;
        $brand->update();
        return $brand->logo;
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

    public function collection(){
        return $this->hasMany(Collection::class);
    }

    public function product(){
        return $this->hasMany(Product::class);
    }

    public function post(){
        return $this->hasMany(Post::class);
    }
}
