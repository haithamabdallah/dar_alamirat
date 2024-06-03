<?php

namespace App\Services;
use App\Mail\SendNewsletterMail;
use Illuminate\Support\Facades\Mail;
use Modules\Subscription\Models\Subscriber;

class NewsletterService
{
    public function sendNewsletter($sender, $subject, $content)
    {
        $details = [
            'sender' => $sender,
            'subject' => $subject,
            'content' => $content
        ];

        // Fetch all subscribers
        $recipients = Subscriber::pluck('email')->toArray();

        foreach ($recipients as $recipient) {
            Mail::to($recipient)->send(new SendNewsletterMail($details['sender'], $details['subject'], $details['content']));
        }
    }
}
