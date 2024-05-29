<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\Otp;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class OtpService
{
    public function verifyOtp($email, $otpArray)
    {
        $otp = implode('', $otpArray);

        $otpRecord = Otp::where('email', $email)
                        ->where('otp', $otp)
                        ->where('expires_at', '>', Carbon::now())
                        ->first();

        if ($otpRecord) {
            $otpRecord->delete();  // Optional: Delete the OTP after successful verification

            // Create or retrieve the user based on the provided email
            $user = $this->findOrCreateUser($email);

            // Log in the user
            Auth::login($user);

            return ['success' => true, 'message' => 'Logged in successfully!', 'redirect_url' => route('index')];
        }

        return ['success' => false, 'message' => 'Invalid or expired OTP'];
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
}
