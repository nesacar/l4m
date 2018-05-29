<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    protected $table = 'settings';

    protected $fillable = [
        'title', 'address', 'keywords', 'desc', 'footer', 'phone1', 'phone2', 'email1', 'email2', 'facebook', 'twitter', 'instagram',
        'pinterest', 'google', 'youtube', 'analytics', 'map', 'primary'
    ];

    public static function get(){
        return Cache::remember('settings', 2, function () {
            return self::find(1);
        });
    }
}
