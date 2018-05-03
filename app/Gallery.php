<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use File;

class Gallery extends Model
{
    protected $fillable = ['post_id', 'file_name', 'file_path', 'publish'];

    public static function saveImage($post_id, $image){
        $post = Post::find($post_id);
        $folderName = $post->slug . '-' . $post->id;
        $folderPath = public_path('storage/uploads/galleries/posts/' . $folderName);
        if(!File::exists($folderPath)) {
            File::makeDirectory($folderPath, 0775, true, true);
        }

        if(isset($image)){
            $imageName = $folderName . '-' .  str_random(4) . '.' . $image->getClientOriginalExtension();
            $imagePath = 'storage/uploads/galleries/'.$folderName.'/'.$imageName;
            $image->move(public_path('storage/uploads/galleries/posts/' . $folderName . '/'), $imageName);

            $gallery = new Gallery();
            $gallery->post_id = $post_id;
            $gallery->file_name = $imageName;
            $gallery->file_path = $imagePath;
            $gallery->publish = 1;
            $gallery->save();
        }

        return 'done';

    }

    public static function cropImage($image, $width){
        \Image::make($image)->resize($width, null, function ($constraint) {
            $constraint->aspectRatio();
        })->save($image);
    }

    public function getFilePathSmallAttribute(){
        return \Imagecache::get($this->attributes['file_path'], '120x90')->src;
    }

    public function post(){
        return $this->belongsTo(Post::class);
    }
}
