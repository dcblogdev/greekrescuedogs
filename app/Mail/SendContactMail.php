<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendContactMail extends Mailable
{
    use Queueable, SerializesModels;

    public string $name = '';

    public string $email = '';

    public string $message = '';

    public function __construct($contact)
    {
        $this->name = $contact['name'];
        $this->email = $contact['email'];
        $this->message = $contact['message'];
    }

    public function build(): self
    {
        return $this->to('dave@dcblog.dev')
            ->from($this->email)
            ->replyTo($this->email)
            ->subject('Contact from '.config('app.name'))
            ->markdown('mail.contact');
    }
}
