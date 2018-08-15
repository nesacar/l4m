<?php

namespace App\Events;

use App\ShopBar;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ShopBarCreatedUpdated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var ShopBar
     */
    public $shopBar;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(ShopBar $shopBar)
    {
        $this->shopBar = $shopBar;
    }
}
