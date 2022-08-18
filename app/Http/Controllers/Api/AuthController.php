<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;



class AuthController extends Controller
{
    public function register(Request $request){
        // $user = $request->only(['nama','email','password','id_dealer','id_role','no_handphone']);
        $user = $request->all();
        $user['password'] = bcrypt($request->password);

        $user = User::create($user);
        return response([
            'message' => 'Register berhasil',
            'data' => $user
        ], 200);
    }

    public function login(Request $request){
        // $login = $request->all();
        $login = $request->only(['email', 'password']);
        
        if(!Auth::attempt($login))
            return response(['message' => 'Email/Password salah atau belum terdaftar'], 401);

        $user = Auth::user();
        $token = $user->createToken('Authentication Token')->accessToken;

        return response([
            'message' => 'Login berhasil',
            'data' => $user,
            'token_type' => 'Bearer',
            'access_token' => $token
        ]);

        
    }

}
