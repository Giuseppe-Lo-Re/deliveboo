<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewOrderCustomerMail extends Mailable
{
    use Queueable, SerializesModels;

    private $new_order;
    private $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($_new_order, $_user)
    {
        $this->new_order = $_new_order;
        $this->user = $_user;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()

    {
        $data = [
            'new_order' => $this->new_order,
            'user' => $this->user
        ];

        return $this->view('mails.new-order-customer-mail', $data);
    }
}
