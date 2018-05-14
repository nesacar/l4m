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

      Blade::component($components . 'select', 'select');
      Blade::component($components . 'checkbox', 'checkbox');
      Blade::component($components . 'counter', 'counter');
      Blade::component($components . 'double-slider', 'doubleslider');
      Blade::component($components . 'image-box', 'imagebox');
      Blade::component($components . 'search-widget', 'search');
      Blade::component($components . 'drawer', 'drawer');

      Blade::component($components . 'cart.item', 'cartitem');
      Blade::component($components . 'cart.entry', 'cartentry');

      Blade::include($partials . 'social', 'social');
    }
}
