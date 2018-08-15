<?php

namespace App\Listeners;


use App\ShopBar;

class ShopBarProductEventSubscriber
{
    /**
     * Handle product create events.
     */
    public function onProductCreated($event)
    {
        $shopBar = new ShopBar();
        $shopBar->syncShopBarLatestProducts();
    }

    /**
     * Handle shop bar create events.
     */
    public function onShopBarCreatedEdited($event)
    {
        $shopBar = new ShopBar();
        $shopBar->syncShopBarLatestProducts();
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param  \Illuminate\Events\Dispatcher  $events
     */
    public function subscribe($events)
    {
        $events->listen(
            'App\Events\ProductCreated',
            'App\Listeners\ShopBarProductEventSubscriber@onProductCreated'
        );

        $events->listen(
            'App\Events\ShopBarCreatedUpdated',
            'App\Listeners\ShopBarProductEventSubscriber@onShopBarCreatedEdited'
        );
    }
}
