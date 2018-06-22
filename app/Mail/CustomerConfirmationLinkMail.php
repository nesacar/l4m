<?php

namespace App\Mail;

use App\Customer;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CustomerConfirmationLinkMail extends Mailable
{
    use Queueable, SerializesModels;
    /**
     * @var Customer
     */
    public $customer;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Customer $customer)
    {
        $this->customer = $customer;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('themes.l4m.emails.customer.confirmationLink')
            ->with('customer', $this->customer)
            ->subject('Potvrda registracije na sajtu Luxury4.me')
            ->from('luxury4me@mia.rs', 'Luxury4.me online shop');
    }
}
