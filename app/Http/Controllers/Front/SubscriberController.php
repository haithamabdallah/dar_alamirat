<?php

namespace App\Http\Controllers\Front;

use App\Mail\NewsletterMail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Modules\Subscription\Models\Subscriber;

class SubscriberController extends Controller
{
    //
    public function subscribe(Request $request)
    {
        // Validate the request
        $request->validate([
            'email' => 'required|email',
        ]);

        // Check if the email is already subscribed
        $existingSubscriber = Subscriber::where('email', $request->email)->first();
        if ($existingSubscriber) {
            return redirect()->back()->with([
                'title' => 'Already Subscribed',
                'message' => 'You are already subscribed.',
                'icon' => 'info'
            ]);
        }

        // Create subscriber model and save to database
        $subscriber = new Subscriber;
        $subscriber->email = $request->email;
        $subscriber->save();

        // Send welcome email
        Mail::to($request->email)->send(new NewsletterMail());

        return redirect()->back()->with([
            'title' => 'Subscription Successful',
            'message' => 'Thank you for subscribing!',
            'icon' => 'success'
        ]);
    }

}
