<?php

namespace App;

use App\Traits\UploudableImageTrait;
use Illuminate\Database\Eloquent\Model;
use File;

class Box extends Model
{
    use UploudableImageTrait;

    protected $fillable = ['category_id', 'block_id', 'title', 'subtitle', 'button', 'link', 'image', 'small_image', 'order', 'publish'];

    public function block(){
        return $this->belongsTo(Block::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }
}
