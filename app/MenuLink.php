<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use File;

class MenuLink extends Model
{
    protected $table = 'menu_links';

    protected $fillable = ['menu_id', 'image', 'title', 'link', 'desc', 'sufix', 'type', 'order', 'parent', 'level', 'publish'];

    public static function base64UploadImage($link_id, $image){
        $link = self::find($link_id);
        if($link->image != null){
            File::delete($link->image);
        }
        $exploaded = explode(',', $image);
        $data = base64_decode($exploaded[1]);
        $filename = str_slug($link->title) . '-' . str_random(2) . '-' . $link->id . '.' . self::getExtension($image);
        $path = Helper::generateImageFolder('uploads/links/');
        file_put_contents($path['fullFolderPath'] . '/' . $filename, $data);
        $link->image = 'storage/uploads/links/' . $path['folder'] . '/' . $filename;
        $link->update();
        return $link->image;
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

    public function attributes($att_ids){
        if(count($att_ids)){
            $sufix = '?';
            foreach ($att_ids as $key => $id){
                $sufix .= 'filters[]=' . $id;
                if($key < count($att_ids) - 1){
                    $sufix .= '&';
                }
            }
            $this->update(['sufix' => $sufix]);
        }else{
            $this->update(['sufix' => null]);
        }
    }

    public static function orderMenuLinks($links, $parent = 0, $level = 1, $order = 0){
        if(count($links)>0){
            foreach ($links as $link){
                $old = self::find($link['id']);
                if(!empty($old) && ($old->parent != $parent || $old->order != ++$order || $old->level != $level)){
                    $old->update(['parent' => $parent, 'order' => $order, 'level' => $level]);
                }
                if(!empty($link['children'])){
                    self::orderMenuLinks($link['children'], $link['id'], $level+1);
                }
            }
        }
    }

    public function setPublishAttribute($value){
        $this->attributes['publish'] = $value?: false;
    }

    public static function tree($menu_id) {
        return static::where('menu_id', $menu_id)->with(implode('.', array_fill(0, 1, 'children')))
            ->where('parent', 0)->orderBy('order', 'ASC')->get();
    }

    public function parent_menu() {
        return $this->hasOne(MenuLink::class, 'id', 'parent');
    }

    public function children() {
        return $this->hasMany(MenuLink::class, 'parent', 'id')->orderBy('order', 'ASC');
    }

    public function menu(){
        return $this->belongsTo(Menu::class);
    }

    public function attribute(){
        return $this->belongsToMany(Attribute::class);
    }
}
