<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use File;

class Photo extends Model
{
    protected $fillable = ['product_id', 'file_name', 'file_path', 'publish'];

    protected $appends = ['tmb'];

    public static function saveImage($product_id, $image){
        $product = Product::find($product_id);
        $folderName = self::folderName($product);
        $imageName = self::imageName($product);

        $image->storeAs('uploads/galleries/' . $folderName,
            $imageName . '.' . $image->getClientOriginalExtension(),
            'public'
        );

        if(isset($image)){

            $brandImage = new Photo();
            $brandImage->product_id = $product->id;
            $brandImage->file_name = $imageName . '.' . $image->getClientOriginalExtension();
            $brandImage->file_path = 'storage/uploads/galleries/' . $folderName . '/' . $imageName . '.' . $image->getClientOriginalExtension();
            $brandImage->publish = 1;
            $brandImage->save();
        }

        return 'done';

    }

    public static function cropImage($image, $width){
        \Image::make($image)->resize($width, null, function ($constraint) {
            $constraint->aspectRatio();
        })->save($image);
    }

    protected static function imageName($product){
        return self::folderName($product) . '-' . str_random(4);
    }

    protected static function folderName($product){
        return $product->slug . '-' . $product->id;
    }

    public function getTmbAttribute(){
        return \Imagecache::get($this->attributes['file_path'], '90x120')->src;
    }

    public function product(){
        return $this->belongsTo(Product::class);
    }
}
