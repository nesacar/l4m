<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = ['name', 'order', 'desc', 'publish'];

    public function order(){
        return $this->hasMany(Order::class);
    }
}
