<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MenuLink extends Model
{
    protected $table = 'menu_links';

    protected $fillable = ['menu_id', 'title', 'link', 'desc', 'sufix', 'type', 'order', 'parent', 'level', 'publish'];

    public function attributes($att_ids){
        if(count($att_ids)){
            $sufix = '?';
            foreach ($att_ids as $key => $id){
                $sufix .= 'filter[]=' . $id;
                if($key < count($att_ids) - 1){
                    $sufix .= '&';
                }
            }
            $this->update(['sufix' => $sufix]);
        }else{
            $this->update(['sufix' => null]);
        }
    }

    public function setPublishAttribute($value){
        $this->attributes['publish'] = $value?: false;
    }

    public function setLevelAttribute($value){
        $this->attributes['level'] = $this->attributes['parent'] == 0? 1 : 2;
    }

    public static function tree($menu_id) {
        return static::where('menu_id', $menu_id)->with(implode('.', array_fill(0, 1, 'children')))
            ->where('parent', 0)->orderBy('order', 'ASC')->get();
    }

    public function parent_menu() {
        return $this->hasOne(MenuLink::class, 'id', 'parent');
    }

    public function children() {
        return $this->hasMany(MenuLink::class, 'parent', 'id');
    }

    public function menu(){
        return $this->belongsTo(Menu::class);
    }

    public function attribute(){
        return $this->belongsToMany(Attribute::class);
    }
}
