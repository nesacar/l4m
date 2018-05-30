<?php

namespace App;

use App\Traits\UploudableImageTrait;
use Illuminate\Database\Eloquent\Model;
use File;
use Illuminate\Support\Facades\Cache;

class MenuLink extends Model
{
    use UploudableImageTrait;

    protected $table = 'menu_links';

    protected $fillable = ['menu_id', 'image', 'title', 'link', 'desc', 'sufix', 'type', 'order', 'parent', 'level', 'publish'];

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

    public static function getFirstChild($slug){
        $array = ['zene' => 2, 'muskarci' => 3, 'deca' => 4, 'living' => 5];
        return $currentId = self::where('menu_id', $array[$slug])->orderBy('order', 'ASC')->value('link');
    }

    public static function getMenu(){
        return Cache::remember('menu.'.\Session::get('primary'), Helper::getMinutesToTheNextHour(), function () {
            $menu = Menu::whereSlug(\Session::get('primary'))->first();
            return self::tree($menu->id);
        });
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
