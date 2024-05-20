<?php

namespace App\Http\Controllers\Front;

use Carbon\Carbon;
use App\Models\Otp;
use App\Mail\OtpMail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    //
    public function sendOtp(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        $otp = rand(1000, 9999);

        Otp::create([
            'email' => $request->email,
            'otp' => $otp,
            'expires_at' => Carbon::now()->addMinutes(10)
        ]);

        Mail::to($request->email)->send(new OtpMail($otp));

        session(['email' => $request->email]);

        return response()->json(['success' => true]);
    }

    public function verifyOtp(Request $request)
    {
        dd('');
        $request->validate(['otp' => 'required|array|size:4', 'email' => 'required|email']);
        $otp = implode('', $request->otp);
        $otpRecord = Otp::where('email', $request->email)
                         ->where('otp', $otp)
                         ->where('expires_at', '>', Carbon::now())
                         ->first();
                         dd('login');
        if ($otpRecord) {

            $otpRecord->delete();  // Optional: Delete the OTP after successful verification

            return redirect()->route('index')->with('message', 'Logged in successfully!');
        } else {
            return back()->withErrors(['otp' => 'Invalid or expired OTP']);
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
