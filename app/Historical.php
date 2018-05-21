<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Historical extends Model
{
    protected $fillable = ['currency_id', 'date', 'exchange_rate'];
}
