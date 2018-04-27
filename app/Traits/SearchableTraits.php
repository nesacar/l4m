<?php

namespace App\Traits;

use Illuminate\Http\Request;

trait SearchableTraits
{
    protected static $searchable = ['filters'];

    protected static function search(){
        $array = [];
        foreach(request()->all() as $key => $attribute){
            if(in_array($key, self::$searchable)){
                $array[] = $attribute;
            }
        }
        return $array;
    }
}