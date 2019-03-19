<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function postLogin(Request $request) {
        $email = $request->get('email');
        $password = $request->get('password');
    
        if (Auth::attempt(['email' => $email, 'password' => $password])) {
    
            $user = User::where('email', $email)->first();
            $token = JWTAuth::fromUser($user);
    
            $response = [
                "success" => true,
                "key" => "Bearer {$token}"
            ];
    
        } else {
            $response = [
                "success" => false,
                "message" => "user not found"
            ];
        }
    
        return response()
            ->json($response);
    }
    public function getUser() {
        $response = [
            "success" => true,
            "data" => Auth::user()
        ];
    
        return response()
            ->json($response);
    }
}
