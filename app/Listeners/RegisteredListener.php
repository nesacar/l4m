<?php

namespace App\Listeners;

use App\Customer;
use App\Events\CustomerRegisteredEvent;
use App\Events\Registered;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class RegisteredListener
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
     * @param  Registered  $event
     * @return void
     */
    public function handle(Registered $event)
    {
        $customer = Customer::checkCustomer($event->user);

        event(new CustomerRegisteredEvent($customer));
    }
}
