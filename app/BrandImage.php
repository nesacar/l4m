<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use File;
use Illuminate\Http\Request;

class BrandImage extends Model
{
    protected $fillable = ['brand_id', 'file_name', 'file_path', 'publish'];

    protected $appends = ['tmb'];

    public static function saveImage($brand_id, $image){
        $brand = Brand::find($brand_id);
        $imageName = self::imageName($brand);
        $image->storeAs('uploads/brands/images',
            $imageName . '.' . $image->getClientOriginalExtension(),
            'public'
        );

        if(isset($image)){

            $brandImage = new BrandImage();
            $brandImage->brand_id = $brand->id;
            $brandImage->file_name = $imageName . '.' . $image->getClientOriginalExtension();
            $brandImage->file_path = 'storage/uploads/brands/images/' . $imageName . '.' . $image->getClientOriginalExtension();
            $brandImage->publish = 1;
            $brandImage->save();
        }

        return 'done';

    }

    protected static function imageName($brand){
        return $brand->slug . '-' . $brand->id . '-' . str_random(4);
    }

    public function brand(){
        return $this->belongsTo(Brand::class);
    }

    public function getTmbAttribute(){
        return \Imagecache::get($this->file_path, '100x43')->src;
    }
}
