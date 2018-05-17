<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use File;

class Gallery extends Model
{
    protected $fillable = ['post_id', 'file_name', 'file_path', 'publish'];

    protected $appends = ['tmb'];

    public function getTmbAttribute(){
        return \Imagecache::get($this->attributes['file_path'], '120x90')->src;
    }

    public function post(){
        return $this->belongsTo(Post::class);
    }
}
