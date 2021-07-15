<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(LoginRequest $request) {
        if (Auth::attempt($request->validationData())) {
            $user = Auth::user();
            $token = $user->createToken('authToken')->accessToken;
            return response([
                'user' => $user,
                'access_token' => $token,
            ]);
        }
        else {
            return response('Invalid credentials');
        }
    }
}
