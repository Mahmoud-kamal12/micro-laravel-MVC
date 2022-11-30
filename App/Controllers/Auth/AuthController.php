<?php

namespace App\Controllers\Auth;

use App\Models\User;
use Lib\Support\Auth;

class AuthController
{
    public function login(){
        $data = request()->only(['email' , 'password']);
        $user = User::where('email' , $data['email'])->firstOrFail();
        if (Auth::login($user ,$data['password'])){
            return response()->json(["msg" => "login successfully" , "user" => $user->toArray()]);
        }
        return  response()->json(["msg" => "login faild"]);
    }
}
