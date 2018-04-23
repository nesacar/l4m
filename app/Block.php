<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    protected $fillable = ['title', 'desc', 'publish'];

    public function box(){
        return $this->hasMany(Box::class);
    }
}
