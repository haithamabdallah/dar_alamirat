<?php

namespace App\Services;

use App\Jobs\SendManyEmails;
use App\Mail\SendNewsletterMail;
use Illuminate\Support\Facades\Mail;
use Modules\Subscription\Models\Subscriber;

class NewsletterService
{
    public function sendNewsletter(/* $sender, */ $subject, $content)
    {
        $details = [
            // 'sender' => $sender,
            'subject' => $subject,
            'content' => $content
        ];

        // Fetch all subscribers
        Subscriber::where('status', 1)->chunk(40, function ($recipients) use ($details) {
            SendManyEmails::dispatch($recipients, $details);
        });

    }
}
