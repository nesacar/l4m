<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use File;
use Illuminate\Http\Request;

class BrandImage extends Model
{
    protected $fillable = ['brand_id', 'file_name', 'file_path', 'publish'];

    protected $appends = ['tmb'];

    public function brand(){
        return $this->belongsTo(Brand::class);
    }

    public function getTmbAttribute(){
        return \Imagecache::get($this->file_path, '100x43')->src;
    }
}
