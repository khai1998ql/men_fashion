<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InvoiceMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($dataEmail)
    {
        $this->dataEmail = $dataEmail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $info = $this->dataEmail;
        return $this->from('khainguyensi.14051998@gmail.com')->view('frontend.pages.mail.invoice', compact('info'))->subject('Đặt hàng thành công (ID: ' . $info['order_code'] . ')');
    }
}
