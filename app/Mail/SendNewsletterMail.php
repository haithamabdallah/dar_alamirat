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
    // public $sender;
    public $subject;
    public $content;
    public $unsubscribeLink;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(/* $sender, */ $subject, $content, $unsubscribeLink)
    {
        // $this->sender = $sender;
        $this->subject = $subject;
        $this->content = $content;
        $this->unsubscribeLink = $unsubscribeLink;

    }

    /**
     * Build the message.
     *
     * @return $this
     */

    public function build()
    {
        return $this
                    // ->from($this->sender, config('app.name'))
                    ->subject($this->subject)
                    ->view('emails.sendnewsletter')
                    ->with($this->content);
    }
}
