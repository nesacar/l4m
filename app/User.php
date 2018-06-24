<?php

namespace App;

use App\Traits\UploudableImageTrait;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use File;
use Illuminate\Database\Eloquent\Builder;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable, UploudableImageTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password', 'role_id', 'image', 'block'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public function isAdmin(){
        return auth()->check() && auth()->user()->role_id >= 2? true : false;
    }

    public function product(){
        return $this->hasMany(Product::class);
    }

    public function post(){
        return $this->hasMany(Post::class);
    }

    public function customer(){
        return $this->hasOne(Customer::class);
    }

    public function client(){
        return $this->belongsToMany(Client::class);
    }
}
