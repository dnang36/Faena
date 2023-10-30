<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderShipped extends Mailable
{
    use Queueable, SerializesModels;

    protected $carts;
    protected $customer;
    protected $products;

    public function __construct($carts, $customer, $products)
    {
        $this->carts = $carts;
        $this->customer = $customer;
        $this->products = $products;
    }

    public function build()
    {
        return $this->view('admin.mail.order', [
            'carts' => $this->carts,
            'customer' => $this->customer,
            'products' => $this->products
        ]);
    }
}
