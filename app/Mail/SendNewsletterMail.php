<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendNewsletterMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $content;

    /**
     * Create a new message instance.
     *
     * @param  string  $content
     * @return void
     */
    public function __construct($content)
    {
        $this->content = $content;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('newsletter@daaralamirat.com', config('app.name'))
        ->subject('Nor replay: Newsletters')
         ->view('emails.sendnewsletter')
         ->with($this->content);
    }
}
