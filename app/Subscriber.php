<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    protected $fillable = ['email', 'name', 'gender', 'verification', 'block'];

    public static function createSubscriber(){
        $array = request()->all();
        $array['verification'] = str_random(32);
        Subscriber::create($array);
    }

    public function setBlockAttribute($value){
        $this->attributes['block'] = $value?: false;
    }
}
