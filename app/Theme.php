<?php

namespace App;

use App\Traits\UploudableImageTrait;
use Illuminate\Database\Eloquent\Model;
use File;

class Theme extends Model
{
    use UploudableImageTrait;

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

    public static function getTheme(){
        if(config('app.theme')){
            return config('app.theme');
        }else{
            return $theme = self::where('active', 1)->first()->slug;
        }
    }

    public static function getRandomaArray($limit=8){
        $numbers = range(5,25);
        $numbers = array_rand(array_splice($numbers, 1), $limit);
        return $numbers;
    }

    public function setPublishAttribute($value){
        $this->attributes['publish'] = $value?: false;
    }

    public function setActiveAttribute($value){
        $this->attributes['active'] = $value?: false;
    }

    public function setSlugAttribute($value){
        $this->attributes['slug'] = $value? str_slug($value) : str_slug($this->attributes['title']);
    }
}
