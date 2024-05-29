<?php

namespace App\Http\Controllers\Front\Profile;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    //
    public function showProfile(User $user)
    {
        // Return the user profile view with the user model passed to it
        
        return view('themes.theme1.profile.my-account',compact('user'));
    }
}
