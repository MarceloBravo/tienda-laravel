<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailFinVenta extends Mailable
{
    use Queueable, SerializesModels;

    public $carrito;
    public $total;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($carrito, $total)
    {
        $this->carrito = $carrito;
        $this->total = $total;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.email_fin_venta');
    }
}
