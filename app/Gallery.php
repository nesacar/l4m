<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use File;

class Gallery extends Model
{
    protected $fillable = ['post_id', 'file_name', 'file_path', 'publish'];

    protected $appends = ['tmb'];

    public static function saveImage($post_id, $image){
        $post = Post::find($post_id);

        $folderName = self::folderName($post);
        $imageName = self::imageName($post);

        $image->storeAs(
            'uploads/galleries/posts/' . $folderName,
            $imageName . '.' . $image->getClientOriginalExtension(),
            'public'
        );

        if(isset($image)){

            $postImage = new Gallery();
            $postImage->post_id = $post->id;
            $postImage->file_name = $imageName . '.' . $image->getClientOriginalExtension();
            $postImage->file_path = 'storage/uploads/galleries/posts/' . $folderName . '/' . $imageName . '.' . $image->getClientOriginalExtension();
            $postImage->publish = 1;
            $postImage->save();
        }

        return 'done';
    }

//    public static function cropImage($image, $width){
//        \Image::make($image)->resize($width, null, function ($constraint) {
//            $constraint->aspectRatio();
//        })->save($image);
//    }

    protected static function imageName($post){
        return $post->slug . '-' . $post->id . '-' . str_random(4);
    }

    protected static function folderName($post){
        return $post->id;
    }

    public function getTmbAttribute(){
        return \Imagecache::get($this->attributes['file_path'], '120x90')->src;
    }

    public function post(){
        return $this->belongsTo(Post::class);
    }
}
