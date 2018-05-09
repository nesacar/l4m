<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use File;

class Box extends Model
{
    protected $fillable = ['category_id', 'block_id', 'title', 'subtitle', 'button', 'link', 'image', 'order', 'publish'];

    public static function base64UploadImage($box_id, $image){
        $box = self::find($box_id);
        if($box->image != null){
            File::delete($box->image);
        }
        $exploaded = explode(',', $image);
        $data = base64_decode($exploaded[1]);
        $filename = str_random(2) . '-' . $box->id . '.' . self::getExtension($image);
        $path = Helper::generateImageFolder('uploads/boxes/');
        file_put_contents($path['fullFolderPath'] . '/' . $filename, $data);
        $box->image = 'storage/uploads/boxes/' . $path['folder'] . '/' . $filename;
        $box->update();
        return $box->image;
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

    public function block(){
        return $this->belongsTo(Block::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }
}
