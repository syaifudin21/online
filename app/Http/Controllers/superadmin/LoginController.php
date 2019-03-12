<?php

namespace App\Http\Controllers\superadmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:superadmin')->except(['logout']);
    }
    public function form()
    {
        return view('superadmin.super-login');
    }
    public function login(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|min:8',
            'password' => 'required|min:6'
        ]);

        $credential = [
            'username' => $request->username,
            'password' => $request->password
        ];

        // Attempt to log the user in
        if (Auth::guard('superadmin')->attempt($credential, false)){
            // If login succesful, then redirect to their intended location
            return redirect()->intended(route('superadmin.home'));
        }

        // If Unsuccessful, then redirect back to the login with the form data
        return redirect()->back()->withInput($request->only('email', 'remember'));
    }

    public function logout(Request $request)
    {
        Auth::guard('superadmin')->logout();
        return redirect('/superadmin/login');
    }
}
