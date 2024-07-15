<?php

namespace App\Http\Controllers\Front\Profile;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    //
    public function showProfile(User $user)
    {
        // Return the user profile view with the user model passed to it

        return view('themes.' . getAppTheme() . '.profile.my-account',compact('user'));
    }

    public function updateProfile(ProfileRequest $request, User $user)
    {
        $user->update($request->validated());

        // Redirect or return a response
        return redirect()->route('user.profile', $user)->with('success', 'Profile updated successfully.');
    }
    
    public function updateAvatar(Request $request)
    {
        $validated = $request->validate([
            'avatar' => 'required|image|max:2048|mimes:jpeg,png,jpg,gif,svg,webp',
        ]);
        
        $user = auth()->user();

        if ($request->file('avatar')->isValid()) {
            
            if ( $user->avatar && Storage::disk('public')->exists($user->avatar) ) {
                Storage::disk('public')->delete($user->avatar);
            }

            $path = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $path;
            $user->save();
         
            return redirect()->back()->with('success', 'Avatar updated successfully.');
        }
    }


}
