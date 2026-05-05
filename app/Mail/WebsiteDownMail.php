<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class WebsiteDownMail extends Mailable
{
    public $website;

    public function __construct($website)
    {
        $this->website = $website;
    }

    public function build()
    {
        return $this->from('do-not-reply@example.com')
            ->subject($this->website->url . ' is down!')
            ->view('emails.website-down');
    }
}
