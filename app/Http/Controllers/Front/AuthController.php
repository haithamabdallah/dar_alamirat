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
        $otp = rand(1000, 9999);
        $hashedOtp = Hash::make($otp);
        Otp::create([
            'email' => $request->email,
            'otp' => $hashedOtp,
            'expires_at' => Carbon::now()->addMinutes(10)
        ]);
        Mail::to($request->email)->send(new OtpMail($otp));
        session(['email' => $request->email]);
        return response()->json(['success' => true]);
    }


    public function verifyOtp(VerifyOtpRequest $request): JsonResponse
    {
        try {
            $response = $this->otpService->verifyOtp($request->email, $request->otp);
            return response()->json($response);
        } catch (\Exception $e) {
            Log::error('Error occurred during OTP verification: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'An internal server error occurred.']);
        }
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
}
