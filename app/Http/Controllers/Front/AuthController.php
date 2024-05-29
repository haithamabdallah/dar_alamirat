<?php

namespace App\Http\Controllers\Front;

use Carbon\Carbon;
use App\Models\Otp;
use App\Models\User;
use App\Mail\OtpMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    //
    public function sendOtp(Request $request)
{
    // Validate the incoming request
    $request->validate(['email' => 'required|email']);

    // Generate a random OTP
    $otp = rand(1000, 9999);

    // Hash the OTP
    $hashedOtp = Hash::make($otp);

    // Store the hashed OTP in the database with an expiration time
    Otp::create([
        'email' => $request->email,
        'otp' => $hashedOtp,
        'expires_at' => Carbon::now()->addMinutes(10)
    ]);

    // Send the plain OTP to the user via email
    Mail::to($request->email)->send(new OtpMail($otp));

    // Store the email in the session
    session(['email' => $request->email]);

    // Return a JSON response indicating success
    return response()->json(['success' => true]);
}


    public function verifyOtp(Request $request)
{
    try {
        $validator = Validator::make($request->all(), [
            'otp' => 'required|array|min:4|max:4',
            'otp.*' => 'required|string|size:1',
            'email' => 'required|email'
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => 'Invalid input.']);
        }

        $otp = implode('', $request->otp);

        $otpRecord = Otp::where('email', $request->email)
                        ->where('otp', $otp)
                        ->where('expires_at', '>', Carbon::now())
                        ->first();

        // Create or retrieve the user based on the provided email
        $user = User::firstOrCreate(
            ['email' => $request->email],
            [
               // 'first_name' => '',
               // 'last_name' => '',
               // 'phone_number' => '',
              //  'birthday' => '',
               // 'gender' => '',
              //  'password' => '',
                // Add other fields as required
            ]
        );

        if ($otpRecord) {
            $otpRecord->delete();  // Optional: Delete the OTP after successful verification

            // Log in the user
            Auth::login($user);

            return response()->json(['success' => true, 'message' => 'Logged in successfully!', 'redirect_url' => route('index')]);
        } else {
            return response()->json(['success' => false, 'message' => 'Invalid or expired OTP']);
        }
    } catch (\Exception $e) {
        Log::error('Error occurred during OTP verification: ' . $e->getMessage());
        return response()->json(['success' => false, 'message' => 'An internal server error occurred.']);
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
                'first_name' => null,
                'last_name' => null,
                'phone_number' => null,
                'birthday' => null,
                'gender' => null,
                'password' => null,
                // Add other fields as required
            ]);
        }

        return $user;
    }


    // public function verifyOtp(Request $request)
    // {
    //     try {
    //         $validator = $this->validateOtpRequest($request);

    //         if ($validator->fails()) {
    //             return $this->jsonResponse(false, 'Invalid input.');
    //         }

    //         $otp = $this->getOtpString($request->otp);
    //         $otpRecord = $this->findOtpRecord($request->email, $otp);
    //         $user = new User();
    //         $user->email = $request->email;
    //         $user->first_name = null;
    //         $user->last_name = null;
    //         $user->phone_number = null;
    //         $user->birthday = null;
    //         $user->gender = null;
    //         $user->password = null;
    //         // Add other fields as required
    //         $user->save();

    //         if ($user) {
    //             // Log in the user
    //             // if (!Auth::login($user)) {
    //                 // Check if user is authenticated
    //                 // if (!Auth::check()) {
    //                     // if ($otpRecord) {
    //                         $otpRecord->delete(); // Optional: Delete the OTP after successful verification
    //                     // }
    //                     Session::flash('success_message', 'Logged in successfully!');
    //                     return $this->jsonResponse(true, 'Logged in successfully!', route('cart.index'));

    //             // } else {
    //             }
    //          else {
    //             Log::error('Failed to create user.');
    //             return $this->jsonResponse(false, 'Failed to create user.');
    //         }
    //     } catch (\Exception $e) {
    //         Log::error('Error occurred during OTP verification: ' . $e->getMessage());
    //         return $this->jsonResponse(false, 'An internal server error occurred.');
    //     }
    // }
    // private function validateOtpRequest(Request $request)
    // {
    //     return Validator::make($request->all(), [
    //         'otp' => 'required|array|min:4|max:4',
    //         'otp.*' => 'required|string|size:1',
    //         'email' => 'required|email'
    //     ]);
    // }

    // private function getOtpString(array $otpArray)
    // {
    //     return implode('', $otpArray);
    // }

    // private function findOtpRecord($email, $otp)
    // {
    //     return Otp::where('email', $email)
    //               ->where('otp', $otp)
    //               ->where('expires_at', '>', now())
    //               ->first();
    // }
    // private function createUser($email)
    // {
    //     try {
    //         // Attempt to find the user by email
    //         //$user = User::where('email', $email)->first();

    //         // If the user does not exist, create a new user
    //         // if (!$user) {
    //             $user = new User();
    //             $user->email = $email;
    //             $user->first_name = null;
    //             $user->last_name = null;
    //             $user->phone_number = null;
    //             $user->birthday = null;
    //             $user->gender = null;
    //             $user->password = null;
    //             // Add other fields as required
    //             $user->save();
    //         // }

    //         return $user;
    //     } catch (\Exception $e) {
    //         Log::error('Error creating user: ' . $e->getMessage());
    //         return null;
    //     }
    // }


    // private function jsonResponse($success, $message, $redirectUrl = null)
    // {
    //     $response = [
    //         'success' => $success,
    //         'message' => $message
    //     ];

    //     if ($redirectUrl) {
    //         $response['redirect_url'] = $redirectUrl;
    //     }

    //     return response()->json($response);
    // }
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
