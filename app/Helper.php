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
        $fullFolderPath = storage_path('app/public/' . $path . $temp);
        if(!File::exists($fullFolderPath)) {
            File::makeDirectory($fullFolderPath, 0775, true, true);
        }
        return ['folderPath' => $folderPath, 'folder' => $temp, 'fullFolderPath' => $fullFolderPath];
    }

    public static function activeLinkWithParams($link){
        return str_replace(request()->root() . '/', '', request()->fullUrl()) == $link? true: false;
    }

    public static function activeLink($link){
        return request()->path() == $link? true : false;
    }
}
