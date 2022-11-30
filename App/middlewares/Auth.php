<?php

namespace App\middlewares;
use App\Models\User;
use Lib\Http\BaseMiddleware;

class Auth implements BaseMiddleware
{
    public function handle():bool
    {
         if(isset($_SESSION['user']) && isset($_SESSION['user']['api_key']) && isset($_SESSION['user']['email'])){
             $user = User::where('api_key',$_SESSION['user']['api_key'])->where('email',$_SESSION['user']['email'])->first();
             return (bool)$user;
         }
    }
}
