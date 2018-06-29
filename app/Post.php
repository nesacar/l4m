<?php

namespace App;

use App\Traits\UploudableImageTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use File;
Use Carbon\Carbon;

class Post extends Model
{
    use UploudableImageTrait;

    protected $fillable = ['user_id', 'client_id', 'blog_id', 'brand_id', 'title', 'slug', 'short', 'body', 'views', 'image', 'publish_at', 'slider', 'publish'];

    protected $appends = ['date', 'time', 'link'];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('blog', function (Builder $builder) {
            $builder->with(['blog' => function($query){
                $query->where('publish', 1)->orderBy('parent', 'ASC');
            }]);
        });

        static::deleting(function ($post) {
            if($post->image) File::delete($post->image);
            if($post->slider) File::delete($post->slider);
        });
    }

    public function getBreadcrumb(){
        $str = '<nav aria-label="breadcrumb"><ol class="breadcrumb"><li class="breadcrumb-item"><a href="'. url('/') . '">Home</a></li><li class="breadcrumb-item"><a href="'. url('blog') . '">Blog</a></li>';

        if(!empty($this->parent)){
            $str .= '<li class="breadcrumb-item"><a href="' . $this->parent->slug . '">' . $this->parent->title . '</a></li>';
        }

        $str .= '<li class="breadcrumb-item active" aria-current="page">' . $this->title . '</li></ol></nav>';

        return $str;
    }

    public function getRelatedProducts($limit = 6){
        if(count($this->product) > 0){
            return $this->product()->take($limit)->get();
        }else{
            if($this->brand_id != null){
                return Brand::find($this->brand_id)->product()->withoutGlobalScope('attribute')->where('products.publish', 1)->inRandomOrder()->take($limit)->get();
            }elseif($category = Category::whereTitle($this->blog->title)->first()){
                return $category->product()->withoutGlobalScope('attribute')->where('products.publish', 1)->inRandomOrder()->take($limit)->get();
            }
        }
    }

    public static function getSlider($limit = 3){
        return self::with('blog')->where('slider', '<>', null)->published()->take($limit)->get();
    }

    public static function getLatest($category = false, $exclude = false, $limit = 8){
        if($category){
            return $category->post()->where(function($query) use ($exclude){
                if($exclude){
                    $query->where('posts.id', '<>', $exclude->id);
                }
            })->where('blog_id', '<>', 6)->published()->paginate($limit);
        }else{
            return self::where(function($query) use ($exclude){
                if($exclude){
                    $query->where('posts.id', '<>', $exclude->id);
                }
            })->where('blog_id', '<>', 6)->published()->paginate($limit);
        }
    }

    public static function getMostView($category = false, $exclude = false, $limit = 4){
        if($category){
            return $category->post()->where(function($query) use ($exclude){
                if($exclude){
                    $query->where('posts.id', '<>', $exclude->id);
                }
            })->published()->orderBy('views', 'DESC')->take($limit)->get();
        }else{
            return self::where(function($query) use ($exclude){
                if($exclude){
                    $query->where('posts.id', '<>', $exclude->id);
                }
            })->published()->orderBy('views', 'DESC')->take($limit)->get();
        }
    }

    public static function getHomePosts($slug = false, $limit = 3){
        if($slug){
            $blog = Blog::whereSlug($slug)->first();
            if(!empty($blog)){
                return $blog->post()->where('blog_id', '<>', 6)->published()->limit($limit)->get();
            }
            return [];
        }else{
            return self::where('blog_id', '<>', 6)->published()->limit($limit)->get();
        }
    }

    public function scopePublished($query){
        $query->where('posts.publish_at', '<=', Carbon::now()->format('Y-m-d H:00'))->where('posts.publish', 1)->orderBy('posts.publish_at', 'DESC');
    }

    public function getLink(){
        if($this->blog){
            return url('blog/' . $this->blog->slug . '/' . $this->slug . '/' . $this->id);
        }else{
            return '#';
        }
    }

    public function setSlugAttribute($value){
        $this->attributes['slug'] = $value? str_slug($value) : str_slug($this->attributes['title']);
    }

    public function setPublishAttribute($value){
        $this->attributes['publish'] = $value?: false;
    }

    public function setPublishAtAttribute($value){
        $this->attributes['publish_at'] = Carbon::parse($value)->format('Y-m-d H:00:00');
    }

    public function getDateAttribute(){
        return Carbon::parse($this->attributes['publish_at'])->format('Y-m-d');
    }

    public function getTimeAttribute(){
        return Carbon::parse($this->attributes['publish_at'])->format('H:00:00');
    }

    public function getLinkAttribute(){
        return $this->getLink();
    }

    public function blog(){
        return $this->belongsTo(Blog::class);
    }

    public function tag(){
        return $this->belongsToMany(Tag::class);
    }

    public function gallery(){
        return $this->hasMany(Gallery::class);
    }

    public function product(){
        return $this->belongsToMany(Product::class);
    }

    public function brand(){
        return $this->belongsTo(Brand::class);
    }

    public function client(){
        return $this->belongsTo(Client::class);
    }
}
