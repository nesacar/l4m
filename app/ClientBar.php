<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientBar extends Model
{
    protected $fillable = ['title', 'desc', 'link', 'order'];

    public function client(){
        return $this->belongsTo(Client::class);
    }
}
