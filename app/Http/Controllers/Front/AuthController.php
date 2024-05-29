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

     protected $otpVerificationService;

    public function __construct(OtpService $otpVerificationService)
    {
        $this->otpVerificationService = $otpVerificationService;
    }

    public function sendOtp(Request $request): JsonResponse
    {
        $request->validate(['email' => 'required|email']);

        return $this->otpVerificationService->sendOtp($request->email);
    }

    public function verifyOtp(VerifyOtpRequest $request): JsonResponse
    {
        $validatedData = $request->validated();

        return $this->otpVerificationService->verifyOtp($validatedData);
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
