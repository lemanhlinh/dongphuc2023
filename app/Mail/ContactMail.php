<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
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
        return $this->from($value['email'])
            ->view('web.components.mail.contact')
            ->subject('Email liên hệ từ '.$value['full_name'].' - '.env('APP_NAME'))
            ->with(['data' => $this->data]);
    }
}
