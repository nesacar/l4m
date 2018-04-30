<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use File;

class Photo extends Model
{
    protected $fillable = ['product_id', 'file_name', 'file_path', 'file_path_small', 'publish'];

    public static function saveImage($product_id, $image){
        $product = Product::find($product_id);
        $folderName = $product->slug . '-' . $product->id;
        $folderPath = public_path('storage/uploads/galleries/' . $folderName);
        if(!File::exists($folderPath)) {
            File::makeDirectory($folderPath, 0775, true, true);
        }

        if(isset($image)){
            $imageName = $folderName . '-' .  str_random(4) . '.' . $image->getClientOriginalExtension();
            $imagePath = 'storage/uploads/galleries/'.$folderName.'/'.$imageName;
            $image->move(public_path('storage/uploads/galleries/' . $folderName . '/'), $imageName);

            $photo = new Photo();
            $photo->product_id = $product_id;
            $photo->file_name = $imageName;
            $photo->file_path = $imagePath;
            $photo->publish = 1;
            $photo->save();
        }

        return 'done';

    }

    public static function cropImage($image, $width){
        \Image::make($image)->resize($width, null, function ($constraint) {
            $constraint->aspectRatio();
        })->save($image);
    }

    public function getFilePathSmallAttribute(){
        return \Imagecache::get($this->attributes['file_path'], '63x84')->src;
    }

    public function product(){
        return $this->belongsTo(Product::class);
    }
}
