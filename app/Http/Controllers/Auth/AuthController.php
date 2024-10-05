<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        try {
            
            $user = User::where('email', $request->email)->first();
            if(!$user && $request->provider){
                return response()->json([
                    'code' => 404,
                    'message' => 'email not found'
                ]);
            }

            if (! Hash::check($request->password, $user->password)) {
                return response()->json([
                    'message' => "E-mail and Password do not match",
                    'code' => 400
                ],500);
            }

            $accessToken = $user->createToken($request->email)->plainTextToken;

            return response()->json([
                'message' => "You have successfully logged in",
                'access_token' => $accessToken
            ]);

        } catch (\Exception $err) {
            Log::error($err);
            throw $err;
        }
    }

    public function logout()
    {
        
    }
}
