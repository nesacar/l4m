<?php

namespace App;

use function Couchbase\passthruDecoder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Customer extends Model
{
    protected $fillable = ['user_id', 'active'];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('user', function (Builder $builder) {
            $builder->with('user');
        });

        static::addGlobalScope('address', function (Builder $builder) {
            $builder->with('address');
        });

        static::deleting(function($customer){
            $customer->user->delete();
        });
    }

    public static function checkCustomer(){
        if(empty(auth()->user()->customer)){
            $customer = new Customer();
            $customer->user_id = auth()->id();
            $customer->save();
        }
        return self::where('user_id', auth()->id())->first();
    }

    public static function createCustomer(){
        $user = new User();
        $user->name = request('name');
        $user->email = request('email');
        $user->password = bcrypt(request('password'));
        $user->role_id = 0;
        $user->active = 0;
        $user->save();

        return $user->customer()->create(request()->all());
    }

    public static function updateCustomer($customer_id){
        $customer = self::find($customer_id);
        $user = User::find($customer->user_id);
        $user->name = request('name');
        $user->email = request('email');
        request('password')? $user->password = bcrypt(request('password')) : '';
        $user->active = request('active');
        $user->update();

        $customer->update(request()->all());
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
}
