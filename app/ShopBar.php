<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class ShopBar extends Model
{
    protected $fillable = ['category_id', 'title', 'template', 'order', 'publish'];

    public function sync(){
        $this->product()->sync([]);

        $index = 0;
        if(count(request('prod_ids'))){
            foreach (request('prod_ids') as $id){
                $this->product()->attach($id, ['order' => ++$index]);
            }
        }
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function product(){
        return $this->belongsToMany(Product::class)->withPivot('order');
    }
}
