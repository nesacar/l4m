<?php

namespace App\Providers;

use App\MenuLink;
use App\Setting;
use App\ShoppingCartOld;
use App\Theme;
use Illuminate\Support\ServiceProvider;
use Session;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->composerMenuTop();
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    private function composerMenuTop(){
        $theme = Theme::getTheme();
        $settings = Setting::first();
//        $menu = MenuLink::getMenu();
//        view()->composer('themes.'.$theme.'.partials.header', function($view) use ($menu){
//            $view->with('menu', $menu);
//        });
        view()->composer('themes.'.$theme.'.*', function($view) use ($theme,$settings){
            $view->with('theme', $theme)->with('settings', $settings);
        });
//        view()->composer('themes.'.$theme.'.partials.mobile-nav', function($view) use ($menu){
//            $view->with('menu', $menu);
//        });
    }
}
