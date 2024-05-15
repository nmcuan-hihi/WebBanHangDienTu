<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InvoiceMail extends Mailable
{
    use Queueable, SerializesModels;

    public $invoiceData;

    public function __construct($invoiceData)
    {
        $this->invoiceData = $invoiceData;
    }

    public function build()
    {
        return $this->view('emails.invoice')
                    ->subject('Hóa đơn của bạn')
                    ->with(['invoiceData' => $this->invoiceData]);
    }
}

