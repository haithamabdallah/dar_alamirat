<?php

namespace App\Jobs;

use Illuminate\Support\Facades\Mail;
use App\Mail\NewNewsletter;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendNewsletterEmails implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public $subscribers,
        public $data
    )
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        foreach ($this->subscribers as $subscriber) {
            Mail::to($subscriber->email)->send(new NewNewsletter($this->data));
        }
    }
}
