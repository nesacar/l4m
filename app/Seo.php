<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use SEOMeta;
use OpenGraph;

class Seo extends Model
{
    /**
     * SEO for Home page
     */

    public static function home($setting){
        SEOMeta::setTitle('Home');
        SEOMeta::setDescription($setting->desc);
        SEOMeta::setCanonical(url('/'));
        SEOMeta::addKeyword($setting->keywords);

        OpenGraph::addImage(url('themes/' . env('APP_THEME', '') . '/img/l4m-social-share.jpg'), ['height' => 1200, 'width' => 630]);
        OpenGraph::addProperty('locale', 'sr');
        OpenGraph::addProperty('type', 'articles');
        OpenGraph::setTitle('Home');
        OpenGraph::setDescription($setting->desc);
        OpenGraph::setUrl(url('/'));
        OpenGraph::setSiteName('Luksuzni online shop');
    }

    /**
     * Seo for blog page
     */
    public static function blog($setting){
        SEOMeta::setTitle('Blog');
        SEOMeta::setDescription($setting->desc);
        SEOMeta::setCanonical(url('blog'));
        SEOMeta::addKeyword($setting->keywords);

        OpenGraph::addImage(url('themes/' . env('APP_THEME', '') . '/img/l4m-social-share.jpg'), ['height' => 1200, 'width' => 630]);
        OpenGraph::addProperty('locale', 'sr');
        OpenGraph::addProperty('type', 'articles');
        OpenGraph::setTitle('Blog');
        OpenGraph::setDescription($setting->desc);
        OpenGraph::setUrl(url('blog'));
        OpenGraph::setSiteName('Luksuzni online shop');
    }

    /**
     * Seo for blog category page
     */
    public static function blogCategory($setting, $blog){
        SEOMeta::setTitle('Blog - ' . $blog->title);
        SEOMeta::setDescription($setting->desc);
        SEOMeta::setCanonical(url('blog/' . $blog->slug));
        SEOMeta::addKeyword($setting->keywords);

        OpenGraph::addImage(url('themes/' . env('APP_THEME', '') . '/img/l4m-social-share.jpg'), ['height' => 1200, 'width' => 630]);
        OpenGraph::addProperty('locale', 'sr');
        OpenGraph::addProperty('type', 'articles');
        OpenGraph::setTitle('Blog - ' . $blog->title);
        OpenGraph::setDescription($setting->desc);
        OpenGraph::setUrl(url('blog/' . $blog->slug));
        OpenGraph::setSiteName('Luksuzni online shop');
    }

    /**
     * SEO for blog post page
     */
    public static function blogPost($post)
    {
        SEOMeta::setTitle('Blog - ' . $post->title);
        SEOMeta::setDescription($post->short);
        SEOMeta::setCanonical($post->getLink());
        SEOMeta::addKeyword($post->tag->pluck('title'));

        OpenGraph::addImage(url($post->image), ['height' => 630, 'width' => 420]);
        OpenGraph::addProperty('locale', 'sr');
        OpenGraph::addProperty('type', 'article');
        OpenGraph::setTitle('Blog - ' . $post->title);
        OpenGraph::setDescription($post->short);
        OpenGraph::setUrl($post->getLink());
        OpenGraph::setSiteName('Luksuzni online shop');
    }

    /**
     * SEO for shop category page
     */
    public static function shopCategory($category)
    {
        SEOMeta::setTitle('Shop - ' . $category->seoTitle);
        SEOMeta::setDescription($category->seoShort);
        SEOMeta::setCanonical($category->getLink());
        SEOMeta::addKeyword($category->seoKeywords);

        OpenGraph::addImage(url('themes/' . env('APP_THEME', '') . '/img/l4m-social-share.jpg'), ['height' => 1200, 'width' => 630]);
        OpenGraph::addProperty('locale', 'sr');
        OpenGraph::addProperty('type', 'article');
        OpenGraph::setTitle('Shop - ' . $category->seoTitle);
        OpenGraph::setDescription($category->seoShort);
        OpenGraph::setUrl($category->getLink());
        OpenGraph::setSiteName('Luksuzni online shop');
    }

    /**
     * SEO for shop category page
     */
    public static function shopProduct($product, $category)
    {
        SEOMeta::setTitle($product->title);
        SEOMeta::setDescription($product->short);
        SEOMeta::setCanonical($product->getLink($category));
        SEOMeta::addKeyword($product->tag->pluck('title'));

        OpenGraph::addImage(url($product->image), ['height' => 1200, 'width' => 1600]);
        OpenGraph::addProperty('locale', 'sr');
        OpenGraph::addProperty('type', 'article');
        OpenGraph::setTitle($product->title);
        OpenGraph::setDescription($product->short);
        OpenGraph::setUrl($product->getLink($category));
        OpenGraph::setSiteName('Luksuzni online shop');
    }
}
