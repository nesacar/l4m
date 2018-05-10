<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use File;

class Collection extends Model
{
    protected $fillable = ['brand_id', 'title', 'slug', 'short', 'body', 'order', 'image', 'publish'];

    public static function base64UploadImage($collection_id, $image){
        $collection = self::find($collection_id);
        if($collection->image != null){
            File::delete($collection->image);
        }
        $exploaded = explode(',', $image);
        $data = base64_decode($exploaded[1]);
        $filename = $collection->slug . '-' . str_random(2) . '-' . $collection->id . '.' . self::getExtension($image);
        $path = Helper::generateImageFolder('uploads/collections/');
        file_put_contents($path['fullFolderPath'] . '/' . $filename, $data);
        $collection->image = 'storage/uploads/collections/' . $path['folder'] . '/' . $filename;
        $collection->update();
        return $collection->image;
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

    public function brand(){
        return $this->belongsTo(Brand::class);
    }

    public function product(){
        return $this->hasMany(Product::class);
    }
}
