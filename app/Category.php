<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use File;

class Category extends Model
{
    protected $fillable = ['title', 'slug', 'short', 'order', 'parent', 'level', 'image', 'publish'];

    public static function base64UploadImage($category_id, $image){
        $category = self::find($category_id);
        if($category->image != null){
            File::delete($category->image);
        }
        $exploaded = explode(',', $image);
        $data = base64_decode($exploaded[1]);
        $filename = $category->slug . '-' . str_random(2) . '-' . $category->id . '.' . self::getExtension($image);
        $path = public_path('storage/uploads/categories/');
        file_put_contents($path . $filename, $data);
        $category->image = 'storage/uploads/categories/' . $filename;
        $category->update();
        return $category->image;
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

    public function getPublishAttribute($value){
        return $value? 'Da' : 'Ne';
    }

    public function parentCategory(){
        return $this->hasMany(self::class, 'parent', 'id');
    }
}
