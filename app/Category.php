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

    public static function tree() {
        return static::with(implode('.', array_fill(0, 1, 'children')))->where('parent', '=', 0)->get();
    }

    public function setSlugAttribute($value){
        $this->attributes['slug'] = str_slug($value);
    }

    public function getPublishAttribute($value){
        return $value? 'Da' : 'Ne';
    }

    public function parent() {
        return $this->hasOne(Category::class, 'id', 'parent');
    }

    public function children() {
        return $this->hasMany(Category::class, 'parent', 'id');
    }

    public function product(){
        return $this->belongsToMany(Product::class);
    }

}
