<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            "login" => "required",
            "password" => "required"
        ]);
        $user = User::where([
            "username" => $request['login'],
        ])->first();

        if($user && Hash::check($request['password'], $user->password)){
            $token = $user->createToken('access_token');
            return $this->json_response([
                'access_token' => $token->plainTextToken
            ]);
        }else{
            return $this->json_response(null,'auth.invalid_credential', 403);
        }
    }
}
