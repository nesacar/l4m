<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    protected $fillable = ['email', 'name', 'verification', 'block'];

    public function setVerificationAttribute($value){
        $this->attributes['verification'] = $this->attributes['verification']? $this->attributes['verification'] : str_random(32);
    }

    public function setBlockAttribute($value){
        $this->attributes['block'] = $value?: false;
    }
}
