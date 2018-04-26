<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

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
      Blade::component('themes.' . env('THEME_NAME', '') . '.components.select', 'select');
      Blade::component('themes.' . env('THEME_NAME', '') . '.components.checkbox');
      Blade::component('themes.' . env('THEME_NAME', '') . '.components.double-slider', 'doubleslider');
    }
}
