<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use File;

class Theme extends Model
{
    protected $table = 'themes';

    protected $fillable = ['title', 'image', 'version', 'author', 'author_address', 'author_email', 'developer', 'active', 'publish'];

    public static function activateTheme($id){
        $themes = self::all();
        if(count($themes) > 0){
            foreach($themes as $t){
                $t->active = 0;
                $t->update();
            }
        }
        $theme = self::find($id);
        $theme->active = 1;
        $theme->update();
    }

    public static function deactivateTheme($id){
        $themes = self::all();
        if(count($themes) > 0){
            foreach($themes as $t){
                $t->active = 0;
                $t->update();
            }
        }
        $theme = self::first();
        $theme->active = 1;
        $theme->update();
    }

    public static function base64UploadImage($theme, $image){
        if($theme->image != null){
            File::delete($theme->image);
        }
        $exploaded = explode(',', $image);
        $data = base64_decode($exploaded[1]);
        $filename = time() . '-' . $theme->id . '.jpg';
        $path = public_path('storage/uploads/themes/');
        file_put_contents($path . $filename, $data);
        $theme->image = 'storage/uploads/themes/' . $filename;
        $theme->update();
        return $theme->image;
    }

    public static function getTheme(){
        if(config('app.theme')){
            return config('app.theme');
        }else{
            return $theme = self::where('active', 1)->first()->slug;
        }
    }
}
