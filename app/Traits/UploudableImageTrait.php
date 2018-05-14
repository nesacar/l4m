<?php

namespace App\Traits;

use Carbon\Carbon;
use Illuminate\Http\Request;
use File;
use Illuminate\Support\Str;

trait UploudableImageTrait{

    protected $folder = 'uploads/';

    public function storeImage( $fieldName = 'image', $attributeName = 'image') {
        if( $image = request()->file($fieldName)) {
            if($this->$attributeName) File::delete($this->$attributeName);
            $className = (new \ReflectionClass($this))->getShortName();
            return 'storage/' . request()->file($fieldName)->storeAs(
                $this->getFolderName($this->folder . Str::lower(str_plural($className, 2)) . '/'),
                $this->getFileName($image),
                'public'
                );
        }
        return $this->image;
    }

    protected function getFolderName($path){
        $temp = Carbon::now()->format('m-Y');
        $folderPath = $path . $temp;
        $fullFolderPath = storage_path('app/public/' . $path . $temp);
        if(!File::exists($fullFolderPath)) {
            File::makeDirectory($fullFolderPath, 0775, true, true);
        }
        return $folderPath;
    }

    protected function getFileName($image){
        $res = '';
        if(isset($this->title)) {
            $res .= str_slug($this->title) . '-';
        }elseif(isset($this->name)){
            $res .= str_slug($this->name) . '-';
        }
        return $res . $this->id . '-' . str_random(2) . '.' .  $image->getClientOriginalExtension();
    }

}