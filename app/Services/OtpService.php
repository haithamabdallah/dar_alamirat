<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\Otp;
use App\Models\User;
use App\Mail\OtpMail;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class OtpService
{

    public function sendOtp(string $email): JsonResponse
    {
        try {
            
           // $otp = rand(1000, 9999);
            $otp = 1234; // For testing, replace with actual OTP generation logic

            Otp::create([
                'email' => $email,
                'otp' => $otp,
                'expires_at' => Carbon::now()->addMinutes(10)
            ]);

            Mail::to($email)->send(new OtpMail($otp));

            session(['email' => $email]);
            
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            // Log any errors that occur during OTP sending
            Log::error('Error occurred during OTP sending: ' . $e->getMessage());

            // Return JSON response indicating internal server error
            return response()->json([
                'success' => false,
                'message' => 'An internal server error occurred.'
            ]);
        }
    }
    
    public function verifyOtp(array $validatedData): JsonResponse
    {
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
    
                // Return JSON response indicating successful login
                return response()->json([
                    'success' => true,
                    'message' => 'Logged in successfully!',
                    'redirect_url' => route('index')
                ]);
            }
    
            // Return JSON response indicating invalid OTP
            return response()->json([
                'success' => false,
                'message' => 'Invalid or expired OTP'
            ]);
        } catch (\Exception $e) {
            Log::error('Error occurred during OTP verification: ' . $e->getMessage());
    
            // Return JSON response indicating internal server error
            return response()->json([
                'success' => false,
                'message' => 'An internal server error occurred.'
            ]);
        }
    }
    private function findOrCreateUser($email)
    {
        // Extract first name and last name from email
        $emailParts = explode('@', $email); // Split email by '@'
        $username = $emailParts[0]; // Extract username part before '@'
    
        // Split username into first name and last name (assuming it's in format 'firstname.lastname')
        $nameParts = explode('.', $username);
    
        // Check if both parts exist before accessing them
        $firstName = isset($nameParts[0]) ? ucfirst($nameParts[0]) : null; // Capitalize first name
        $lastName = isset($nameParts[1]) ? ucfirst($nameParts[1]) : null; // Capitalize last name
    
        // Debugging: Log extracted email and name parts
        Log::info('Email: ' . $email);
        Log::info('First Name: ' . $firstName);
        Log::info('Last Name: ' . $lastName);
    
        // Attempt to find the user by email
        $user = User::where('email', $email)->first();
        
        // If the user does not exist, create a new user
        if (!$user) {
            $userData = [
                'email' => $email,
                // Add first name and last name if they exist
                'first_name' => $firstName,
                'last_name' => $lastName,
                // Other user fields...
            ];
    
            // Remove null values to prevent database errors
            $userData = array_filter($userData);
    
            $user = User::create($userData);
        }
    
        return $user;
    }
}
