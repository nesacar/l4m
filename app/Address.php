<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = ['customer_id', 'name', 'phone', 'address', 'town', 'country', 'postcode', 'publish'];

    public function customer(){
        return $this->belongsTo(Customer::class);
    }
}
