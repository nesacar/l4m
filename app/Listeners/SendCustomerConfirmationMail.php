<?php

namespace App\Listeners;

use App\Events\CustomerRegisteredEvent;
use App\Mail\CustomerConfirmationLinkMail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendCustomerConfirmationMail
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  CustomerRegisteredEvent  $event
     * @return void
     */
    public function handle(CustomerRegisteredEvent $event)
    {
        \Mail::to($event->customer->user->email)->send(new CustomerConfirmationLinkMail($event->customer->user));
    }
}
