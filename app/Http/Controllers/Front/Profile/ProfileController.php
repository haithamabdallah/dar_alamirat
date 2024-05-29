<?php

namespace App\Http\Controllers\Front\Profile;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;

class ProfileController extends Controller
{
    //
    public function showProfile(User $user)
    {
        // Return the user profile view with the user model passed to it

        return view('themes.theme1.profile.my-account',compact('user'));
    }

    public function updateProfile(ProfileRequest $request, User $user)
    {
        $user->update($request->validated());

        // Redirect or return a response
        return redirect()->route('user.profile', $user)->with('success', 'Profile updated successfully.');
    }


}
