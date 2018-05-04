<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use File;

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
}
