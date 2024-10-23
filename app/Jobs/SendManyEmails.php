<?php

namespace App\Jobs;

use Illuminate\Support\Str;
use Illuminate\Bus\Queueable;
use App\Mail\SendNewsletterMail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendManyEmails implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(public $recipients, public $details)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        foreach ($this->recipients as $recipient) {
            if (!$recipient->token) {
                $recipient->token = strtolower(Str::random(16));
                $recipient->save();
            }
            $unsubscribeLink = route('unsubscribe', ['subscriber' => $recipient->id, 'token' => $recipient->token]);
            try {
                if ( $recipient->status != 0) {
                    Mail::to($recipient->email)->send(
                        new SendNewsletterMail(
                            /* $details['sender'], */
                            $this->details['subject'],
                            $this->details['content'],
                            $unsubscribeLink
                        ),
                    );
                }
            } catch (\Exception $e) {
                dd($e->getMessage());
            }
        }
    }
}
