<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class LoginController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function login(Request $request) {
        $validatedData = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        try {
            if(!$token = JWTAuth::attempt($validatedData)) {
                return response()->json([
                    'error' => 'Invalid email or password'
                ], 401);
            }
        }
        catch(JWTException $e) {
            return response()->json([
                'error' => 'Unable to generate token'
            ], 500);
        }

        return response()->json([
            'token' => $token,
            'user' => JWTAuth::user(),
        ], 201);
    }
}
