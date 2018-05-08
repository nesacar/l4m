<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = ['user_id', 'name', 'lastname', 'phone', 'email', 'company', 'address', 'town', 'state', 'country', 'postcode', 'block'];

    public static function createCustomer(){
        $user = new User();
        $user->email = request('email');
        $user->password = bcrypt(request('password'));
        $user->role = 0;
        $user->active = 0;
        $user->block = 0;
        $user->save();

        $user->customer()->create(request()->all());
        return $user;
    }

    public function user(){
        return $this->hasOne(User::class);
    }
}
