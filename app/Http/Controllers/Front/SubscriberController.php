<?php

namespace App\Http\Controllers\Front;


use Illuminate\Support\Str;
use App\Mail\NewsletterMail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\ConfirmSubscribe;
use Illuminate\Support\Facades\Mail;
use Modules\Subscription\Models\Subscriber;

class SubscriberController extends Controller
{
    //
    public function subscribe(Request $request)
    {
        // Validate the request
        $request->validate([
            'email' => 'required|email|max:255',
        ]);

        // Check if the email is already subscribed
        $existingSubscriber = Subscriber::where('email', $request->email)->first();

        if ($existingSubscriber && $existingSubscriber->status == true) {
            return redirect()->back()->withInput()->withErrors(['email' => 'You are already subscribed.']);
        }

        if (!$existingSubscriber) {
            // Create subscriber model and save to database
            $subscriber = new Subscriber;
            $subscriber->email = $request->email;
            $subscriber->save();
            $existingSubscriber = $subscriber;
        }

        if ( $existingSubscriber && $existingSubscriber->status == false) {
            // send email to confirm 
            $existingSubscriber->token = strtolower(Str::random(16));
            $existingSubscriber->save();
            $url = route('subscriber.confirm', ['subscriber' => $existingSubscriber->id , 'token' => $existingSubscriber->token]);
            Mail::to($existingSubscriber->email)->send(new ConfirmSubscribe($url));

            return redirect()->back()->with([
                'success' => 'Confirmation Email Sent!'
            ]);
        }

        return redirect()->back()->with([
            'success' => 'Done Successfully!'
        ]);
    }

    public function confirmed(Request $request , Subscriber $subscriber , string $token)
    {
        if ($subscriber->token == $token) 
        {
            $subscriber->status = true;
            $subscriber->save();

            // Prepare data for the email
            $data = [
                'header_title' => 'Welcome to Our Newsletter',
                'intro_text' => 'Thank you for subscribing to our newsletter!',
                'main_message' => 'We are excited to have you on board. Stay tuned for the latest updates and news.',
                'closing_text' => 'If you have any questions, feel free to reach out to us. We are here to help!'
            ];
            // Send welcome email
            Mail::to($subscriber->email)->send(new NewsletterMail($data));

            return redirect('/')->with([
                'success' => 'Done Successfully!'
            ]);
        }
    }

    public function unsubscribe(Request $request , Subscriber $subscriber , string $token)
    {
        if ($subscriber->token == $token &&  $subscriber->status = true) 
        {
            $subscriber->status = false;
            $subscriber->save();

            return redirect('/')->with([
                'success' => 'Done Successfully!'
            ]);
        } else {
            return redirect('/')->with([
                'success' => 'This mail is not subscribed!'
            ]);
        }
    }
}
