<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use File;
use Session;

class Helper extends Model
{
    public static function generateImageFolder($path){
        $temp = Carbon::now()->format('m-Y');
        $folderPath = $path . $temp;
        if(!File::exists($folderPath)) {
            File::makeDirectory($folderPath, 0775, true, true);
        }
        return ['folderPath' => $folderPath, 'folder' => $temp];
    }

    public static function getSessionKey(){
        if(Session::has('key')){
            $sessionKey = Session::get('key');
        }else{
            $random = str_random(8);
            Session::put('key', $random);
            $sessionKey = Session::get('key');
        }
        return $sessionKey;
    }
}
