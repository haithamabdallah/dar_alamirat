<?php

namespace App\Http\Controllers\Front;

use Carbon\Carbon;
use App\Models\Otp;
use App\Models\User;
use App\Mail\OtpMail;
use App\Services\OtpService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\VerifyOtpRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

     protected $otpService;

    public function __construct(OtpService $otpService)
    {
        $this->otpService = $otpService;
    }




    public function sendOtp(Request $request)
    {

        $request->validate(['email' => 'required|email']);
      //  $otp = rand(1000, 9999);
      $otp = 1234; // for test
       // $hashedOtp = Hash::make($otp);
        Otp::create([
            'email' => $request->email,
            'otp' => $otp,
            'expires_at' => Carbon::now()->addMinutes(10)
        ]);

        Mail::to($request->email)->send(new OtpMail($otp));

        session(['email' => $request->email]);
        
        return response()->json(['success' => true]);
    }


    public function verifyOtp(VerifyOtpRequest $request): RedirectResponse
{
    // Validate the incoming request using VerifyOtpRequest
    $validatedData = $request->validated();

    try {
        $otp = implode('', $validatedData['otp']);

        $otpRecord = Otp::where('email', $validatedData['email'])
            ->where('otp', $otp)
            ->where('expires_at', '>', now())
            ->first();

        if ($otpRecord) {
            $otpRecord->delete();  // Optional: Delete the OTP after successful verification

            // Create or retrieve the user based on the provided email
            $user = $this->findOrCreateUser($validatedData['email']);

            // Log in the user
            Auth::login($user);

            return redirect()->route('index')->with('success', 'Logged in successfully!');
        }

        return redirect()->back()->withErrors(['otp' => 'Invalid or expired OTP'])->withInput();
    } catch (\Exception $e) {
        Log::error('Error occurred during OTP verification: ' . $e->getMessage());
        return redirect()->back()->withErrors(['otp' => 'An internal server error occurred.'])->withInput();
    }
}


    private function findOrCreateUser($email)
    {
        // Attempt to find the user by email
        $user = User::where('email', $email)->first();
        // If the user does not exist, create a new user
        if (!$user) {
            $user = User::create([
                'email' => $email,

            ]);
        }
        return $user;
    }


    public function resendOtp(Request $request)
    {
        $email = $request->email;
        $otp = rand(1000, 9999);

        Otp::where('email', $email)->delete();

        Otp::create([
            'email' => $email,
            'otp' => $otp,
            'expires_at' => Carbon::now()->addMinutes(10)
        ]);

        Mail::to($email)->send(new OtpMail($otp));

        return response()->json(['message' => 'OTP resent!']);
    }

    public function logout(): RedirectResponse
    {
        Auth::logout();

        return redirect()->route('index')->with('success', 'You have been logged out.');
    }


}
