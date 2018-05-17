<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use File;

class Photo extends Model
{

    protected $fillable = ['product_id', 'file_name', 'file_path', 'publish'];

    protected $appends = ['tmb'];

    public static function cropImage($image, $width){
        \Image::make($image)->resize($width, null, function ($constraint) {
            $constraint->aspectRatio();
        })->save($image);
    }

    public function getTmbAttribute(){
        return \Imagecache::get($this->attributes['file_path'], '90x120')->src;
    }

    public function product(){
        return $this->belongsTo(Product::class);
    }
}
