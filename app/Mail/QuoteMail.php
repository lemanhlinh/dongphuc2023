<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class QuoteMail extends Mailable
{
    use Queueable, SerializesModels;
    protected $data;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $value = $this->data;
        return $this->view('web.components.mail.quote')
            ->subject('Email nhận báo giá từ sdt '.$value->input('phone_contact').' - '.env('APP_NAME'))
            ->with(['data' => $this->data]);
    }
}
