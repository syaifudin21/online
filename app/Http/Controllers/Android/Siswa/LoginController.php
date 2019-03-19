<?php

namespace App\Http\Controllers\Android\Siswa;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Siswa;
use JWTAuth;
use JwtAuthException;
use Config;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|string|max:255',
            'password' => 'required|string|max:255',
        ]);
        
        $credential = [
            'username' => $request->username,
            'password' => $request->password
        ];

        if (Auth::guard('siswa')->attempt($credential, false)){
            $token = null;
            try{
                if (!$token = JWTAuth::attempt($credential)) {
                    return response()->json(['message' => 'Email atau password salah'], 404);
                }
            }catch(JWTAuthException $e){
                return response()->json(['message' => 'Gagal Login'], 200);
            }

            $user = Siswa::where('username', $request->username)->first();
            return response()->json([
                'user'=> $user,
                'token'=> $token,
                'kode'=> '00',
                'message' => 'Berhasil Login'
            ], 200);
        }else{
            return response()->json(['kode'=> '01', 'message'=> 'Kombinasi Email dan password salah'], 200);
        }
    }
}
