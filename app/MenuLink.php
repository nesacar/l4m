<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MenuLink extends Model
{
    protected $table = 'menu_links';

    protected $fillable = ['id', 'menu_id', 'title', 'link', 'desc', 'sufix', 'type', 'order', 'parent', 'level', 'publish'];

    public function menu(){
        return $this->belongsTo(Menu::class);
    }
}
