<?php

namespace Modules\Subscription\Http\Controllers;

use App\Mail\Marketing;
use App\Models\Setting;
use App\Mail\NewNewsletter;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Mail\SendNewsletterMail;
use App\Jobs\SendMarketingEmails;
use App\Jobs\SendNewsletterEmails;
use App\Services\NewsletterService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;
use Modules\Subscription\Models\Subscriber;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $newsletterService;
    public function __construct(NewsletterService $newsletterService)
    {
        $this->newsletterService = $newsletterService;

        $this->middleware('checkPermissions:Subscribers')->only(['index', 'show', 'create', 'store', 'edit', 'update', 'destroy']);
    }

    public function index()
    {
        // $subscribers= Subscriber::latest()->paginate(10);
        $subscribers = Subscriber::latest()->get();
        return view('dashboard.subscriptions.index', compact('subscribers'));
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

    public function sendNewsletterPage()
    {
        return view('dashboard.subscriptions.create-newsletter');
    }

    public function sendMarketingPage()
    {
        $currentSettings = Setting::where('type' , 'social_media')?->first()?->value ?? null;

        return view('dashboard.subscriptions.create-marketing' , compact('currentSettings'));
    }

    public function sendNewsletter(Request $request)
    {
        
        $request['is_for_test'] ??= 0;
        
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'data' => 'required|array',
            'data.subject' => 'required|string|max:255',
            'data.content' => 'required|string',
            'is_for_test' => 'required|in:0,1',
            'test_email' => 'nullable|required_if:is_for_test,1|email|max:255',
        ]);
        
        if ( $validator->fails() ) {
            if ( $request['is_for_test'] == 1 ) {
                return response()->json([
                    'status' => 'error',
                    'errors' => $validator->errors()
                ]);
            } else {
                return redirect()->back()->withErrors($validator)->withInput();
            }
        }
        
        $validated = $validator->safe()->all();
        
        if ( $request['is_for_test'] == 1 ) {
            try {
                Mail::to( $request['test_email'] )->send(new NewNewsletter( $validated['data'] ));
            } catch (\Exception $ex) {
                return response()->json([
                    'status' => 'error',
                    'message' => $ex->getMessage()
                ]);
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Email sent successfully.',
            ]);

        } else {

            try {
                Subscriber::active()->chunk(40, function ($subscribers) use ( $validated ) {
                    SendNewsletterEmails::dispatch($subscribers, $validated['data']);
                });
            } catch (\Exception $ex) {
                return response()->json([
                    'status' => 'error',
                    'message' => $ex->getMessage()
                ]);
            }

            return redirect()->back()->with('success', 'Done Successfully.');
        }
    }

    public function sendMarketing(Request $request)
    {
        $request['is_for_test'] ??= 0;

        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'is_for_test' => 'required|in:0,1',
            'test_email' => 'nullable|required_if:is_for_test,1|email|max:255',

            'subject' => 'required|string|max:255',

            'images' => 'required|array',
            'images.*.image' => 'required|image',
            'images.*.link' => 'required|url|max:255',
            
            'texts' => 'required|array',
            'texts.*.text' => 'required|string|max:255',
            'texts.*.link' => 'required|url|max:255',
            
            'socials' => 'required|array',
            'socials.*' => 'required|url|max:255',

            'email_footer' => 'required|string',

        ]);

        if ( $validator->fails() ) {
            if ( $request['is_for_test'] == 1 ) {
                return response()->json([
                    'status' => 'error',
                    'errors' => $validator->errors()
                ]);
            } else {
                return redirect()->back()->withErrors($validator)->withInput();
            }
        }

        $data = $validator->safe()->all();

        // return response()->json(
        //     $data
        // );

        
        try {
            foreach ($data['images'] as $key => $image) {
                $data['images'][$key]['image'] = $request['images'][$key]['image']->store("emails/subject-{$data['subject']}" , 'public');
            }
        } catch (\Exception $ex) {
            return response()->json([
                'status' => 'error',
                'message' => $ex->getMessage()
            ]);
        }
        
        if ( $request['is_for_test'] == 1 ) {
            try {
                Mail::to( $request['test_email'] )->send(new Marketing( $data ));
            } catch (\Exception $ex) {
                return response()->json([
                    'status' => 'error',
                    'message' => $ex->getMessage()
                ]);
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Email sent successfully.',
            ]);

        } else {
            
            Subscriber::active()->chunk(40, function ($subscribers) use ($data) {
                SendMarketingEmails::dispatch($subscribers, $data);
            });

            return redirect()->back()->with('success', 'Done Successfully.');
        }
    }
}
