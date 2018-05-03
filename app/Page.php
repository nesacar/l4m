<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use SEO;

class Page extends Model
{
    public static function home(){
        SEO::setTitle('Home');
    }
}
