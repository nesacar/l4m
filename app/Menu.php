<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menus';

    protected $fillable = ['title', 'slug', 'prefix', 'sufix', 'class', 'publish'];

    public function menuLinks(){
        return $this->hasMany(MenuLink::class);
    }
}
