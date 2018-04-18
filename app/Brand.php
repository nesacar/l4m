<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use File;

class Brand extends Model
{
    protected $table = 'brands';

    protected $fillable = ['id', 'title', 'slug', 'short', 'body', 'order', 'image', 'publish'];

    public static function base64UploadImage($brand_id, $image){
        $brand = self::find($brand_id);
        if($brand->image != null){
            File::delete($brand->image);
        }
        $exploaded = explode(',', $image);
        $data = base64_decode($exploaded[1]);
        $filename = $brand->slug . '-' . str_random(2) . '-' . $brand->id . '.' . self::getExtension($image);
        $path = public_path('storage/uploads/brands/');
        file_put_contents($path . $filename, $data);
        $brand->image = 'storage/uploads/brands/' . $filename;
        $brand->update();
        return $brand->image;
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
}
