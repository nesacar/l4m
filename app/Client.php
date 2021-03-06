<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use File;
use App\Traits\UploudableImageTrait;

class Client extends Model
{
    use UploudableImageTrait;

    protected $fillable = ['user_id', 'title', 'slug', 'fullName', 'short', 'body', 'image', 'cover', 'order', 'publish'];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot(){
        parent::boot();

//        static::created(function ($client){
//            $admins = User::where('role_id', '>=', 2)->get();
//            if(count($admins)>0){
//                foreach ($admins as $admin){
//                    $admin->client()->attach($client->id);
//                }
//            }
//        });

        static::deleting(function ($client) {
            if($client->image) File::delete($client->image);
            if($client->cover) File::delete($client->cover);
        });
    }

    public static function getClientId(){
        return auth()->user()->isAdmin()? 1 : auth()->user()->client()->first()->id;
    }

    public function setPublishAttribute($value){
        $this->attributes['publish'] = $value?: false;
    }

    public function setSlugAttribute($value){
        $this->attributes['slug'] = $value? str_slug($value) : str_slug($this->attributes['title']);
    }

    public function getBreadcrumb(){
        $str = '<nav aria-label="breadcrumb"><ol class="breadcrumb"><li class="breadcrumb-item"><a href="'. url('/') . '">Home</a></li>';
        $str .= '<li class="breadcrumb-item active" aria-current="page">' . $this->title . '</li></ol></nav>';
        return $str;
    }

    public function user(){
        return $this->belongsToMany(User::class);
    }

    public function product(){
        return $this->hasMany(Product::class);
    }

    public function brand(){
        return $this->belongsToMany(Brand::class);
    }

    public function post(){
        return $this->hasMany(Post::class);
    }

    public function category(){
        return $this->belongsToMany(Category::class);
    }

    public function clientBar(){
        return $this->hasMany(ClientBar::class);
    }
}
