<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Auth\LoginRequest;
use Illuminate\Http\Request;
use Modules\Admin\app\Models\Admin;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        
        return view('dashboard.auth.login');
    }

    public function login(LoginRequest $request)
    {
        $admin = Admin::where('userName', $request->userName)->first();

        if (isset($admin) && $admin->status != 1) {
            session()->flash('error' , "'You are blocked!!, contact with admin.");
            return redirect()->back()->withInput($request->only('userName', 'remember'));
        }else{
            if (auth('admin')->attempt(['userName' => $request->userName, 'password' => $request->password], $request->remember)) {
                return redirect()->route('dashboard.index');
            }
        }

//        session()->flash('error' , "something went wrong Credentials does not match.");
        return redirect()->back()->withErrors(['error' => 'Credentials do not match.'])->withInput($request->only('userName', 'remember'));
    }

    public function register()
    {
        return view('admin-views.auth.login');
    }

    public function logout()
    {
        auth('admin')->logout();
        return redirect()->route('dashboard.auth.login');
    }
}
