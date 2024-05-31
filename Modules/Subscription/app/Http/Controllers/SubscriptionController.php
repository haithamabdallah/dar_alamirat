<?php

namespace Modules\Subscription\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Mail\SendNewsletterMail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\RedirectResponse;
use Modules\Subscription\Models\Subscriber;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subscribers=Subscriber::get();
        return view('dashboard.subscriptions.index',compact('subscribers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.subscriptions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        //
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('subscription::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('subscription::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
    public function sendNewsletter(Request $request)
    {
        // Validate the request
        $request->validate([
            'content' => 'required',
        ]);

        // Get all users
        $subscribers = Subscriber::all();

        // Send newsletter to each user
        foreach ($subscribers as $subscriber) {
            Mail::to($subscriber->email)->send(new SendNewsletterMail($request->content));
        }

        return redirect()->route('subscription.index')->with('success', __('dashboard.newsletter_sent_successfully'));
    }
}
