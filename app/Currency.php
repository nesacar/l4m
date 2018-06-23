<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    protected $fillable = ['name', 'code', 'symbol', 'format', 'decimals', 'exchange_rate', 'primary', 'publish'];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot(){
        parent::boot();

        static::created(function($currency){
            $currency->historical()->save(new Historical(['exchange_rate' => $currency->exchange_rate, 'date' => Carbon::now()->format('Y-m-d')]));
        });

        static::updated(function($currency){
            $currency->historical()->save(new Historical(['exchange_rate' => $currency->exchange_rate, 'date' => Carbon::now()->format('Y-m-d')]));
        });
    }

    public function setPublishAttribute($value){
        $this->attributes['publish'] = $value?: false;
    }

    public function setPrimaryAttribute($value){
        if($value){
            $all = $this->all();
            if(count($all)){
                foreach ($all as $item){
                    $item->update(['primary' => 0]);
                }
            }
            $this->attributes['primary'] = true;
        }else{
            $this->attributes['primary'] = false;
        }
    }

    public function historical(){
        return $this->hasMany(Historical::class);
    }
}
