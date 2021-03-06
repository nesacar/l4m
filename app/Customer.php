<?php

namespace App;

use function Couchbase\passthruDecoder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Customer extends Model
{
    protected $fillable = ['user_id', 'activation', 'active'];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('user', function (Builder $builder) {
            $builder->with('user');
        });

//        static::addGlobalScope('address', function (Builder $builder) {
//            $builder->with('address');
//        });

        static::deleting(function($customer){
            $customer->user->delete();
            $customer->shoppingCart->each(function($cart){
               $cart->delete();
            });
        });
    }

    public static function checkCustomer($user){
        if(empty($user->customer)){
            $customer = new Customer();
            $customer->user_id = $user->id;
            $customer->activation = str_random(32);
            $customer->save();
        }
        return self::where('user_id', $user->id)->first();
    }

    public static function createCustomer(){
        $user = new User();
        $user->name = request('name');
        $user->email = request('email');
        $user->password = bcrypt(request('password'));
        $user->role_id = 0;
        $user->save();

        $array = request()->all();
        $array['activation'] = str_random(32);

        return $user->customer()->create($array);
    }

    public static function updateCustomer($customer_id){
        $customer = self::find($customer_id);
        $user = User::find($customer->user_id);
        $user->name = request('name');
        $user->email = request('email');
        request('password')? $user->password = bcrypt(request('password')) : '';
        $user->update();

        $array = request()->all();
        $array['activation'] = str_random(32);

        $customer->update($array);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function address(){
        return $this->hasMany(Address::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function order(){
        return $this->hasMany(Order::class);
    }

    public function shoppingCart(){
        return $this->hasMany(ShoppingCart::class);
    }
}
