<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    protected $fillable = ['name', 'code', 'symbol', 'format', 'exchange_rate', 'active', 'primary', 'publish'];

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
}
