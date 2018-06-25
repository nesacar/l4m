<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
      $components = 'themes.' . env('THEME_NAME', '') . '.components.';
      $partials = 'themes.' . env('THEME_NAME', '') . '.partials.';

      Blade::component($components . 'address', 'address');
      Blade::component($components . 'select', 'select');
      Blade::component($components . 'select-box', 'selectbox');
      Blade::component($components . 'color', 'color');
      Blade::component($components . 'size', 'size');
      Blade::component($components . 'checkbox', 'checkbox');
      Blade::component($components . 'radio', 'radio');
      Blade::component($components . 'counter', 'counter');
      Blade::component($components . 'double-slider', 'doubleslider');
      Blade::component($components . 'image-box', 'imagebox');
      Blade::component($components . 'search-widget', 'search');
      Blade::component($components . 'text-field', 'textfield');
      Blade::component($components . 'drawer', 'drawer');
      Blade::component($components . 'stepper', 'stepper');
      Blade::component($components . 'zoomer', 'zoomer');
      Blade::component($components . 'filter', 'filter');

      // carousel stuff.
      Blade::component($components . 'carousel-controls', 'carouselcontrols');
      Blade::component($components . 'homepage-carousel', 'homepagecarousel');

      Blade::component($components . 'cart.entry', 'cartentry');
      Blade::component($components . 'cart.item', 'cartitem');

      Blade::component($components . 'accordion', 'accordion');

      Blade::component($components . 'currency', 'currency');

      Blade::include($partials . 'social', 'social');
    }
}
